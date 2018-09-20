import { Component, ViewChild, ElementRef, NgZone } from "@angular/core";
import {
  Events,
  IonicPage,
  NavController,
  NavParams,
  Platform,
  ToastController
} from "ionic-angular";
import {
  Geolocation,
  GeolocationOptions,
  Geoposition,
  PositionError
} from "@ionic-native/geolocation";
import { FavoritesPage } from "../favorites/favorites";
import { HttpErrorResponse } from "@angular/common/http";
import { AuthProvider } from "../../providers/auth/auth";
import { ServiceProvider } from "../../providers/service/service.service";
import { ServicePage } from "../service/service";
import { MyservicesPage } from "./../myservices/myservices";
import { TabPage } from '../tab/tab';

declare var google;

// @IonicPage()
@Component({
  selector: "page-tab-mapa",
  templateUrl: "tab-mapa.html"
})
export class TabMapaPage {
  options: GeolocationOptions;
  infowindow: any;
  wacthed: any;
  watch: any;
  latLng: any;
  currentP: any;
  loggedIn: boolean;
  @ViewChild("map") mapElement: ElementRef;
  map: any;
  places: Array<any>;

  constructor(
    public toastCtrl: ToastController,
    public events: Events,
    platform: Platform,
    public navCtrl: NavController,
    public navParams: NavParams,
    public servProv: ServiceProvider,
    private geolocation: Geolocation,
    public auth: AuthProvider,
    private ngZone: NgZone
  ) {
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
    this.auth.currentUser.subscribe(user => {
      this.loggedIn = user;
    });

    if (typeof google !== "undefined") {
      this.infowindow = new google.maps.InfoWindow();
      if (this.auth.getlastPosition()) {
        this.latLng = new google.maps.LatLng(
          this.auth.getlastPosition().coords.latitude,
          this.auth.getlastPosition().coords.longitude
        );
        this.addMap(
          this.auth.getlastPosition().coords.latitude,
          this.auth.getlastPosition().coords.longitude,
          this
        );
      } else {
        this.latLng = new google.maps.LatLng(-0.22985);
        this.addMap(-0.22985, -78.52495, this);
      }
    } else {
      let toast = this.toastCtrl.create({
        message: "No hay conexion a internet",
        duration: 5000,
        position: "bottom"
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

  openLoginPage() {
    this.navCtrl.parent.goToRoot();
    this.navCtrl.push("LoginPage");
  }

  addMap(lat, long, that) {
    let latLng = new google.maps.LatLng(lat, long);
    let mapOptions = {
      center: latLng,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      fullscreenControl: false,
      streetViewControl: false
    };

    this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);
    this.servProv
      .filterService({}, {}, 100, {
        latitude: lat,
        longitude: long
      },"")
      .then(
        data => {
          let services = data["data"];
          for (let i = 0; i < services.length; i++) {
            var iconmarker =
              "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png";
            if (services[i].subcategoriesList.length > 0) {
              iconmarker = services[i].subcategoriesList[0].thumb;
            }
            for (let j = 0; j < services[i].positionsList.length; j++) {
              let marker = new google.maps.Marker({
                map: this.map,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(
                  services[i].positionsList[j].latitude,
                  services[i].positionsList[j].longitude
                ),
                icon: iconmarker,
                name: services[i].positionsList[j].title,
                datosServicio: JSON.stringify(services[i])
              });

              let content ='<a class="custom-marker" >' +
                '<h6 class="tc-blue">' +
                services[i].title +
                "</h6></a>" +
                '<span class="tc-blue">' +
                services[i].positionsList[j].title +
                "</span> <p><small><strong>Doble clic en el ícono para abrir</strong></small></p>";
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
      icon: "assets/icon/location.png",
      animation: google.maps.Animation.BOUNCE,
      position: latLng
    });

    let content = "<p>Su posición actual!</p>";

    let infoWindow = new google.maps.InfoWindow({
      content: content
    });
      setTimeout(()=>  {
          this.currentP.setAnimation(null);
      }, 9000);

    google.maps.event.addListener(this.currentP, "click", () => {
      // console.log(this.currentP);
      infoWindow.open(this.map, this.currentP);
    });
  }

  addInfoWindow(marker, content) {
    google.maps.event.addListener(marker, "dblclick", () => {
       this.ngZone.run(() => {
        this.navCtrl.push(ServicePage, {
          serviceId: JSON.parse(marker['datosServicio'])['id'],
          service: JSON.parse(marker['datosServicio'])
        });
       });
    });

    google.maps.event.addListener(marker, "click", () => {
      this.infowindow.setContent(content);
        this.infowindow.open(this.map, marker);
    });
  }

  getUserPosition() {
    this.geolocation.getCurrentPosition().then(
      pos => {
        this.latLng = new google.maps.LatLng(
          pos.coords.latitude,
          pos.coords.longitude
        );
        this.addMap(pos.coords.latitude, pos.coords.longitude, this);
      },
      (err: PositionError) => {
        console.log("error : " + err.message);
      }
    );
  }

  getRestaurants(latLng) {
    var service = new google.maps.places.PlacesService(this.map);
    let request = {
      location: latLng,
      radius: 2000,
      types: ["restaurant"]
    };
    return new Promise((resolve, reject) => {
      service.nearbySearch(request, function(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          resolve(results);
        } else {
          reject(status);
        }
      });
    });
  }
  /*
  createMarker(place, i) {
    let marker = new google.maps.Marker({
      map: this.map,
      animation: google.maps.Animation.DROP,
      position: place.geometry.location,
      name
    });
    let content =
      ' <a onclick="openService(' +
      place.service.id +
      ")\" class='custom-marker' href=\"./service/" +
      place.service.id +
      '" >' +
      '<h6 class="tc-blue">' +
      place.service.title +
      "</h6></a>" +
      '<span class="tc-blue">' +
      place.title +
      "</span>";
    this.addInfoWindow(marker, content);

    // let content =
    //   "<a id='" + i + "' class='custom-marker' >" + place.name + "</a>";
    // let content = "<a onclick=\"this.bind(this.openService(86))\" class='custom-marker' >" + place.name + "</a>"
    this.addInfoWindow(marker, content);
  } */
}

