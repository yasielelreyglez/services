import { Component } from '@angular/core';
import { IonicPage, NavController, LoadingController } from "ionic-angular";
import  {ServiceProvider} from  '../../providers/service/service.service';
import { HttpErrorResponse } from "@angular/common/http";
import { ApiProvider } from "../../providers/api/api";

@IonicPage()
@Component({
  selector: 'page-busqueda',
  templateUrl: 'busqueda.html',
})
export class BusquedaPage {
  services = [];
  baseUrl: any;
  email: any;
  token: any;
  haveServices = false;

  constructor(public navCtrl: NavController,

    public api: ApiProvider,
    public servProv: ServiceProvider,public load: LoadingController) {

      this.baseUrl = api.getbaseUrl() ;


  }

  ionViewDidLoad() {
    let loading = this.load.create({
      content: "Cargando..."
    });
    loading.present();
    this.servProv.getServicesVisited().then(
      data => {
        this.services = data['data'];
        loading.dismiss();
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
        } else {
        }
      });
  }

}
