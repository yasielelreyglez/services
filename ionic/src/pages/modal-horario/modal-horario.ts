import { Component } from '@angular/core';
import {IonicPage, NavController, NavParams, ViewController} from 'ionic-angular';

/**
 * Generated class for the ModalHorarioPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-modal-horario',
  templateUrl: 'modal-horario.html',
})
export class ModalHorarioPage {

  constructor(public viewCtrl: ViewController,public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ModalHorarioPage');
  }
  close() {
    let data = {'close': true};
    this.viewCtrl.dismiss(data);
  }

}
