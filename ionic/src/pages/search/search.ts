import { FiltroModalPage } from "./../filtro-modal/filtro-modal";
import { Component } from "@angular/core";
import {
  IonicPage,
  ToastController,
  LoadingController,
  NavController,
  NavParams,
  ModalController
} from "ionic-angular";
import { HttpErrorResponse } from "@angular/common/http";
import { ServiceProvider } from "../../providers/service/service.service";
import { ServicePage } from "../service/service";

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
  categoriaFija = false;
  subCategoriaTitutlo= "";
  constructor(
    public servProv: ServiceProvider,
    public toastCtrl: ToastController,
    private load: LoadingController,
    public navCtrl: NavController,
    public navParams: NavParams,
    public modalCtrl: ModalController
  ) {
    this.busqueda = this.navParams.get("buscar");
    this.filter_category = this.navParams.get("filter_category")
      ? this.navParams.get("filter_category")
      : [];
    this.filter_city = this.navParams.get("filter_city");
    this.categoriaFija = this.navParams.get("categoriaFija");
    this.subCategoriaTitutlo = this.navParams.get("subCategoriaTitutlo")
      ? this.navParams.get("subCategoriaTitutlo")
      : "";
  }

  SearchValue(value = null) {
    if (value == undefined) this.busqueda = null;
    else this.busqueda = value;
    this.searchServices(this.busqueda, this.filter_category, this.filter_city);
  }
  ionViewDidLoad() {
    this.searchServices(this.busqueda, this.filter_category, this.filter_city);
  }

  openServicePage(id, index) {
    this.navCtrl.push(ServicePage, {
      service: this.services[index], //paso el service
      serviceId: id //si paso el id del servicio para la peticion
    });
  }

  searchServices(query, category, cities) {
    let loading = this.load.create({
      content: "Buscando..."
    });
    loading.present();

    this.servProv.filterService(cities, category, {}, query).then(
      data => {
        console.log(data);
        this.services = data["services"] ? data["services"] : data["data"];
        // this.noFound = this.services ? this.services.length : 0;
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

  filterServices() {
    const profileModal = this.modalCtrl.create(FiltroModalPage, {
      filter_city: this.filter_city,
      filter_category: this.filter_category,
      categoriaFija: this.categoriaFija
    });
    profileModal.onDidDismiss(data => {
      if (data && !data["close"]) {
        this.filter_city = data.filter_city;
        if (!this.categoriaFija) this.filter_category = data.filter_category;
        if (data.clear != undefined) {
          if (!this.categoriaFija) this.filter_category = [];
          this.filter_city = [];
          this.searchServices(
            this.busqueda,
            this.filter_category,
            this.filter_city
          );
        }
        if (
          data.filter_category != undefined ||
          data.filter_city != undefined
        ) {
          this.searchServices(
            this.busqueda,
            this.filter_category,
            this.filter_city
          );
        }
      }
    });

    profileModal.present();
  }
}
