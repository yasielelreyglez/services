import { Component } from '@angular/core';
import { IonicPage, NavController, LoadingController, Platform } from "ionic-angular";
import  {ServiceProvider} from  '../../providers/service/service.service';
import { HttpErrorResponse } from "@angular/common/http";
import { PhotoViewer } from '@ionic-native/photo-viewer';

@IonicPage()
@Component({
  selector: 'page-busqueda',
  templateUrl: 'busqueda.html',
})
export class BusquedaPage {
  services = [];

  email: any;
  token: any;
  haveServices = false;


  constructor(public navCtrl: NavController,


    public servProv: ServiceProvider,public load: LoadingController,private photoViewer: PhotoViewer,private platform: Platform) {




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
