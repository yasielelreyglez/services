import {Component} from '@angular/core';
import {Platform} from 'ionic-angular';
import {StatusBar} from '@ionic-native/status-bar';
import {SplashScreen} from '@ionic-native/splash-screen';
import {TabPage} from "../pages/tab/tab";
import { Events } from 'ionic-angular';

@Component({
  templateUrl: "app.html"
})
export class MyApp {
  // rootPage: any = HomePage;
  rootPage: any = TabPage;

  constructor(platform: Platform,
              statusBar: StatusBar,
              splashScreen: SplashScreen, events: Events) {
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

      // setInterval(function () {
      //
      //   events.publish('user:created',Date.now());
      // }, 5000);
    });
  }
}

