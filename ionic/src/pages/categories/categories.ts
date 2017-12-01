import { Component } from '@angular/core';
import { IonicPage, NavController, PopoverController} from 'ionic-angular';
import { LoadingController } from 'ionic-angular';

// pages
import  {PopoverPage} from  '../pop-over/pop-over';
import {SubcategoriesPage} from '../subcategories/subcategories';

// providers
import  {CategoryProvider} from  '../../providers/category/category.service';
import { ApiProvider } from "../../providers/api/api";


@IonicPage()
@Component({
  selector: 'page-categories',
  templateUrl: 'categories.html',

})
export class CategoriesPage {
 private categories=[];
 private baseUrl: any;

  constructor(public navCtrl: NavController,
    public category: CategoryProvider,
    public load: LoadingController,
    public popCtrl: PopoverController,
    public api: ApiProvider) {

    this.baseUrl = api.getbaseUrl();
    const loading = this.load.create();
    loading.present();
    category.getcategories()
      .then(
        (cat) => {
          this.categories = cat['data'];
          loading.dismiss();
        }
      );
  }
  presentPopover(ev) {
    let popover = this.popCtrl.create(PopoverPage);
    popover.present({
      ev: ev
    });
  }
  openSubcategories(catId,title){
      this.navCtrl.push(SubcategoriesPage,{
        categoryId:catId,
        title:title
      });
  }

}
