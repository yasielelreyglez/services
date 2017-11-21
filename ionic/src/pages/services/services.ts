import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams,LoadingController } from 'ionic-angular';
import  {ServiceProvider} from  '../../providers/service/service.service';
import  {AuthProvider} from  '../../providers/auth/auth';
import { ServicePage } from "../service/service";
import { HttpErrorResponse } from "@angular/common/http";
import { ApiProvider } from "../../providers/api/api";

/**
 * Generated class for the ServicesPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

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

  private subCatId: any;
  services = [];
  categoryId: any;
  private baseUrl: any;
  loggedIn: boolean;
  option: any;

  constructor(
    public navCtrl: NavController,
    public auth: AuthProvider,
    public api: ApiProvider,
    public navParams: NavParams,
    public servProv: ServiceProvider,
    public load: LoadingController
  ) {
    this.baseUrl = api.getbaseUrl() + "resources/image/service/";
    this.loggedIn = auth.isLoggedIn();
    this.subCatId = navParams.get("subCatId");
    this.citiestOptions = {
      title: "Ciudades"
    };
    this.catOptions = {
      title: "Categorias"
    };
    this.loadSelect();

  }

  loadSelect(){
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
  servicesBySubCat() {
    let loading = this.load.create({
      content: "Cargando..."
    });
    loading.present();

    this.servProv.getServiceBySubCat(this.subCatId).then(
      data => {
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

  ionViewDidLoad() {
    this.servicesBySubCat();
  }
  openServicePage(id) {
    this.navCtrl.push(ServicePage, {
      serviceId: id
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
