import { Component } from '@angular/core';
import { IonicPage, NavController, LoadingController, ViewController, App } from "ionic-angular";
import  {ServiceProvider} from  '../../providers/service/service.service';
import { ApiProvider } from "../../providers/api/api";
import { ServicePage } from '../service/service';

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
  constructor(  public viewCtrl: ViewController,
    public navCtrl: NavController,
    public appCtrl: App,
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

  openServicePage(id,serv) {
        //this.navCtrl.push(FavoritesPage,);
        this.viewCtrl.dismiss();
        // this.appCtrl.getRootNav().push(FavoritesPage);

        this.appCtrl.getActiveNavs()[0].push(ServicePage, {
          serviceId: id,
          service:serv
        });
    // this.navCtrl.push(ServicePage, {
    //   serviceId: id,
    //   service:serv
    // });
  }

}
