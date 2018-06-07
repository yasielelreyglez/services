import { Component } from '@angular/core';
import { NavController, NavParams, Platform} from 'ionic-angular';
import {PhotoViewer} from "@ionic-native/photo-viewer";
import {ApiProvider} from '../../providers/api/api';

/**
 * Generated class for the PagarPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

// @IonicPage()
@Component({
  selector: 'page-pagar',
  templateUrl: 'pagar.html',
})
export class PagarPage {
  membresia:any;
  memberships:any;
  tipo_p:any;
  codigo:any;
  nombre_t:any;
  numero_t:any;
  service_id:number
  private preview: string;
  constructor(
      public navCtrl: NavController,
      public navParams: NavParams,
      public photoViewer: PhotoViewer,
      private platform: Platform,
      public apiProv: ApiProvider) {
      this.service_id = this.navParams.get("service");
      this.apiProv.memberships().then((result) => {

        this.memberships = result;
          console.log(result);
      });
  }
  pagar()
  {
      this.apiProv.payService(this.service_id, {
          membership: this.membresia,
          type: this.tipo_p,
          evidence: this.preview
      }).then(result=>{
          this.navCtrl.pop().then((valor) =>{

          });}
      );

  }

  ionViewDidLoad() {
    this.preview = "assets/imgs/service_img.png";

  }
  viewImg() {
    this.platform.ready().then(() => {
      this.photoViewer.show(this.preview);
    });
  }

}
