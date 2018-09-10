import { Component } from "@angular/core";
import { IonicPage, NavController, NavParams } from "ionic-angular";
import { ApiProvider } from "../../providers/api/api";
import { HttpErrorResponse } from "@angular/common/http";
import { ServicePage } from "../service/service";

/**
 * Generated class for the BuzonPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: "page-buzon",
  templateUrl: "buzon.html"
})
export class BuzonPage {
  mensajes: any;

  constructor(
    public api: ApiProvider,
    public navCtrl: NavController,
    public navParams: NavParams
  ) {}

  ionViewDidLoad() {
    this.buscarMensajes();
  }

  inicioM(msg: string) {
    if (msg.split("sobre su servicio")[0]){
      return msg.split("sobre su servicio")[0] + "sobre su servicio ";
    }
    return msg;
  }

  finM(msg: string) {
    if (msg.split("sobre su servicio")[1]){
      return msg.split("sobre su servicio")[1];
    }
    return "";
  }

  buscarMensajes() {
    this.api.mensajes().then(
      data => {
        this.mensajes = data;
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
          console.log(err);
        }
      }
    );
  }

  servicioLeido(idMsg) {
    this.api.leerMensajes(idMsg).then(data => {
      if (data) this.buscarMensajes();
    });
  }

  verServicio(id, idMsg, estado) {
    this.api.getService(id).then(data => {
      let service = data["data"];
      if (estado == "0") {
        this.servicioLeido(idMsg);
      }
      this.navCtrl.push(ServicePage, {
        service: service, //paso el service
        serviceId: id, //si paso el id del servicio para la peticion
        parentPage: this
      });
    });
  }

  deleteMensajes(id) {
    this.api.deleteMensajes(id).then(respose => {
      if (respose)
        this.mensajes = this.mensajes.filter(function(item) {
          return item.id !== id;
        });
      else console.log("error");
    });
  }
}
