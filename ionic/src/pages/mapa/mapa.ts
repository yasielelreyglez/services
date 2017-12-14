import {Component, ViewChild, ElementRef} from '@angular/core';
import {
  Platform,
  IonicPage,
  NavParams
} from "ionic-angular";

import {Geolocation} from '@ionic-native/geolocation';
import {Position} from "../../models/position";
import { Events } from 'ionic-angular';

declare var google;

@IonicPage()
@Component({
  selector: 'page-mapa',
  templateUrl: 'mapa.html',
})
export class MapaPage {
  currentP: any;
  cant_c: any;
  locations: Position[] = []
  positions: Position[] = [];
  infowindow = new google.maps.InfoWindow;
  response: any;
  latLng: any;
  directionsService = new google.maps.DirectionsService;
  directionsDisplay = new google.maps.DirectionsRenderer;
  distanceM = new google.maps.DistanceMatrixService();
  destino:any;
  // distanceMatrix = new google.maps.DistanceMatrixService;
  @ViewChild('map') mapElement: ElementRef;
  map: any;
  private service: any = {};
  // latitude:any
  // longitude:any;
  loggedIn: boolean;

  constructor(  private platform: Platform,

              public navParams: NavParams,

              private geolocation: Geolocation,public events: Events) {

    platform.ready().then(() => {

    });
  }

  ionViewDidLoad() {
    this.service = this.navParams.get("service");
    this.cant_c = this.navParams.get("cant_c");

    this.response = this.navParams.get("response");
    this.positions = this.service.positions;

    this.geolocation.getCurrentPosition().then((resp) => {
      //agrgando los positions del servicio
      this.loadMap();
      //agregando el current
      this.latLng = new google.maps.LatLng(resp.coords.latitude, resp.coords.longitude);
      this.map.setCenter(this.latLng);
      this.map.setZoom(15);
      this.currentP = new google.maps.Marker({
        map: this.map,
         icon: "http://www.googlemapsmarkers.com/v1/009900/",
        position: this.latLng
      });
      let content = "<h4>Mi posición</h4>";
      this.addInfoWindow(this.currentP, content);

      var destinos = [];
      for (let i = 0; i < this.positions.length; i++) {
        destinos.push(new google.maps.LatLng(this.positions[i].latitude,this.positions[i].longitude));
      }
      this.distanceM.getDistanceMatrix(
        {
          origins: [this.latLng],
          destinations: destinos,
          travelMode: 'DRIVING'
        },this.showDistance(this.events));

    });

    let watch = this.geolocation.watchPosition();
    watch.subscribe((data) => {

     this.latLng = new google.maps.LatLng(data.coords.latitude, data.coords.longitude);
     this.map.setCenter(this.latLng);
     this.map.setZoom(15);
     this.currentP.setPosition(this.latLng);
     var destinos = [];
     for (let i = 0; i < this.positions.length; i++) {
      destinos.push(new google.maps.LatLng(this.positions[i].latitude,this.positions[i].longitude));
    }
     this.distanceM.getDistanceMatrix(
      {
        origins: [this.latLng],
        destinations: destinos,
        travelMode: 'DRIVING'
      },this.showDistance(this.events));

      if (this.destino !== undefined) {
        this.calculateAndDisplayRoute(this.destino);
      }

    });


  }

  showDistance(event) {
     return function(response, status) {
      if(status == "OK"){

        for (let i = 0; i < response.rows[0].elements.length; i++) {
          var el = document.getElementById('pos'+i);
          el.innerHTML = ":"+response.rows[0].elements[i].distance.text;
        }

      } else {
          alert("Error: " + status);
      }
  }
}

  // mostrar ruta entre 2 puntos
  calculateAndDisplayRoute(p) {
    this.destino=p;
    var end = new google.maps.LatLng(p.latitude, p.longitude);
    this.directionsService.route({
      origin: this.latLng,
      destination: end,
      travelMode: 'DRIVING'
    }, (response, status) => {
      if (status === 'OK') {
        this.directionsDisplay.setDirections(response);
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
  }


  loadMap() {
    let mapOptions = {
      center: this.latLng,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);
    this.directionsDisplay.setMap(this.map);
    this.directionsDisplay.setOptions({suppressMarkers: true});
    this.positions = this.response.data.positionsList;

    for (let i = 0; i < this.positions.length; i++) {
      let marker = new google.maps.Marker({
        map: this.map,
        position: new google.maps.LatLng(this.positions[i].latitude, this.positions[i].longitude)
      });
      let content = "<h4>" + this.positions[i].title + "</h4>";
      this.addInfoWindow(marker, content);
    }
  }

  getLocation() {
    this.geolocation.getCurrentPosition().then((resp) => {
      this.latLng = new google.maps.LatLng(resp.coords.latitude, resp.coords.longitude);
      this.map.setCenter(this.latLng);
      this.map.setZoom(15);
      let marker = new google.maps.Marker({
        map: this.map,
        position: this.latLng
      });
      let content = "<h4>Mi posición</h4>";
      this.addInfoWindow(marker, content);
    }).catch((error) => {
      console.log('Error getting location', error);
    });

  }

  addInfoWindow(marker, content) {

    google.maps.event.addListener(marker, 'click', () => {
      this.infowindow.setContent(content)
      this.infowindow.open(this.map, marker);
    });

  }

}
