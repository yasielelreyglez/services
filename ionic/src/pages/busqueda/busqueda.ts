import { Component } from '@angular/core';
import { IonicPage, NavController, LoadingController, Platform } from "ionic-angular";
import  {ServiceProvider} from  '../../providers/service/service.service';
import { HttpErrorResponse } from "@angular/common/http";
import { PhotoViewer } from '@ionic-native/photo-viewer';
import {ServicePage} from "../service/service";

@IonicPage()
@Component({
  selector: 'page-busqueda',
  templateUrl: 'busqueda.html',
})
export class BusquedaPage {
  services = [];
  temp=[]
  email: any;
  token: any;
  haveServices = false;


  constructor(public navCtrl: NavController,
    public servProv: ServiceProvider,
    public load: LoadingController,
    private photoViewer: PhotoViewer,private platform: Platform) {
  }

  openServicePage(id,index) {
    this.navCtrl.push(ServicePage, {
      service: this.services[index], //paso el service
      serviceId: id,  //si paso el id del servicio para la peticion
    });
  }

  ionViewDidLoad() {
    let loading = this.load.create({
      content: "Cargando..."
    });
    loading.present();
    this.servProv.getServicesVisited().then(
      data => {
        this.services = data['data'];
        this.temp=this.services;
        loading.dismiss();

      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
          loading.dismiss();
        } else {
          loading.dismiss();
        }
      });
  }
  getSearchValue(value) {

    this.services=this.temp;
    if (value && value.trim() != '' ) {
      this.services = this.services.filter((item) => {
        return (item.title.toLowerCase().indexOf(value.toLowerCase()) > -1);
      })
    }
}
  viewImg(img) {
    this.platform.ready().then(() => {
    this.photoViewer.show( img);
    });
  }
  delete(id){
    //hacer el
    // this.servProv.diskMarkfavorite(id).then(
    //   data => {
    //     this.events.publish('dismark:favorite', id);
        this.services = this.services.filter(function(item){
          return item.id !== id;
        });
    //   }
    // );
  }

}
