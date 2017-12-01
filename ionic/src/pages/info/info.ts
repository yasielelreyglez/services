import { Component } from '@angular/core';
import {
  IonicPage,
  NavController,
  NavParams,
  ModalController
} from "ionic-angular";
import { RatePage } from "../rate/rate";
import { CallNumber } from "@ionic-native/call-number";
import { ServiceProvider } from "../../providers/service/service.service";
import { AuthProvider } from "../../providers/auth/auth";

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
  loggedIn: boolean;
  constructor(public auth: AuthProvider, public servPro: ServiceProvider,public navCtrl: NavController,private callNumber: CallNumber, public navParams: NavParams, public modalCtrl: ModalController) {
    this.service = this.navParams.get("service");
    this.baseUrl = this.navParams.get("baseUrl");
  }

  ionViewDidLoad() {
    let tempD=  this.service['week_days'].split(',');
    console.log(tempD);
    for (var index = 0; index < tempD.length; index++) {
      if( index > 0)
       this.serviceDays += ", "+this.days[tempD[index]];
      else
        this.serviceDays += this.days[tempD[index]];
    }
  }

  Llamar(number){
    this.callNumber.callNumber(number, true)
    .then(() => console.log('Launched dialer!'))
    .catch(() => console.log('Error launching dialer'));
  }

  openRate(){
    const profileModal = this.modalCtrl.create(RatePage);
    profileModal.onDidDismiss(data => {
      if(data.rate != "cancel")
      this.servPro.rateservice(this.service.id,data.rate).then(
        data => {
          console.log(data);
        });

    });

    profileModal.present();
  }

}
