import {Component} from '@angular/core';
import {NavController, LoadingController, Events, Platform} from 'ionic-angular';

import {ServiceProvider} from '../../providers/service/service.service';
import {HttpErrorResponse} from "@angular/common/http";
import {ServicePage} from "../service/service";
import {PhotoViewer} from '@ionic-native/photo-viewer';


@Component({
  selector: 'page-favorites',
  templateUrl: 'favorites.html',
})
export class FavoritesPage {
  // declaracion de variables
  services = [];
  temp = []
  email: any;
  token: any;


  constructor(public navCtrl: NavController,
              public servProv: ServiceProvider,
              public load: LoadingController, public events: Events, private photoViewer: PhotoViewer, private platform: Platform) {
    this.servProv.getServicesFavorites().then(
      data => {
        this.services = data['data'];
        this.temp = this.services;
      },
      (err: HttpErrorResponse) => {
      });
  }

  getSearchValue(value) {

    this.services = this.temp;
    if (value && value.trim() == '') {
      this.services = this.temp;
    }
    if (value && value.trim() != '') {
      this.services = this.services.filter((item) => {
        return (item.title.toLowerCase().indexOf(value.toLowerCase()) > -1);
      })
    }
  }

  viewImg(img) {
    this.platform.ready().then(() => {
      this.photoViewer.show(img);
    });
  }

  openServicePage(id, index) {
    this.navCtrl.push(ServicePage, {
      service: this.services[index], //paso el service
      serviceId: id,  //si paso el id del servicio para la peticion
      parentPage: this
    });

  }

  delete(id) {
    //hacer el
    this.servProv.diskMarkfavorite(id).then(
      data => {
        this.events.publish('dismark:favorite', id);
        this.services = this.services.filter(function (item) {
          return item.id !== id;
        });
      }
    );
  }
}
