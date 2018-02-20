// componetes angular

import { Component, ViewChild } from "@angular/core";
// providers
import  {SubCategoryProvider} from  '../../providers/sub-category/sub-category';
import  {AuthProvider} from  '../../providers/auth/auth';
import { ServiceProvider } from "../../providers/service/service.service";
import { ApiProvider } from "../../providers/api/api";

// Paginas
import  {PopoverPage} from  '../pop-over/pop-over';
import {ServicesPage} from '../services/services';
import  {CategoriesPage} from  '../categories/categories';
import 'rxjs/add/operator/map';
// componetes ionic
import {IonicPage,PopoverController,NavController, AlertController,} from 'ionic-angular';
import {
  NavParams,
  LoadingController,
  Keyboard,
  Platform
} from "ionic-angular";
// native components
import { SplashScreen } from '@ionic-native/splash-screen';
import { ServicePage } from "../service/service";
import { HttpErrorResponse } from "@angular/common/http";
import { PhotoViewer } from '@ionic-native/photo-viewer';
import { StatusBar } from "@ionic-native/status-bar";

@IonicPage({
  priority: 'high'
})
@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  subCategories = [];
  services = [];
  para: any;
  connetionDown: boolean;
  loggedIn: boolean;
  noFound: boolean;

  busqueda:boolean;
  loading: any;
  @ViewChild('search') search;


  constructor(
    private alertCtrl: AlertController,
     public auth: AuthProvider,
     private popoverCtrl: PopoverController,
     public subCat: SubCategoryProvider,
     public navCtrl: NavController ,
     public api: ApiProvider,
     public servProv: ServiceProvider,
     private load: LoadingController,
     private photoViewer: PhotoViewer,
     public keyboard: Keyboard,
     public navParams: NavParams,public splashScreen: SplashScreen,public platform: Platform,  statusBar: StatusBar,) {

      this.platform.ready().then(() => {
        //statusBar.hide();
        //statusBar.backgroundColorByHexString('#ffffff');
        this.platform.registerBackButtonAction((readySource) => {
          this.exitApp()

        });

        this.subCat.topSubcategories().then(
          data => {
            this.subCategories =data['data'];
            this.splashScreen.hide();
            this.connetionDown = false;
          },
          (err: HttpErrorResponse) => {
            if (err.error instanceof Error) {
              this.connetionDown = true;
              this.splashScreen.hide();
            } else {
              this.connetionDown = true;
              this.splashScreen.hide();

            }
          });
      });



  }
  ionViewDidLoad() {

    this.platform.ready().then(() => {


      this.busqueda = false;
      this.noFound = false;

      this.auth.currentUser.subscribe(user=>{
        this.loggedIn = !!user;
      });

    });
  }
  ionViewDidEnter() {
    if(this.navParams.get('connetionDown')){
      this.connetionDown = true;
    }
  }
  viewImg(img) {
    this.platform.ready().then(() => {
    this.photoViewer.show(img);
    });
  }

  exitApp(){
    let confirm = this.alertCtrl.create({
      title: "¿Desea salir de la aplicación? ",
      message: "",
      buttons: [
        {
          text: "No",
          handler: () => {
          }
        },
        {
          text: "Si",
          handler: () => {
            this.platform.exitApp();
          }
        }
      ]
    });
    confirm.present();
  }


  searchServices(query){

    this.loading = this.load.create({
      content:"Buscando..."
    });
    this.loading.present();
    this.servProv.getServiceBySearch(query).then(
      data => {
        this.services =data['data'];
        this.noFound = this.services.length == 0 ? true : false;
        this.loading.dismiss();
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof Error) {
          this.connetionDown = true;
          this.loading.dismiss();
        } else {
          this.loading.dismiss();
          this.connetionDown = true;
        }
      });
  }

  buscar(){
    this.busqueda = true;
    this.searchServices(this.search.value);
  }

  goSearch(keyCode) {
    if (keyCode === 13){
     this.busqueda = true;
     this.searchServices(this.search.value);
     this.keyboard.close();
    }
  }

  onCancel(e){
    this.services = [];
    this.busqueda = false;
    this.noFound =  false;
  }
  // openServicePage(id,serv){
  //   this.navCtrl.push(ServicePage,{
  //      serviceId:id,
  //      service:serv
  //   })
  // }
  openServicePage(id,index) {
    this.navCtrl.push(ServicePage, {
      service: this.services[index], //paso el service
      serviceId: id,  //si paso el id del servicio para la peticion
      parentPage: this

    });
  }

  onInput(e){

    if( this.search.value == "" )
      {
      this.busqueda = false;
      this.services = [];
      this.noFound =  false;
     }
  }
  delete(chip: Element) {
    chip.remove();
  }

  presentPopover(ev) {
    let popover = this.popoverCtrl.create(PopoverPage);
    popover.present({
      ev: ev,

    });
  }
  openCategoriesPage(){
    this.navCtrl.push(CategoriesPage)
  }
  openServicesPage(id){
    // this.api.test().then(
    //   () => {
        this.navCtrl.push(ServicesPage,{
          subCatId:id
        });
      // },
      // (err: HttpErrorResponse) => {
      //   // no hay conexion
      //     this.connetionDown = true;
      // });

  }
  reConnect(){
    this.subCat.topSubcategories()
    .then(
      (cat) => {
        this.busqueda = false;
        this.connetionDown = false;
        this.subCategories = cat['data'];
      }
    ).catch(
      (error) => {
        this.connetionDown = true;
      }
    );
  }
  toogleFavorite(index,id){
    if(this.services[index].favorite == 1){
      this.servProv.diskMarkfavorite(id).then(
        data => {
          this.services[index].favorite = 0;
        } );
    }
    else{
      this.servProv.markfavorite(id).then(
        data => {
          this.services[index].favorite = 1;
        });
    }

  }
}

