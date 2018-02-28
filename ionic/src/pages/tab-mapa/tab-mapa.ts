import {Component, ViewChild, ElementRef} from '@angular/core';
import {Events, IonicPage, NavController, NavParams, Platform} from 'ionic-angular';
import {Geolocation, GeolocationOptions, Geoposition, PositionError} from '@ionic-native/geolocation'
import {ServicePage} from "../service/service";
import {FavoritesPage} from "../favorites/favorites";


declare var google;

@IonicPage()
@Component({
  selector: 'page-tab-mapa',
  templateUrl: 'tab-mapa.html',
})
export class TabMapaPage {
  options: GeolocationOptions;
  currentPos: Geoposition;
  infowindow = new google.maps.InfoWindow;
  wacthed: any;
  watch: any;
  latLng: any;
  currentP: any;

  @ViewChild('map') mapElement: ElementRef;
  map: any;
  places: Array<any>;

  constructor(public events: Events, platform: Platform, public navCtrl: NavController,
              public navParams: NavParams, private geolocation: Geolocation) {



    platform.ready().then(() => {
    });
    events.subscribe('current:position', (position) => {
      // user and time are the same arguments passed in `events.publish(user, time)`
      //this.latLng=position
      console.log("YA HAY!! ademas de que cambio !!");
    });

    if (!this.latLng) {
      this.getUserPosition();
    }
    else {
      console.log("si hay");
    }
  }

  // ionViewDidLoad() {
  //   this.getUserPosition();
  // }


  addMap(lat, long) {

    let latLng = new google.maps.LatLng(lat, long);

    let mapOptions = {
      center: latLng,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);

    this.getRestaurants(latLng).then((results: Array<any>) => {
      this.places = results;
      for (let i = 0; i < results.length; i++) {
        this.createMarker(results[i],i);
      }
    }, (status) => console.log(status));

    this.addMarker(latLng);

  }

  addMarker(latLng) {

    this.currentP = new google.maps.Marker({
      map: this.map,
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

  getLocation() {
    // this.geolocation.getCurrentPosition({ enableHighAccuracy : false}).then((resp) => {
    // this.latLng = new google.maps.LatLng(resp.coords.latitude, resp.coords.longitude);
    this.map.setCenter(this.latLng);
    this.map.setZoom(15);
    this.currentP = new google.maps.Marker({
      map: this.map,
      icon: "http://www.googlemapsmarkers.com/v1/009900/",
      position: this.latLng
    });
    let content = "<h4>Mi posición</h4>";
    this.addInfoWindow(this.currentP, content);
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
      this.watch = this.geolocation.watchPosition({maximumAge: 60000, timeout: 60000})
        .filter((p) => p.coords !== undefined)
        .subscribe(position => {
          this.wacthed = true;
          console.log("CAMBIO");
          let newPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
          if (!this.latLng.equals(newPosition)) {
            console.log("muevete");
            this.latLng = newPosition;
            this.map.setZoom(this.map.getZoom());
            this.currentP.setPosition(this.latLng);
          }
        });
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

  createMarker(place,i) {
    let marker = new google.maps.Marker({
      map: this.map,
      animation: google.maps.Animation.DROP,
      position: place.geometry.location,
      name
    });

    let content = "<a id='"+i+"' class='custom-marker' >" + place.name + "</a>";
    // let content = "<a onclick=\"this.bind(this.openService(86))\" class='custom-marker' >" + place.name + "</a>"
    this.addInfoWindow(marker, content);
  }

}
