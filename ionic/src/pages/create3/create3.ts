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
  edit: boolean = false;
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
    this.service = this.navParams.get("service");
    this.tempDay = [];

  }

  addHorario() {
    let profileModal = this.modalCtrl.create(ModalHorarioPage, {
      horarios:this.service.times,
      edit_times:this.service.timesList
    });
    profileModal.onDidDismiss(data => {
      this.service.times = data.horarios;
      this.service.timesList = [];
    });

    profileModal.present();
  }

  ionViewDidLoad() {
    this.service.times=[];
    if (this.navParams.get("service").id) {
      this.edit = true;
    }
  }

  goToCreate2() {
    this.navCtrl.pop();
  }

  goToCreate4() {
    console.log(this.service);
    this.navCtrl.push(Create4Page, {
      service: this.service
    });
  }


}
