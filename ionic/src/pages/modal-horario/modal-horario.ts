///<reference path="../../models/horarios.ts"/>
import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams, ViewController} from 'ionic-angular';
import {Horario} from "../../models/horarios";

@IonicPage()
@Component({
  selector: 'page-modal-horario',
  templateUrl: 'modal-horario.html',
})
export class ModalHorarioPage {
  horarios: Horario[] = [];
  end_time: any;
  start_time: any;

  week_days = [
    {title: 'Lunes', value: 0},
    {title: 'Martes', value: 1},
    {title: 'Miercoles', value: 2},
    {title: 'Jueves', value: 3},
    {title: 'Viernes', value: 4},
    {title: 'Sabado', value: 5},
    {title: 'Domingo', value: 6},
  ];
  days ={

    0:"Lun",
    1:"Mar",
    2:"Mie",
    3:"Jue",
    4:"Vie",
    5:"Sab",
    6:"Dom"
  };
  tempDay: any;

  constructor(public viewCtrl: ViewController, public navCtrl: NavController, public navParams: NavParams) {

  }

  ionViewDidLoad() {
    //this.service.week_days = [false, false, false, false, false, false, false];
    this.tempDay = [];
  }

  close() {
    let data = {'horarios': this.horarios};
    this.viewCtrl.dismiss(data);
  }

  addHorario() {
    this.horarios.push({weekdays: this.tempDay, end_time: this.end_time, start_time: this.start_time});
    this.tempDay = [];
    this.end_time = null;
    this.start_time = null;
  }

  deleteHorario(pos: number) {
    this.horarios.splice(pos, 1);

  }

}
