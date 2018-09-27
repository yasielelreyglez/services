import { Component } from "@angular/core";
import {
    IonicPage,
    ToastController,
    LoadingController,
    NavController,
    NavParams, ModalController
} from 'ionic-angular';
import { HttpErrorResponse } from "@angular/common/http";
import { ServiceProvider } from "../../providers/service/service.service";
import { ServicePage } from "../service/service";
import {FiltroModalPage} from '../filtro-modal/filtro-modal';

/**
 * Generated class for the SearchPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

// @IonicPage()
@Component({
  selector: "page-search",
  templateUrl: "search.html"
})
export class SearchPage {
  busqueda: any;
    filter_city: any = [];
    filter_category: any = [];
  loading: any;
  private services: any;
  private noFound: boolean;
  subCategoriaTitutlo: string;

  constructor(
      public modalCtrl: ModalController,
    public servProv: ServiceProvider,
    public toastCtrl: ToastController,
    private load: LoadingController,
    public navCtrl: NavController,
    public navParams: NavParams
  ) {
    this.busqueda = this.navParams.get("buscar");
    this.filter_category = this.navParams.get("filter_category");
    this.filter_city = this.navParams.get("filter_city");
    this.subCategoriaTitutlo = this.navParams.get("subCategoriaTitutlo")
  }

  SearchValue(value) {
      this.busqueda = value;
    this.searchServices(this.busqueda,this.filter_category,this.filter_city);
  }
  ionViewDidLoad() {
    this.searchServices(this.busqueda,this.filter_category,this.filter_city);
  }

  openServicePage(id, index) {
    this.navCtrl.push(ServicePage, {
      service: this.services[index], //paso el service
      serviceId: id //si paso el id del servicio para la peticion
    });
  }

  searchServices(query,category,cities) {
    let loading = this.load.create({
      content: "Buscando..."
    });
    loading.present();
    this.servProv.filterService(cities,category,0,{},query).then(
      data => {
        loading.dismiss();
        this.services = data["data"];
        if(this.services != undefined) {
            this.noFound = this.services.length == 0;
        }
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
          loading.dismiss();
        } else {
          loading.dismiss();
        }
      }
    ).catch(err=>{
      console.log(err);
      loading.dismiss();
    });
  }

    filterServices(){
        const profileModal = this.modalCtrl.create(FiltroModalPage, {
            filter_city: this.filter_city,
            filter_category: this.filter_category,
            subCategoriaTitutlo: this.subCategoriaTitutlo
        });
        profileModal.onDidDismiss(data => {
          if (data && !data["close"]) {
            this.filter_city = data.filter_city;
          if(this.subCategoriaTitutlo == undefined){
            this.filter_category = data.filter_category;
          }
            if (data.clear != undefined) {
                this.deleteFilter();

            }
            console.log(data.filter_category);
            if (data.filter_category != undefined || data.filter_city != undefined ){
                this.searchServices(this.busqueda,this.filter_category,this.filter_city);
            }
          }
        });

        profileModal.present();
    }

    deleteFilter() {
      if(this.subCategoriaTitutlo == undefined){
        this.filter_category = [];
      }
        this.filter_city = [];
        this.searchServices(this.busqueda,this.filter_category,this.filter_city);
        // this.filtro = false;
        // this.filter_city = [];
        // this.filter_category = [];
        // this.filter_distance = 0;
    }
  // filterServices() {
  //   let toast = this.toastCtrl.create({
  //     message: "estamos trabajando en este cambio!",
  //     duration: 5000,
  //     position: "bottom",
  //     showCloseButton: true,
  //     closeButtonText: "Cerrar"
  //   });
  //   toast.present();
  // }
}
