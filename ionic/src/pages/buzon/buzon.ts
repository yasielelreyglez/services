import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams} from 'ionic-angular';
import {ApiProvider} from "../../providers/api/api";
import {HttpErrorResponse} from "@angular/common/http";

/**
 * Generated class for the BuzonPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-buzon',
  templateUrl: 'buzon.html',
})
export class BuzonPage {

  mensajes: any;

  constructor(public api: ApiProvider, public navCtrl: NavController, public navParams: NavParams) {
    this.api.mensajes().then(
      data => {
        this.mensajes = data;
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
          console.log(err)
        }
      }
    );
  }

  ionViewDidLoad() {

  }

  deleteMensajes(id) {
    this.api.deleteMensajes(id).then(
      respose=>{
        if (respose)
          this.mensajes = this.mensajes.filter(function (item) {
            return item.id !== id;
          });
        else
          console.log("error");
      }
    );

  }
}
