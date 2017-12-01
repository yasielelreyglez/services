import { Component } from '@angular/core';
import {
  IonicPage,
  NavController,
  NavParams,
  ViewController
} from "ionic-angular";


/**
 * Generated class for the RatePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-rate',
  templateUrl: 'rate.html',
})
export class RatePage {
  value: number = 1;

  constructor(public navCtrl: NavController, public viewCtrl: ViewController,public navParams: NavParams) {
  }

  ionViewDidLoad() {
  }
  close(){
    let data = { 'rate': "cancel" };
    this.viewCtrl.dismiss(data);
  }

  starClicked(value){
    this.value = value;

  }
  sendRate(){
    let data = { 'rate': this.value };
    this.viewCtrl.dismiss(data);
  }


}
