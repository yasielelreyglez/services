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
  start = 'chicago, il';
  end = 'chicago, il';
  directionsService = new google.maps.DirectionsService;
  directionsDisplay = new google.maps.DirectionsRenderer;

  constructor(public navCtrl: NavController,splashScreen: SplashScreen) {
    splashScreen.hide();
  }

  ionViewDidLoad(){
    this.initMap();
  }

  initMap() {
    let cuba = new google.maps.LatLng(23.11941, -82.32134);
    this.map = new google.maps.Map(this.mapElement.nativeElement, {
      zoom: 7,
      center: cuba
    });

    this.directionsDisplay.setMap(this.map);
  }

  calculateAndDisplayRoute() {
    var start = new google.maps.LatLng(23.11941, -82.32134);
    //var end = new google.maps.LatLng(38.334818, -181.884886);
    var end = new google.maps.LatLng(23.10229, -82.34885);
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
