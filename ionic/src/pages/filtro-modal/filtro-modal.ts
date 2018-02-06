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

@IonicPage()
@Component({
  selector: 'page-filtro-modal',
  templateUrl: 'filtro-modal.html',
})
export class FiltroModalPage {
  categories: any;
  cities: any;
  filter_distance: number;
  filter_category: any="";
  filter_city: any="";

  constructor( public api: ApiProvider,public viewCtrl: ViewController,public navCtrl: NavController, public navParams: NavParams) {
    this.loadSelect();
  }

  ionViewDidLoad() {
    this.filter_distance = 5;
    this.filter_category =this.navParams.get("filter_category");
    this.filter_city =this.navParams.get("filter_city");
  }

  filtrar() {
    let data = {
      'filter_city': this.filter_city,
      'filter_category': this.filter_category,
      'filter_distance': this.filter_distance
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
  loadSelect() {
    this.api.getCities().then(
      data => {
        this.cities = data["data"];
      },
      (err: HttpErrorResponse) => {
       console.log(err);
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


}
