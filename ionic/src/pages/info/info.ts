import { Component } from '@angular/core';
import {
  IonicPage,
  NavController,
  NavParams,
  ModalController
} from "ionic-angular";
import { RatePage } from "../rate/rate";

/**
 * Generated class for the InfoPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-info',
  templateUrl: 'info.html'
})
export class InfoPage {
  private service: any = {};
  private baseUrl: any;
	serviceDays: string = "";
  days : object = {
   0:"Domingo",
   1:"Lunes",
   2:"Martes",
   3:"Miercoles",
   4:"Jueves",
   5:"Viernes",
   6:"Sabado",
  };
  constructor(public navCtrl: NavController, public navParams: NavParams, public modalCtrl: ModalController) {
    this.service = this.navParams.get("service");
    this.baseUrl = this.navParams.get("baseUrl");
    let tempD=  this.service.week_days.split(',');
    for (var index = 0; index < tempD.length; index++) {
      if( index > 0)
       this.serviceDays += ", "+this.days[tempD[index]];
      else
        this.serviceDays += this.days[tempD[index]];
    }

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
