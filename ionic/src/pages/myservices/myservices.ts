import { Component } from '@angular/core';
import { IonicPage, NavController, LoadingController } from "ionic-angular";
import  {ServiceProvider} from  '../../providers/service/service.service';
import { ApiProvider } from "../../providers/api/api";

@IonicPage()
@Component({
  selector: 'page-myservices',
  templateUrl: 'myservices.html',
})
export class MyservicesPage {
  // declaracion de variables
  services = [];
  baseUrl: any;
  email: any;
  token: any;
  constructor(public navCtrl: NavController,
    public api: ApiProvider,
    public servProv: ServiceProvider,public load: LoadingController) {
      let loading = this.load.create({
        content: "Cargando..."
      });
      loading.present();
      this.baseUrl = api.getbaseUrl();

      this.servProv.getMyServices().then(
        (serv) => {
          this.services = serv['data'];
          loading.dismiss();
        }
      ).catch(
        (error) => {}
      );
  }

  ionViewDidLoad() {
  }

}
