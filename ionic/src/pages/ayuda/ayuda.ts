import { Component } from "@angular/core";
import { IonicPage, NavController, NavParams } from "ionic-angular";
import { ServicePage } from "../service/service";
import {ServiceProvider} from '../../providers/service/service.service';

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
  preguntas = "http://faq.losyp.com";
  terminos = "http://terminos.losyp.com";
  politicas= "http://certificacion.losyp.com";

  constructor(public navCtrl: NavController, public navParams: NavParams,public servProv: ServiceProvider) {
      // this.preguntas = this.servProv.getBaseUrl()+"faq";
      // this.politicas = this.servProv.getBaseUrl()+"politicas";
  }

  ionViewDidLoad() {
  }

  mensajeAdmin() {
    this.msgAdmin = "mailto:info@losyp.com?subject=DesdeLosyp&body=" + this.msg;
  }
}
