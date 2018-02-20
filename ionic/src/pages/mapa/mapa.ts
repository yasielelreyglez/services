import {Component, ViewChild, ElementRef} from '@angular/core';
import {
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
  wacthed: any;
  watch:any;
  latLng: any;
  currentP: any;
  havePosition: boolean;
  destinos: any[];
  zoom:any =15;
  cant_c: any;
  positions: Position[] = [];
  infowindow = new google.maps.InfoWindow;
  directionsService = new google.maps.DirectionsService;
  directionsDisplay = new google.maps.DirectionsRenderer;
  distanceM = new google.maps.DistanceMatrixService();
  destino:any;
  @ViewChild('map') mapElement: ElementRef;
  map: any;
  private service: any = {};
  loggedIn: boolean;

  constructor( public navParams: NavParams,
              private geolocation: Geolocation,public events: Events) {
  }
  ionViewDidEnter(){
    this.getLocation();
  }
  ionViewDidLoad() {
    this.wacthed=false;
    this.service = this.navParams.get("service");
    this.cant_c = this.navParams.get("cant_c");
    this.positions = this.service.positions;
    //cargar mapa con posiciones
    this.loadMap();
  }


  actualZoom(that) {
    return function(response, status) {
      that.zoom= that.map.getZoom();
   }
}
  showDistance(event) {
     return function(response, status) {
      if(status == "OK"){

        for (let i = 0; i < response.rows[0].elements.length; i++) {
          const el = document.getElementById('pos' + i);
          el.innerHTML = ": "+response.rows[0].elements[i].distance.text;
        }

      } else {
          alert("Error: " + status);
      }
  }
}

  // mostrar ruta entre 2 puntos
  calculateAndDisplayRoute(p) {
    this.destino=p;
    const end = new google.maps.LatLng(p.latitude, p.longitude);
    this.directionsService.route({
      origin: this.latLng,
      destination: end,
      travelMode: 'DRIVING'
    }, (response, status) => {
      if (status === 'OK') {
        this.directionsDisplay.setMap(this.map);
        this.directionsDisplay.setDirections(response);
        if (!this.wacthed) {
          this.watch = this.geolocation.watchPosition({maximumAge :60000,timeout:60000})
          .filter((p) => p.coords !== undefined)
          .subscribe(position => {
              this.wacthed=true;
               let newPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
               if(!this.latLng.equals( newPosition ))
               {
                 console.log("muevete");
                this.latLng = newPosition;
                this.map.setZoom(this.zoom);
                this.currentP.setPosition(this.latLng);
                this.calculateAndDisplayRoute(this.destino);
               }
          });
        }


      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
  }

  cancelarRoute(){
    this.directionsDisplay.setMap(null);
    this.destino=null;
    this.watch.unsubscribe();
    this.wacthed=false;
  }

  loadMap() {
    let mapOptions = {
      center: new google.maps.LatLng(23.13302, -82.38304),
      disableDefaultUI: true,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);
    this.directionsDisplay.setMap(this.map);
    this.directionsDisplay.setOptions({suppressMarkers: true});
    this.positions = this.service.positionsList;

    for (let i = 0; i < this.positions.length; i++) {
      let marker = new google.maps.Marker({
        map: this.map,
        position: new google.maps.LatLng(this.positions[i].latitude, this.positions[i].longitude)
      });
      let content = "<h4>" + this.positions[i].title + "</h4>";
      this.addInfoWindow(marker, content);
    }

    this.map.addListener('zoom_changed', this.actualZoom(this) );

  }
  getLocation() {
    this.geolocation.getCurrentPosition().then((resp) => {
      this.havePosition=true;
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

      this.destinos = [];
      for (let i = 0; i < this.positions.length; i++) {
        this.destinos.push(new google.maps.LatLng(this.positions[i].latitude,this.positions[i].longitude));
      }
      this.distanceM.getDistanceMatrix(
        {
          origins: [this.latLng],
          destinations: this.destinos,
          travelMode: 'DRIVING'
        },this.showDistance(this.events));
    });

  }

  addInfoWindow(marker, content) {

    google.maps.event.addListener(marker, 'click', () => {
      this.infowindow.setContent(content)
      this.infowindow.open(this.map, marker);
    });

  }

}
