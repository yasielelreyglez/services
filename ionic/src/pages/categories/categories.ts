import {Component} from '@angular/core';
import {IonicPage, NavController, PopoverController} from 'ionic-angular';
import {LoadingController} from 'ionic-angular';

// pages
import {SubcategoriesPage} from '../subcategories/subcategories';

// providers
import {CategoryProvider} from '../../providers/category/category.service';


// @IonicPage()
@Component({
  selector: 'page-categories',
  templateUrl: 'categories.html',

})
export class CategoriesPage {
  private categories = [];
  private categoriesTemp = [];


  constructor(public navCtrl: NavController,
              public category: CategoryProvider,
              public load: LoadingController,
              public popCtrl: PopoverController,) {

    let loading = this.load.create();
    loading.present();
    category.getcategories()
      .then(
        (cat) => {
          this.categories = cat['data'];
          this.categoriesTemp = cat['data'];
          loading.dismiss();
        }
      ).catch((error) => {
      loading.dismiss();
    });
  }

  // presentPopover(ev) {
  //   let popover = this.popCtrl.create(PopoverPage);
  //   popover.present({
  //     ev: ev
  //   });
  // }

  openSubcategories(catId, title) {
    this.navCtrl.push(SubcategoriesPage, {
      categoryId: catId,
      title: title
    });
  }
  getSearchValue(value) {
    this.categories=this.categoriesTemp;
    if (value && value.trim() == '') {
      this.categories = this.categoriesTemp;
    }
    if (value && value.trim() != '' ) {
      this.categories = this.categories.filter((item) => {
        return (item.title.toLowerCase().indexOf(value.toLowerCase()) > -1);
      })
    }
  }

}
