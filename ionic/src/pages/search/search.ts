import {Component} from '@angular/core';
import {IonicPage, LoadingController, NavController, NavParams} from 'ionic-angular';
import {HttpErrorResponse} from "@angular/common/http";
import {ServiceProvider} from "../../providers/service/service.service";
import {ServicePage} from "../service/service";

/**
 * Generated class for the SearchPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-search',
  templateUrl: 'search.html',
})
export class SearchPage {

  busqueda: any;
  loading: any;
  private services: any;
  private noFound: boolean;

  constructor( public servProv: ServiceProvider,private load: LoadingController,public navCtrl: NavController, public navParams: NavParams) {
     this.busqueda = this.navParams.get("buscar");
  }

  SearchValue(value) {
    this.searchServices(value);
  }
  ionViewDidLoad() {
    this.searchServices(this.busqueda);
  }

  openServicePage(id, index) {
    this.navCtrl.push(ServicePage, {
      service: this.services[index], //paso el service
      serviceId: id,  //si paso el id del servicio para la peticion
    });
  }

  searchServices(query) {
    this.loading = this.load.create({
      content: "Buscando..."
    });
    this.loading.present();
    this.servProv.getServiceBySearch(query).then(
      data => {
        this.services = data['data'];
        this.noFound = this.services.length == 0;
        this.loading.dismiss();
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
          this.loading.dismiss();
        } else {
          this.loading.dismiss();
        }
      });
  }


}
