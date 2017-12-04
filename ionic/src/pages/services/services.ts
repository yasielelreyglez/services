import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams, LoadingController, AlertController,  Platform, Events} from 'ionic-angular';
import {ServiceProvider} from '../../providers/service/service.service';
import {AuthProvider} from '../../providers/auth/auth';
import {ServicePage} from "../service/service";
import {HttpErrorResponse} from "@angular/common/http";
import {ApiProvider} from "../../providers/api/api";
import {PhotoViewer} from '@ionic-native/photo-viewer';
import { Service } from '../../models/service';

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
  subCatId: any;
  services: Service[]=[];
  categoryId: any;
  baseUrl: any;
  loggedIn: boolean;
  option: any;

  constructor(
    public navCtrl: NavController,
    public auth: AuthProvider,
    public api: ApiProvider,
    public navParams: NavParams,public events: Events,
    public servProv: ServiceProvider,
    public load: LoadingController,
    private photoViewer: PhotoViewer, private platform: Platform,
    public alertCtrl: AlertController) {
      platform.ready().then(() => {
        this.events.subscribe('dismark:favorite', (id) => {
          let index = this.services.findIndex(this.findServById, id);
          this.services[index].favorite = 0;
      });
      this.servicesBySubCat(navParams.get("subCatId"));
      this.loadSelect();
    });



  }

  viewImg(img) {
    this.platform.ready().then(() => {
    this.photoViewer.show(this.baseUrl + img);
    });
  }
  findServById(element,index,array) {
    return element.id == this;
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
             this.servProv.denunciarService(id, data.denuncia)
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
        } else {
          console.log(err);
        }
      }
    );
  }

  ionViewDidLoad() {
    this.baseUrl = this.api.getbaseUrl();
    this.loggedIn = this.auth.isLoggedIn();
    this.subCatId = this.navParams.get("subCatId");

    this.citiestOptions = {
      title: "Ciudades"
    };
    this.catOptions = {
      title: "Categorias"
    };
  }


  ionViewWillEnter() {


  }

  openServicePage(id,index) {
    this.navCtrl.push(ServicePage, {
      service: this.services[index], //paso el service
      serviceId: id,  //si paso el id del servicio para la peticion
      parentPage: this

    });
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
