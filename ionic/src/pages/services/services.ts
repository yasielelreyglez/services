import {Component} from '@angular/core';
import {
  IonicPage,
  NavController,
  NavParams,
  LoadingController,
  AlertController,
  Platform,
  Events,
  ModalController
} from 'ionic-angular';
import {ServiceProvider} from '../../providers/service/service.service';
import {AuthProvider} from '../../providers/auth/auth';
import {ServicePage} from "../service/service";
import {HttpErrorResponse} from "@angular/common/http";
import {ApiProvider} from "../../providers/api/api";
import {PhotoViewer} from '@ionic-native/photo-viewer';
import {Service} from '../../models/service';
import {FiltroModalPage} from '../filtro-modal/filtro-modal';

// @IonicPage()
@Component({
  selector: "page-services",
  templateUrl: "services.html"
})
export class ServicesPage {
  filtro: boolean = false;
  catOptions: { title: string };
  citiestOptions: { title: string };
  cities: any;
  categories: any;
  filter_city: any = [];
  filter_category: any = [];
  filter_distance: number = 0;
  subCatId: any;
  services: Service[] = [];
  servTemp: Service[] = [];
  categoryId: any;
  loggedIn: boolean;

  constructor(public modalCtrl: ModalController,
              public navCtrl: NavController,
              public auth: AuthProvider,
              public api: ApiProvider,
              public navParams: NavParams, public events: Events,
              public servProv: ServiceProvider,
              public load: LoadingController,
              private photoViewer: PhotoViewer, private platform: Platform,
              public alertCtrl: AlertController) {
    // platform.ready().then(() => {
    this.events.subscribe('dismark:favorite', (id) => {
      let index = this.services.findIndex(this.findServById, id);
      this.services[index].favorite = 0;
    });
    this.subCatId = navParams.get("subCatId")
    this.servicesBySubCat(this.subCatId);
    // this.loadSelect();
    // });

  }

  viewImg(img) {
    this.platform.ready().then(() => {
      this.photoViewer.show(img);
    });
  }

  findServById(element, index, array) {
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
          text: 'Cancelar',
          handler: data => {
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
    this.api.getAllSubCategories().then(
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

  servicesBySubCat(id) {
    let loading = this.load.create({
      content: "Cargando..."
    });
    loading.present();
    this.servProv.getServiceBySubCat(id).then(
      data => {
        this.services = data["data"];
        this.servTemp = data["data"];
        loading.dismiss();
      },
      (err: HttpErrorResponse) => {
        loading.dismiss();
      }
    );
  }

  ionViewDidLoad() {
    this.loggedIn = this.auth.isLoggedIn();
    this.subCatId = this.navParams.get("subCatId");
    this.citiestOptions = {
      title: "Ciudades"
    };
    this.catOptions = {
      title: "Categorias"
    };
  }

  openServicePage(id, index) {
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
    this.filter_city = null;
  }

  deleteCategory() {
    this.filter_category = null;
  }

  deleteFilter() {
    this.filtro = false;
    this.filter_city = [];
    this.filter_category = [];
    this.filter_distance = 0;
    this.services = this.servTemp;
  }

  filterServices() {
    const profileModal = this.modalCtrl.create(FiltroModalPage, {
      filter_city: this.filter_city,
      filter_category: this.filter_category,
        hide_category: true,
    });

    profileModal.onDidDismiss(data => {
      this.filter_city = data.filter_city;
      this.filter_category = data.filter_category;
      if (data.clear != undefined) {
        this.deleteFilter();
      }
      if (data.filter_category != undefined || data.filter_city != undefined || data.filter_distance != undefined) {
        this.filtro = true;
        let loading = this.load.create({
          content: "Filtrando..."
        });
        loading.present();
        if (this.auth.getLongitud() != null) {
          this.servProv.filterService(this.filter_city, this.filter_category,0, {
            latitude: this.auth.getLatitud(),
            longitude: this.auth.getLongitud()
          },null)
            .then(data => {
                this.services = data["data"];
                loading.dismiss();
              },
              (err: HttpErrorResponse) => {
                if (err.error instanceof Error) {
                  loading.dismiss();
                } else {
                  loading.dismiss();
                }
              }
            );

        } else {
          this.servProv.filterService(this.filter_city, this.filter_category, 0,{
            latitude: 23.106131899999998,
            longitude: -82.33370029999999
          },null)
            .then(data => {
                this.services = data["data"];
                loading.dismiss();
              },
              (err: HttpErrorResponse) => {
                if (err.error instanceof Error) {
                  loading.dismiss();
                } else {
                  loading.dismiss();
                }
              }
            );
        }
      }
    });

    profileModal.present();
  }

  getSearchValue(value) {
    this.services = this.servTemp;
    if (value && value.trim() == '') {
      this.services = this.servTemp;
    }
    if (value && value.trim() != '') {
      this.services = this.services.filter((item) => {
        return (item.title.toLowerCase().indexOf(value.toLowerCase()) > -1);
      })
    }
  }
}
