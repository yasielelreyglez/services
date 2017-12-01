import { Component, ElementRef } from '@angular/core';
import {
  IonicPage,
  NavController,
  NavParams,
  ActionSheetController,
  ToastController
} from "ionic-angular";
import { FileTransfer, FileUploadOptions, FileTransferObject } from '@ionic-native/file-transfer';
import { Camera, CameraOptions } from '@ionic-native/camera';
import { ViewChild } from '@angular/core';
import {Service} from '../../models/service'
import { ApiProvider } from '../../providers/api/api';
/**
 * Generated class for the Create1Page page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-create1',
  templateUrl: 'create1.html',
})
export class Create1Page {
  imageURI:any;
  preview:any;
  respuesta:any;
  service: Service;
  imageFileName:any;
  constructor(public navCtrl: NavController,
    public navParams: NavParams,
    private transfer: FileTransfer,
    private camera: Camera,
    public actionSheetCtrl: ActionSheetController  ,  public api: ApiProvider
      ) {
     this.imageURI = "http://192.168.137.1/login/resources/image/categories/bares.png";
     this.service = new Service();
  }



  ionViewDidLoad() {

  }
  public presentActionSheet() {
    let actionSheet = this.actionSheetCtrl.create({
      title: 'Select Image Source',
      buttons: [
        {
          text: 'Load from Library',
          handler: () => {
            this.getImage(this.camera.PictureSourceType.PHOTOLIBRARY);
          }
        },
        {
          text: 'Use Camera',
          handler: () => {
            this.getImage(this.camera.PictureSourceType.CAMERA);
          }
        },
        {
          text: 'Cancel',
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
       this.imageURI = imageData;

    }, (err) => {
      console.log(err);
      // this.presentToast(err);
    });
  }
  uploadFile() {


    const fileTransfer: FileTransferObject = this.transfer.create();

    let options: FileUploadOptions = {
      fileKey: 'ionicfile',
      fileName: 'ionicfile',
      chunkedMode: false,
      mimeType: "image/jpeg",
      headers: {}
    }

    fileTransfer.upload(this.imageURI, this.api.getbaseUrl+'api/testimg', options)
      .then((data) => {
      this.respuesta =data;
      // console.log(data+" Uploaded Successfully");
      // this.imageFileName = "http://192.168.0.7:8080/static/images/ionicfile.jpg"

    }, (err) => {
      console.log(err);
      this.respuesta =err;
    });
  }

  create(){

  }

}


