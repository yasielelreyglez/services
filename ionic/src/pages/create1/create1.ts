import { Component } from '@angular/core';
import {
  IonicPage,
  NavController,
  ActionSheetController,
  Platform,
  NavParams,

} from "ionic-angular";

import { Camera, CameraOptions } from '@ionic-native/camera';
import { ViewChild } from '@angular/core';
import { ApiProvider } from '../../providers/api/api';
import { Create2Page } from '../create2/create2';
import { City } from '../../models/city';
import { HttpErrorResponse } from '@angular/common/http';
import { SubCategory } from '../../models/subCategory';
import { sendService } from '../../models/sendService';
import { PhotoViewer } from '@ionic-native/photo-viewer';
import { ServicesPage } from '../services/services';
import { MyservicesPage } from '../myservices/myservices';


@IonicPage()
@Component({
  selector: 'page-create1',
  templateUrl: 'create1.html',
})
export class Create1Page {
  edit: boolean =false;
  @ViewChild('formu') f;
  preview:any;
  service: sendService;
  cities: City[];
  categories:SubCategory[];

  constructor(public navParams: NavParams,public navCtrl: NavController,
    private camera: Camera,
    public actionSheetCtrl: ActionSheetController ,
    public api: ApiProvider,
    public photoViewer: PhotoViewer,private platform: Platform
      ) {
        this.service = new sendService();
        this.loadSelect();
  }
  backToHome(){
    if (this.edit) {
      this.navCtrl.popTo(MyservicesPage);
    }else{
      this.navCtrl.popTo(ServicesPage);
    }

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
  ionViewDidLoad() {
    this.preview = "assets/imgs/service_img.png";
    if(this.navParams.get("service")){
      this.edit=true;
      this.service = this.navParams.get("service");
      let citiesId = [];
      for (let i = 0; i <this.navParams.get("service").citiesList.length; i++) {
          citiesId.push(this.navParams.get("service").citiesList[i].id);
      }
      this.service.cities = citiesId;

      let subcategoriesId = [];
      for (let i = 0; i < this.navParams.get("service").subcategoriesList.length; i++) {
          subcategoriesId.push(this.navParams.get("service").subcategoriesList[i].id);
      }
      this.service.categories = subcategoriesId;
      if (this.service.icon)
      this.preview = this.service.icon;

    }
  }
  public presentActionSheet() {
    let actionSheet = this.actionSheetCtrl.create({
      title: 'Seleccione la imagen',
      buttons: [
        {
          text: 'Cargar desde la galeria',
          handler: () => {
            this.getImage(this.camera.PictureSourceType.PHOTOLIBRARY);
          }
        },
        {
          text: 'Usar la Camara',
          handler: () => {
            this.getImage(this.camera.PictureSourceType.CAMERA);
          }
        },
        {
          text: 'Cancelar',
          role: 'cancel'
        }
      ]
    });
    actionSheet.present();
  }
  getImage(source) {
    const options: CameraOptions = {
      quality: 100,
      destinationType: this.camera.DestinationType.DATA_URL,
      sourceType: source
    }

    this.camera.getPicture(options).then((imageData) => {
       this.preview = 'data:image/jpeg;base64,' + imageData;
       this.service.icon = {filename:Date.now()+this.service.title+"imageData.jpg",filetype:"image/jpeg",value:imageData};
    }, (err) => {
      console.log(err);
    });
  }
  viewImg() {
    this.platform.ready().then(() => {
    this.photoViewer.show(this.preview);
    });
  }
  goToCreate2(){
    if (this.f.form.valid) {
      this.navCtrl.push(Create2Page, {
        service: this.service, //paso el service
      });
    }

  }
}


