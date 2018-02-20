import {Component} from '@angular/core';
import {Platform} from 'ionic-angular';
import {StatusBar} from '@ionic-native/status-bar';
import {SplashScreen} from '@ionic-native/splash-screen';
import {TabPage} from "../pages/tab/tab";
import {Events} from 'ionic-angular';
import {Geolocation} from "@ionic-native/geolocation";


declare var google;

@Component({
  templateUrl: "app.html"
})
export class MyApp {
  // rootPage: any = HomePage;
  rootPage: any = TabPage;
  latLng: any;
  watch: any;

  constructor(public geolocation: Geolocation,
              platform: Platform,
              statusBar: StatusBar,
              splashScreen: SplashScreen, public events: Events) {
    // splashScreen.show();
    // this.splah = splashScreen;
    platform.ready().then(() => {
      // Okay, so the platform is ready and our plugins are available.
      // Here you can do any higher level native things you might need.
      statusBar.styleDefault();
      statusBar.overlaysWebView(false);
      // statusBar.backgroundColorByHexString('#ffffff');
      // setTimeout(function(){
      // splashScreen.hide();
      // }, 5000);
     // this.getUserPosition();
    });

  }

  getUserPosition() {

    this.geolocation.watchPosition()
      // .filter((p) => p.coords !== undefined)
      .subscribe(position => {
        let newPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        this.events.publish('current:position',newPosition)
      });
  }
}

