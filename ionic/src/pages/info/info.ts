import { Component } from '@angular/core';
import { IonicPage, NavParams} from "ionic-angular";
import {getHorarios} from "../../models/sendService";


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
	serviceDays:any;
  timesList:getHorarios[] = [];
  days : object = {
   0:"Lun",
   1:"Mar",
   2:"Mie",
   3:"Jue",
   4:"Vie",
   5:"Sab",
   6:"Dom",
  };

  constructor(public navParams: NavParams) {
  // this.timesList = new Array(getHorarios);
  }

  ionViewDidLoad() {
    let index;
    this.service = this.navParams.get("service");
    this.cant_c = this.navParams.get("cant_c");
    // this.timesList =this.service.timesList;

    for (let element of this.service.timesList) {
      let str_to_array = element.week_days.split(',');
      for (index = 0; index < str_to_array.length; index++) {

      }
      this.timesList.push({start_time:element.start_time,end_time:element.end_time,week_days:str_to_array})
    }
    console.log(this.timesList);
    console.log("dia ",this.days[this.timesList[1].week_days[1]]);
  }

}
