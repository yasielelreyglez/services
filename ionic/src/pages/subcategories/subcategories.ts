import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { LoadingController } from 'ionic-angular';
import  {SubCategoryProvider} from  '../../providers/sub-category/sub-category';
import {ServicesPage} from '../services/services';



/**
 * Generated class for the SubcategoriesPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-subcategories',
  templateUrl: 'subcategories.html',
})
export class SubcategoriesPage {
  // declaracion de variables
  private parentTitle:any;
  private parentId:any;
  private subCategories = [];
  private loading: any;


  constructor( public navCtrl: NavController, public navParams: NavParams,
    public load: LoadingController,
    public subCat: SubCategoryProvider,) {
    this.parentTitle= navParams.get("title");
    this.parentId= navParams.get("categoryId");


    // obtengo las subcategorias dada una categoria
     this.loading = this.load.create();
     this.loading.present();
    this.subCat.getsubcategories(this.parentId)
    .then(
      (subCat) => {
        this.subCategories = subCat['data'];
        this.loading.dismiss();
      }
    ).catch(
      (error) => {

          }
    );

  }
  // abre la vista de los servicios asociados a la categoria en dada
  openServicesPage(id){
    this.navCtrl.push(ServicesPage,{
      subCatId:id
    });
  }
}
