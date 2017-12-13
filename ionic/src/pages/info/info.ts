import { Component } from '@angular/core';
import { IonicPage, NavParams} from "ionic-angular";


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
  cant_c:any;
	serviceDays: string="";
  days : object = {
   0:"Lunes",
   1:"Martes",
   2:"Miercoles",
   3:"Jueves",
   4:"Viernes",
   5:"Sabado",
   6:"Domingo",
  };

  constructor(public navParams: NavParams) {

  }

  ionViewDidLoad() {
    this.service = this.navParams.get("service");
    this.cant_c = this.navParams.get("cant_c");

    if (this.service['week_days']) {


    let tempD=  this.service['week_days'].split(',');

      for (var index = 0; index < tempD.length; index++) {
        if( index > 0)
        this.serviceDays += ", "+this.days[tempD[index]];
        else
          this.serviceDays += this.days[tempD[index]];
      }
    }
  }

}
