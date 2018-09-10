import { Component, ViewChild, ElementRef } from "@angular/core";
import { NavParams, ToastController } from "ionic-angular";

import { Geolocation, Geoposition } from "@ionic-native/geolocation";
import { Position } from "../../models/position";
import { Events } from "ionic-angular";
import { AuthProvider } from "../../providers/auth/auth";
import {
  LaunchNavigator,
  LaunchNavigatorOptions
} from "@ionic-native/launch-navigator";

declare var google;

// @IonicPage()
@Component({
  selector: "page-mapa",
  templateUrl: "mapa.html"
})
export class MapaPage {
  latitude: any;
  longitude: any;
  wacthed: any;
  watch: any;
  latLng: any;
  currentP: any;
  havePosition: boolean;
  destinos: any[];
  zoom: any = 15;
  cant_c: any;
  positions: Position[] = [];
  infowindow = new google.maps.InfoWindow();
  directionsService = new google.maps.DirectionsService();
  directionsDisplay = new google.maps.DirectionsRenderer();
  distanceM = new google.maps.DistanceMatrixService();
  destino: any;
  @ViewChild("map") mapElement: ElementRef;
  map: any;
  private service: any = {};
  loggedIn: boolean;

  constructor(
    public navParams: NavParams,
    public auth: AuthProvider,
    private geolocation: Geolocation,
    public events: Events,
    private launchNavigator: LaunchNavigator,
    public toastCtrl: ToastController
  ) {}

  ionViewDidEnter() {
    this.service = this.navParams.get("service");
    this.cant_c = this.navParams.get("cant_c");
    this.positions = this.service.positions;

      this.service = this.navParams.get("service");
      this.cant_c = this.navParams.get("cant_c");
      this.positions = this.service.positions;

      //cargar mapa con posiciones
      if (typeof google !== "undefined") {
          this.loadMap();
      }
  }

  ionViewDidLoad() {
      if (this.auth.getLatitud() != null) {
          this.latitude = this.auth.getLatitud();
          this.longitude = this.auth.getLongitud();
          this.havePosition = true;
      }
      if (typeof google !== "undefined") {
          this.getLocation(this.latitude, this.longitude);
      }
      this.auth.currentPosition.subscribe(
          (data: Geoposition) => {
              this.havePosition = true;
              this.latitude = data.coords.latitude;
              this.longitude = data.coords.longitude;
          },
          (error: Geoposition) => {
              // alert(error);
          }
      );
      this.wacthed = false;

  }

  actualZoom(that) {
    return function(response, status) {
      that.zoom = that.map.getZoom();
    };
  }
/*
  showDistance(event) {
    return function(response, status) {
      if (status == "OK") {
        for (let i = 0; i < response.rows[0].elements.length; i++) {
          const el = document.getElementById("pos" + i);
          el.innerHTML = ": " + response.rows[0].elements[i].distance.text;
        }
      } else {
        // alert("Error: " + status);
      }
    };
  }*/

  // para lanzar el maps
  launchMaps(p) {
    let toast = this.toastCtrl.create({
      message: "Iniciando Google Maps, por favor espere.",
      duration: 2000,
      position: "bottom"
    });
    toast.present();
    let options: LaunchNavigatorOptions = {
      app: this.launchNavigator.APP.GOOGLE_MAPS
    };
    this.launchNavigator
      .navigate([p.latitude, p.longitude], options)
      .then(
        success => console.log("Launched navigator"),
        error => console.log("Error launching navigator", error)
      );
  }
  // mostrar ruta entre 2 puntos
  calculateAndDisplayRoute(p) {
    this.destino = p;
    const end = new google.maps.LatLng(p.latitude, p.longitude);
    this.directionsService.route(
      {
        origin: this.latLng,
        destination: end,
        travelMode: "DRIVING"
      },
      (response, status) => {
        if (status === "OK") {
          this.directionsDisplay.setMap(this.map);
          this.directionsDisplay.setDirections(response);
          this.auth.currentPosition.subscribe(
            (data: Geoposition) => {
              this.latLng = new google.maps.LatLng(
                data.coords.latitude,
                data.coords.longitude
              );
              this.map.setZoom(this.zoom);
              this.currentP.setPosition(this.latLng);
              this.calculateAndDisplayRoute(this.destino);
            },
            (error: Geoposition) => {
              // alert(error);
            }
          );

          // if (!this.wacthed) {
          //   this.watch = this.geolocation.watchPosition({maximumAge: 60000, timeout: 60000})
          //     .filter((p) => p.coords !== undefined)
          //     .subscribe(position => {
          //       this.wacthed = true;
          //       let newPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
          //       if (!this.latLng.equals(newPosition)) {
          //         this.latLng = newPosition;
          //         this.map.setZoom(this.zoom);
          //         this.currentP.setPosition(this.latLng);
          //         this.calculateAndDisplayRoute(this.destino);
          //       }
          //     });
          // }
        } else {
          // window.alert('Directions request failed due to ' + status);
        }
      }
    );
  }

  cancelarRoute() {
    this.directionsDisplay.setMap(null);
    this.destino = null;
    this.wacthed = false;
  }

  loadMap() {
    this.positions = this.service.positionsList;

    var center = new google.maps.LatLng(-0.1911519, -78.4820116);
    if (this.positions.length > 0) {
      center = new google.maps.LatLng(
        this.positions[0].latitude,
        this.positions[0].longitude
      );
    }
    let mapOptions = {
      center: center,
      disableDefaultUI: true,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      fullscreenControl: false,
      streetViewControl: false
    };
    this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);
    this.directionsDisplay.setMap(this.map);
    this.directionsDisplay.setOptions({ suppressMarkers: true });
    this.positions = this.service.positionsList;
    var iconmarker = "https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png";
    if(this.service.subcategoriesList.length>0){
      iconmarker = this.service.subcategoriesList[0].thumb;
    }
    for (let i = 0; i < this.positions.length; i++) {
      let marker = new google.maps.Marker({
          map: this.map,
          icon: iconmarker,
          position: new google.maps.LatLng(
            this.positions[i].latitude,
            this.positions[i].longitude
          )
      });
      let content = "<h4>" + this.positions[i].title + "</h4>";
      this.addInfoWindow(marker, content);
    }

    this.map.addListener("zoom_changed", this.actualZoom(this));
  }

  getLocation(latitude, longitude) {
    this.geolocation.getCurrentPosition().then(resp => {
      this.havePosition = true;
      this.latLng = new google.maps.LatLng(
        resp.coords.latitude,
        resp.coords.longitude
      );
      // this.map.setCenter(this.latLng);
      this.map.setZoom(15);
      this.currentP = new google.maps.Marker({
        map: this.map,
        icon: "assets/icon/location.png",
        position: this.latLng
      });
      let content = "<h4>Mi posición</h4>";
      this.addInfoWindow(this.currentP, content);

      this.destinos = [];
      for (let i = 0; i < this.positions.length; i++) {
        this.destinos.push(
          new google.maps.LatLng(
            this.positions[i].latitude,
            this.positions[i].longitude
          )
        );
      }
     /* this.distanceM.getDistanceMatrix(
        {
          origins: [this.latLng],
          destinations: this.destinos,
          travelMode: "DRIVING"
        },
         this.showDistance(this.events)
      );*/
    });
  }

  addInfoWindow(marker, content) {
    google.maps.event.addListener(marker, "click", () => {
      this.infowindow.setContent(content);
      this.infowindow.open(this.map, marker);
    });
  }
}
