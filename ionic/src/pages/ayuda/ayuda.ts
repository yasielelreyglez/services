import { Component } from "@angular/core";
import { IonicPage, NavController, NavParams } from "ionic-angular";

/**
 * Generated class for the AyudaPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: "page-ayuda",
  templateUrl: "ayuda.html"
})
export class AyudaPage {
  msg = "";
  msgAdmin = "";
  constructor(public navCtrl: NavController, public navParams: NavParams) {}

  ionViewDidLoad() {
  }

  mensajeAdmin() {
    this.msgAdmin = "mailto:info@losyp.com?subject=DesdeLosyp&body=" + this.msg;
  }
}
