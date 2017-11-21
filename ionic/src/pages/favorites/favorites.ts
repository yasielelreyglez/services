import { Component } from '@angular/core';
import { NavController, LoadingController} from 'ionic-angular';

import  {ServiceProvider} from  '../../providers/service/service.service';
import { HttpErrorResponse } from "@angular/common/http";
import { ServicePage } from "../service/service";
import { ApiProvider } from "../../providers/api/api";

/**
 * Generated class for the FavoritesPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@Component({
  selector: 'page-favorites',
  templateUrl: 'favorites.html',
})
export class FavoritesPage {
  // declaracion de variables
  services = [];
  baseUrl: any;
  email: any;
  token: any;


  constructor(
    public navCtrl: NavController,
    public api: ApiProvider,
     public servProv: ServiceProvider,
     public load: LoadingController) {

      this.baseUrl = this.api.getbaseUrl() + "resources/image/";

  }

  ionViewDidLoad() {
    this.servProv.getServicesFavorites().then(
      data => {
        this.services = data['data'];
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
        }
      });
  }
  openServicePage(id) {
    this.navCtrl.push(ServicePage, {
      serviceId: id
    });
  }
}
