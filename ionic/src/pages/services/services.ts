import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams, LoadingController, AlertController, Events, Platform} from 'ionic-angular';
import {ServiceProvider} from '../../providers/service/service.service';
import {AuthProvider} from '../../providers/auth/auth';
import {ServicePage} from "../service/service";
import {HttpErrorResponse} from "@angular/common/http";
import {ApiProvider} from "../../providers/api/api";
import {PhotoViewer} from '@ionic-native/photo-viewer';

@IonicPage()
@Component({
  selector: "page-services",
  templateUrl: "services.html"
})
export class ServicesPage {
  catOptions: { title: string };
  citiestOptions: { title: string };

  cities: any;
  categories: any;

  city: any;
  category: any;
  didLoad:number=-1;
  subCatId: any;
  services: any;
  categoryId: any;
  baseUrl: any;
  loggedIn: boolean;
  option: any;

  constructor(public navCtrl: NavController,
              public auth: AuthProvider,
              public api: ApiProvider,
              public navParams: NavParams,
              public servProv: ServiceProvider,
              public load: LoadingController,
              private photoViewer: PhotoViewer, private platform: Platform,
              public alertCtrl: AlertController, public events: Events) {
    platform.ready().then(() => {
      events.subscribe('dismark:service', (service) => {

        this.services[0].title = "cambio";
        // user and time are the same arguments passed in `events.publish(user, time)`
        console.log(service);
      });
    });
    this.baseUrl = api.getbaseUrl();
    this.loggedIn = auth.isLoggedIn();
    this.subCatId = navParams.get("subCatId");
    this.servicesBySubCat(navParams.get("subCatId"));
    this.citiestOptions = {
      title: "Ciudades"
    };
    this.catOptions = {
      title: "Categorias"
    };
    this.loadSelect();

  }

  viewImg(img) {
    this.photoViewer.show(this.baseUrl + img);
  }

  showPromptDenuncia(id) {
    let prompt = this.alertCtrl.create({
      title: 'Denunciar servicio',
      message: "Escriba la denuncia",
      enableBackdropDismiss: false,
      inputs: [
        {
          name: 'denuncia',
          type: 'textarea',

        },
      ],
      buttons: [
        {
          text: 'Cancel',
          handler: data => {
            console.log('Cancel clicked');
          }
        },
        {
          text: 'Denunciar',
          handler: data => {
            const navTransition = prompt.dismiss();
            this.servProv.denunciarService(id, data.denuncia).then(
              res => {
                // navTransition.then(() => {
                //   this.navCtrl.pop();
                // });
              });

            return false;
          }
        }
      ]
    });
    prompt.present();
  }

  toogleFavorite(index, id) {
    if (this.services[index].favorite == 1) {
      this.servProv.diskMarkfavorite(id).then(
        data => {
          this.services[index].favorite = 0;
        });
    }
    else {
      this.servProv.markfavorite(id).then(
        data => {
          this.services[index].favorite = 1;
        });
    }

  }

  loadSelect() {
    this.api.getCities().then(
      data => {
        this.cities = data["data"];
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
        } else {
        }
      }
    );
    this.api.getCategories().then(
      data => {
        this.categories = data["data"];
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
        } else {
        }
      }
    );
  }


  // servicios dada una subCat
  servicesBySubCat(id) {
    let loading = this.load.create({
      content: "Cargando..."
    });
    loading.present();
    this.servProv.getServiceBySubCat(id).then(
      data => {
        this.services = data["data"];
        loading.dismiss();
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {

          // loading.dismiss();
        } else {
          console.log(err);
          // loading.dismiss();
        }
      }
    );
  }

  ionViewDidLoad() {
    console.log("load");
  }

  ionViewDidEnter() {
    console.log( "disLoad ",this.didLoad);
    if (this.didLoad > 0) {
      this.servProv.getServiceBySubCat(this.subCatId).then(
        data => {
          this.services = data["data"];
          this.services[0].title = "siiiiiiii";
        }
      );
    }
    this.didLoad++;
  }

  ionViewWillEnter() {


  }

  openServicePage(id) {
    this.navCtrl.push(ServicePage, {
      // serviceId: this.services[id]  //si paso el service
      serviceId: id,  //si paso el id del servicio
      parentPage: this

    });
  }

  prueba() {

  }

  doRefresh(refresher) {

    this.servProv.getServiceBySubCat(this.subCatId).then(
      data => {
        this.services = data["data"];
        refresher.complete();
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
        } else {
        }
      }
    );
  }

  deleteCity() {
    this.city = null;
  }

  deleteCategory() {
    this.category = null;
  }
}
