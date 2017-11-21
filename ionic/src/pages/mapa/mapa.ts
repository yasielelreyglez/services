import { Component } from '@angular/core';
import {
  Platform,
  IonicPage,
  NavController,
  NavParams,
  ModalController
} from "ionic-angular";
import { RatePage } from "../rate/rate";
import { Geolocation } from '@ionic-native/geolocation';

@IonicPage()
@Component({
  selector: 'page-mapa',
  templateUrl: 'mapa.html',
})
export class MapaPage {
  private service: any = {};
  private baseUrl: any;
  latitude:any
  longitude:any;
  constructor(private platform: Platform,
    public navCtrl: NavController,
     public navParams: NavParams,
     public modalCtrl: ModalController,
     private geolocation: Geolocation) {

    this.service = this.navParams.get("service");
    this.baseUrl = this.navParams.get("baseUrl");
    platform.ready().then(() => {
      // get current position
      geolocation.getCurrentPosition().then(pos => {
        console.log('lat: ' + pos.coords.latitude + ', lon: ' + pos.coords.longitude);
        this.latitude = pos.coords.latitude;
        this.longitude = pos.coords.longitude;
      });
      const watch = geolocation.watchPosition().subscribe(pos => {
        console.log('lat: ' + pos.coords.latitude + ', lon: ' + pos.coords.longitude);
        this.latitude = pos.coords.latitude;
        this.longitude = pos.coords.longitude;
      });

    });
}

  ionViewDidLoad() {
    console.log('ionViewDidLoad InfoPage');
  }

  openRate(){
    const profileModal = this.modalCtrl.create(RatePage);
    profileModal.onDidDismiss(data => {
      // enviar rate
      console.log(data);
    });

    profileModal.present();
  }

}
