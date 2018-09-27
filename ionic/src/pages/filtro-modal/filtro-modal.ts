import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ViewController } from 'ionic-angular';
import { ApiProvider } from '../../providers/api/api';
import { HttpErrorResponse } from '@angular/common/http';

/**
 * Generated class for the FiltroModalPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

// @IonicPage()
@Component({
  selector: 'page-filtro-modal',
  templateUrl: 'filtro-modal.html',
})
export class FiltroModalPage {
  categories: any = [];
  cities: any = [];
  filter_distance=0;
  filter_category: any=[];
  filter_city: any=[];
  filter_disabled:boolean = true;
  hide_category:boolean = false;
  constructor( public api: ApiProvider,public viewCtrl: ViewController,public navCtrl: NavController, public navParams: NavParams) {
    this.loadSelect();
  }

  ionViewDidLoad() {
    this.filter_category =this.navParams.get("filter_category");
    this.filter_city =this.navParams.get("filter_city");
    this.hide_category =this.navParams.get("subCategoriaTitutlo")? true:false;
    this.changeFilter();
  }

  filtrar() {
    let data = {
      'filter_city': this.filter_city,
      'filter_category': this.filter_category,
    };
    this.viewCtrl.dismiss(data);
  }
  close() {
    let data = {'close': true};
    this.viewCtrl.dismiss(data);
  }
  clearFilter() {
    let data = {'clear': true};
    this.viewCtrl.dismiss(data);
  }
  changeFilter(){
      this.filter_disabled = false;
      if(this.filter_category != undefined&&this.filter_city != undefined){
          this.filter_disabled = this.filter_category.length == 0&&this.filter_city.length == 0;
      }
  }
  loadSelect() {
    this.api.getCities().then(
      data => {
        this.cities = data["data"];
          console.log("cargo bien las ciudades");
      },
      (err: HttpErrorResponse) => {
        console.log("cargo mal las ciudades");
       console.log(err);
      }
    );
    this.api.getAllSubCategories().then(
      data => {
        this.categories = data["data"];
          console.log("cargo bien las categorias",data["data"]);
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
            console.log("cargo mal las subcategoriass");

        } else {
        }
      }
    );
  }


}
