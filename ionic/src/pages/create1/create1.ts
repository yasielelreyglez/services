import { Component } from '@angular/core';
import {
  IonicPage,
  NavController,
  ActionSheetController,
  Platform

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


@IonicPage()
@Component({
  selector: 'page-create1',
  templateUrl: 'create1.html',
})
export class Create1Page {
  @ViewChild('formu') f;
  preview:any;
  service: sendService;
  cities: City[];
  categories:SubCategory[];

  constructor(public navCtrl: NavController,
    private camera: Camera,
    public actionSheetCtrl: ActionSheetController ,
    public api: ApiProvider,
    public photoViewer: PhotoViewer,private platform: Platform
      ) {
        this.service = new sendService();
        this.loadSelect();
  }
  loadSelect() {
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
  ionViewDidLoad() {
    this.preview = "assets/imgs/service_img.png";

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
       this.service.icon = {filename:"imageData",filetype:"image/jpeg",value:imageData};
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


