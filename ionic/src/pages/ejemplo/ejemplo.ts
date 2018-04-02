import { Component, ViewChild, ElementRef } from '@angular/core';
import { IonicPage } from 'ionic-angular';
import { NavController } from 'ionic-angular';
import { SplashScreen } from "@ionic-native/splash-screen";
/**
 * Generated class for the EjemploPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
declare var google;
@IonicPage()
@Component({
  selector: "page-ejemplo",
  templateUrl: "ejemplo.html"
})
export class EjemploPage {

  @ViewChild('map') mapElement: ElementRef;
  map: any;
  directionsService = new google.maps.DirectionsService;
  directionsDisplay = new google.maps.DirectionsRenderer;
  distanceMatrix = new google.maps.DistanceMatrixService;

  constructor(public navCtrl: NavController,splashScreen: SplashScreen) {
    splashScreen.hide();
  }

  ionViewDidLoad(){
    this.initMap();
  }

  initMap() {
    let cuba = new google.maps.LatLng(-0.1911519, -78.4820116);
    this.map = new google.maps.Map(this.mapElement.nativeElement, {
      zoom: 7,
      center: cuba
    });

    this.directionsDisplay.setMap(this.map);


    // pa la distancia entre 2 puntos
    var from = new google.maps.LatLng(-0.1911519, -78.4820116);
    // var from = new google.maps.LatLng(46.5610058, 26.9098054);

    var dest = new google.maps.LatLng(-0.1911519, -78.4820116);
    var dest2 = new google.maps.LatLng(-0.1911519, -78.4820116);
    // var dest = new google.maps.LatLng(44.391403, 26.1157184);


    var distanceM = new google.maps.DistanceMatrixService();
    distanceM.getDistanceMatrix(
        {
            origins: [from],
            destinations: [dest,dest2],
            travelMode: 'DRIVING'
        }, this.callbakc);

  }

callbakc (response, status){
  console.log(response);
}

// mostrar ruta entre 2 puntos
  calculateAndDisplayRoute() {
    var start = new google.maps.LatLng(-0.1911519, -78.4820116);
    //var end = new google.maps.LatLng(38.334818, -181.884886);
    var end = new google.maps.LatLng(-0.1911519, -78.4820116);
    this.directionsService.route({
      origin: start,
      destination:  end,
      travelMode: 'DRIVING'
    }, (response, status) => {
      if (status === 'OK') {
        this.directionsDisplay.setDirections(response);
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
  }

}
