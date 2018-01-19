import { Component } from '@angular/core';
import {IonicPage, NavController, NavParams, Platform} from 'ionic-angular';
import {PhotoViewer} from "@ionic-native/photo-viewer";

/**
 * Generated class for the PagarPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-pagar',
  templateUrl: 'pagar.html',
})
export class PagarPage {
  membresia:any;
  tipo_p:any;
  codigo:any;
  nombre_t:any;
  numero_t:any;
  private preview: string;
  constructor(public navCtrl: NavController, public navParams: NavParams, public photoViewer: PhotoViewer,private platform: Platform) {
  }
  pagar()
  {
    this.navCtrl.pop().then((valor) =>{
      console.log("atras "+valor);
    });
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
