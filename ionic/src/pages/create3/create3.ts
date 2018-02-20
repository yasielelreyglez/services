import {Component} from '@angular/core';
import {IonicPage, ModalController, NavController, NavParams} from 'ionic-angular';
import {Create4Page} from '../create4/create4';
import {sendService} from '../../models/sendService';
import {ModalHorarioPage} from "../modal-horario/modal-horario";

/**
 * Generated class for the Create3Page page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-create3',
  templateUrl: 'create3.html',
})
export class Create3Page {
  edit: boolean;
  service: sendService;
  week_days = [
    {title: 'Lunes', value: 0},
    {title: 'Martes', value: 1},
    {title: 'Miercoles', value: 2},
    {title: 'Jueves', value: 3},
    {title: 'Viernes', value: 4},
    {title: 'Sabado', value: 5},
    {title: 'Domingo', value: 6},
  ];
  tempDay: any[];

  constructor(public modalCtrl: ModalController, public navCtrl: NavController, public navParams: NavParams) {
    //this.tempDay= this.navParams.get("service")['week_days'].split(',');
    this.service = this.navParams.get("service");
    this.tempDay = [];

  }

  addHorario() {
    const profileModal = this.modalCtrl.create(ModalHorarioPage, {
      horarios:this.service.times
    });
    profileModal.onDidDismiss(data => {
      this.service.times = data.horarios;
    });

    profileModal.present();
  }

  ionViewDidLoad() {

    if (this.navParams.get("service").id) {
      this.edit = true;
      // let daysId = this.service.week_days.split(',');
      // console.log(this.service.week_days);
      // this.service.week_days = [false, false, false, false, false, false, false];
      // this.service.week_days = [false, false, false, false, false, false, false];
      // for (let i = 0; i < daysId.length; i++) {
      //     this.tempDay.push([daysId[i]]);
      // }

    }
    else {

      // this.service.week_days = [false, false, false, false, false, false, false];
    }


  }

  goToCreate2() {
    this.navCtrl.pop();
  }

  goToCreate4() {

    // llenar los dias
    for (let value of this.tempDay) {
      // this.service.week_days[value] = true;
    }
    this.navCtrl.push(Create4Page, {
      service: this.service
    });
  }


}
