import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { Create3Page } from '../create3/create3';
import { sendService } from '../../models/sendService';

/**
 * Generated class for the Create2Page page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-create2',
  templateUrl: 'create2.html',
})
export class Create2Page {
  service: sendService;
  constructor(public navCtrl: NavController, public navParams: NavParams) {
    this.service = this.navParams.get("service");
    console.log(this.service);
  }

  ionViewDidLoad() {

  }
  goToCreate1(){
    this.navCtrl.pop();
  }
  goToCreate3(){
    console.log(this.service);
      this.navCtrl.push(Create3Page, {
        service: this.service
      });
  }

}
