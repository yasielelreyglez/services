import {Component } from '@angular/core';
import {
  IonicPage, Keyboard,
  NavController,
  NavParams,
  ViewController
} from "ionic-angular";



@IonicPage()
@Component({
  selector: 'page-rate',
  templateUrl: 'rate.html',
})
export class RatePage {
  value: number;
  comment: any;

  constructor( public keyboard: Keyboard,public navCtrl: NavController, public viewCtrl: ViewController, public navParams: NavParams) {
  }


  ionViewDidLoad() {
    this.value = this.navParams.get("rated") ? this.navParams.get("rated") : 1;
    this.keyboard;
  }

  close() {
    let data = {'rate': "cancel"};
    this.viewCtrl.dismiss(data);
  }

  starClicked(value) {
    this.value = value;
  }

  sendRate() {
    let data = {'rate': this.value,'comment':this.comment};
    this.viewCtrl.dismiss(data);
  }


}
