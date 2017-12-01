import { Component } from '@angular/core';
import { NavController, LoadingController,Events,IonicPage} from 'ionic-angular';

import  {ServiceProvider} from  '../../providers/service/service.service';
import { HttpErrorResponse } from "@angular/common/http";
import { ServicePage } from "../service/service";
import { ApiProvider } from "../../providers/api/api";
import { PhotoViewer } from '@ionic-native/photo-viewer';


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
     public load: LoadingController,public events: Events,private photoViewer: PhotoViewer) {
      this.servProv.getServicesFavorites().then(
        data => {
          this.services = data['data'];
        },
        (err: HttpErrorResponse) => {
          if (err.error instanceof Error) {
          }
        });
  }

  ionViewDidLoad() {
    this.baseUrl = this.api.getbaseUrl();

  }
  viewImg(img){
    this.photoViewer.show(this.baseUrl+img);
  }
  openServicePage(id) {
    this.navCtrl.push(ServicePage, {
      serviceId: id
    });
  }
  delete(id){
    //hacer el
    this.servProv.diskMarkfavorite(id).then(
      data => {
        console.log(data);
        this.events.publish('dismark:service', data);
        this.services = this.services.filter(function(item){
          return item.id !== id;
        });
      } );

  }
}
