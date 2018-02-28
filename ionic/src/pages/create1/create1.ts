import {Component} from '@angular/core';
import {
  IonicPage,
  NavController,
  Platform,
  NavParams, LoadingController,

} from "ionic-angular";

import {ViewChild} from '@angular/core';
import {ApiProvider} from '../../providers/api/api';
import {Create2Page} from '../create2/create2';
import {City} from '../../models/city';
import {HttpErrorResponse} from '@angular/common/http';
import {SubCategory} from '../../models/subCategory';
import {sendService} from '../../models/sendService';
import {PhotoViewer} from '@ionic-native/photo-viewer';
import {ServicesPage} from '../services/services';
import {MyservicesPage} from '../myservices/myservices';
import {SubCategoryProvider} from "../../providers/sub-category/sub-category";


@IonicPage()
@Component({
  selector: 'page-create1',
  templateUrl: 'create1.html',
})
export class Create1Page {
  edit: boolean = false;
  @ViewChild('formu') f;
  preview: any;
  service: sendService;
  cities: City[];
  categories: any[];
  category: any;
  allCities: boolean;
  public CValue: String;
  private subCategories: any;
  private loading: any;


  constructor(public subCat: SubCategoryProvider, public navParams: NavParams, public navCtrl: NavController,
              public load: LoadingController,
              public api: ApiProvider,
              public photoViewer: PhotoViewer, private platform: Platform) {
    this.service = new sendService();
    this.loadSelect();


  }

  onChangeCategory(CValue) {
    this.loading = this.load.create({
      content: "Cargando..."
    });
    this.loading.present();

    this.subCat.getsubcategories(CValue)
      .then(
        (subCat) => {
          this.subCategories = subCat['data'];
          this.loading.dismiss();
        }
      ).catch(
      (error) => {
        this. loading.dismiss();
      }
    );
  }

  allClickedCities() {
    if (this.allCities) {
      this.service.cities = [];
      for (let i = 0; i < this.cities.length; i++) {
        this.service.cities.push(this.cities[i].id)
      }
    }
    else {
      this.service.cities = [];
    }

  }

  backToHome() {
    if (this.edit) {
      this.navCtrl.popTo(MyservicesPage);
    } else {
      this.navCtrl.popTo(ServicesPage);
    }

  }

  loadSelect() {
    // this.loading = this.load.create({
    //   content: "Cargando..."
    // });
    this.api.getCities().then(
      data => {
        this.cities = data["data"];
        this.api.allCategories().then(
          data => {
            this.categories = data["data"];
            // this. loading.dismiss();
          }
        );
      },
      (err: HttpErrorResponse) => {
      }
    );
  }

  ionViewDidLoad() {
    this.preview = "assets/imgs/service_img.png";
    if (this.navParams.get("service")) {
      this.edit = true;
      this.service = this.navParams.get("service");
      let citiesId = [];
      for (let i = 0; i < this.navParams.get("service").citiesList.length; i++) {
        citiesId.push(this.navParams.get("service").citiesList[i].id);
      }
      this.service.cities = citiesId;
      this.category = this.service.subcategoriesList[0].category.id

      this.onChangeCategory(this.category);

      let subcategoriesId = [];
      for (let i = 0; i < this.navParams.get("service").subcategoriesList.length; i++) {
        subcategoriesId.push(this.navParams.get("service").subcategoriesList[i].id);
      }
      this.service.categories = subcategoriesId;
      if (this.service.icon)
        this.preview = this.service.icon;
    }
  }


  viewImg() {
    this.platform.ready().then(() => {
      this.photoViewer.show(this.preview);
    });
  }

  goToCreate2() {
    if (this.f.form.valid) {
      this.navCtrl.push(Create2Page, {
        service: this.service, //paso el service
      });
    }

  }
}


