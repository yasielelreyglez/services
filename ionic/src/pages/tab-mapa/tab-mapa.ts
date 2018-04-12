import {Component, ViewChild, ElementRef} from '@angular/core';
import {Events, IonicPage, NavController, NavParams, Platform, ToastController} from 'ionic-angular';
import {Geolocation, GeolocationOptions, Geoposition, PositionError} from '@ionic-native/geolocation'
import {FavoritesPage} from "../favorites/favorites";
import {HttpErrorResponse} from "@angular/common/http";
import {AuthProvider} from "../../providers/auth/auth";
import {ServiceProvider} from "../../providers/service/service.service";

declare var google;

@IonicPage()
@Component({
  selector: 'page-tab-mapa',
  templateUrl: 'tab-mapa.html',
})
export class TabMapaPage {
  options: GeolocationOptions;
  infowindow: any;
  wacthed: any;
  watch: any;
  latLng: any;
  currentP: any;

  @ViewChild('map') mapElement: ElementRef;
  map: any;
  places: Array<any>;

  constructor(public toastCtrl: ToastController, public events: Events, platform: Platform, public navCtrl: NavController,
              public navParams: NavParams, public servProv: ServiceProvider, private geolocation: Geolocation, public auth: AuthProvider) {
    //   if (typeof google !== 'undefined') {
    //     this.infowindow = new google.maps.InfoWindow;
    //     if (!this.latLng) {
    //       console.log("no hay");
    //       this.addMap(1, 2);
    //       // this.getUserPosition();
    //     }
    //     else {
    //       console.log("si hay");
    //     }
    //   }
    //   else {
    //     let toast = this.toastCtrl.create({
    //       message: "No hay conexion a internet",
    //       duration: 5000,
    //       position: 'bottom',
    //     });
    //     toast.present();
    //   }
  }

  ionViewDidLoad() {

    if (typeof google !== 'undefined') {
      this.infowindow = new google.maps.InfoWindow;
      if (this.auth.getlastPosition()) {
        this.latLng =new google.maps.LatLng(this.auth.getlastPosition().coords.latitude, this.auth.getlastPosition().coords.longitude);
        this.addMap(this.auth.getlastPosition().coords.latitude, this.auth.getlastPosition().coords.longitude);
      }
      else {

        this.latLng =new google.maps.LatLng(-0.22985,);
        this.addMap(-0.22985, -78.52495);
      }
    }
    else {
      let toast = this.toastCtrl.create({
        message: "No hay conexion a internet",
        duration: 5000,
        position: 'bottom',
      });
      toast.present();
    }
    // this.auth.currentPosition.subscribe(
    //   (data: Geoposition) => {
    //     console.log("cambio position");
    //     // this.latLng = new google.maps.LatLng(data.coords.latitude, data.coords.longitude);
    //     this.latLng = new google.maps.LatLng(-0.22985, -78.52495);
    //     this.map.setCenter(this.latLng);
    //     this.map.setZoom(15);
    //     this.currentP = new google.maps.Marker({
    //       map: this.map,
    //       icon: "http://www.googlemapsmarkers.com/v1/009900/",
    //       position: this.latLng
    //     });
    //     let content = "<h4>Mi posición</h4>";
    //     this.addInfoWindow(this.currentP, content);
    //   },
    //   (error: Geoposition) => {
    //     alert(error);
    //   },
    // );
  }

  addMap(lat, long) {

    let latLng = new google.maps.LatLng(lat, long);
    let mapOptions = {
      center: latLng,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);
    this.servProv.filterService(
      {},
      {},
      6,
      {
        latitude: lat, longitude: long
      })
      .then(data => {
          let services = data["services"];
          for (let i = 0; i < services.length; i++) {
            for (let j = 0; j < services[i].positionsList.length; j++) {
              let marker = new google.maps.Marker({
                map: this.map,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(services[i].positionsList[j].latitude, services[i].positionsList[j].longitude),
                name: services[i].positionsList[j].title
              });

              let content = "<a id='" + j + "' class='custom-marker' >" + services[i].positionsList[j].title + "</a>";
              this.addInfoWindow(marker, content);
            }
          }
        },
        (err: HttpErrorResponse) => {
          if (err.error instanceof Error) {
            console.log("error");
          }
        }
      );

    // this.getRestaurants(latLng).then((results: Array<any>) => {
    //   this.places = results;
    //   for (let i = 0; i < results.length; i++) {
    //     this.createMarker(results[i],i);
    //   }
    // }, (status) => console.log(status));
    this.addMarker(latLng);
  }

  addMarker(latLng) {

    this.currentP = new google.maps.Marker({
      map: this.map,
      icon: "http://www.googlemapsmarkers.com/v1/009900/",
      animation: google.maps.Animation.DROP,
      position: latLng
    });

    let content = "<p>This is your current position !</p>";
    let infoWindow = new google.maps.InfoWindow({
      content: content
    });


    google.maps.event.addListener(this.currentP, 'click', () => {
      infoWindow.open(this.map, this.currentP);
    });

  }

  addInfoWindow(marker, content) {
    google.maps.event.addListener(marker, 'click', () => {
      this.infowindow.setContent(content);
      this.infowindow.open(this.map, marker);
      // this.openService(86);
    });

  }

  getUserPosition() {
    this.geolocation.getCurrentPosition().then((pos) => {
      this.latLng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
      this.addMap(pos.coords.latitude, pos.coords.longitude);
    }, (err: PositionError) => {
      console.log("error : " + err.message);
    })
  }

  getRestaurants(latLng) {
    var service = new google.maps.places.PlacesService(this.map);
    let request = {
      location: latLng,
      radius: 2000,
      types: ["restaurant"]
    };
    return new Promise((resolve, reject) => {
      service.nearbySearch(request, function (results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          resolve(results);
        } else {
          reject(status);
        }
      });
    });

  }

  openService(id) {
    this.navCtrl.push(FavoritesPage);
  }

  createMarker(place, i) {
    let marker = new google.maps.Marker({
      map: this.map,
      animation: google.maps.Animation.DROP,
      position: place.geometry.location,
      name
    });

    let content = "<a id='" + i + "' class='custom-marker' >" + place.name + "</a>";
    // let content = "<a onclick=\"this.bind(this.openService(86))\" class='custom-marker' >" + place.name + "</a>"
    this.addInfoWindow(marker, content);
  }

}
