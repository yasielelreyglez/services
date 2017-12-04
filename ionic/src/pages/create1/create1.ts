import { Component } from '@angular/core';
import {
  IonicPage,
  NavController,
  ActionSheetController,
  AlertController
} from "ionic-angular";
import { FileTransfer, FileUploadOptions, FileTransferObject } from '@ionic-native/file-transfer';
import { Camera, CameraOptions } from '@ionic-native/camera';
import { ViewChild } from '@angular/core';
import {Service} from '../../models/service'
import { ApiProvider } from '../../providers/api/api';
import { Create2Page } from '../create2/create2';


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
    public alertCtrl: AlertController,
    private transfer: FileTransfer,
    private camera: Camera,
    public actionSheetCtrl: ActionSheetController  ,  public api: ApiProvider
      ) {
     this.preview = "assets/imgs/service_img.png";
     this.service = new Service();
  }



  ionViewDidLoad() {

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


  promptTitle() {
    let prompt = this.alertCtrl.create({
      title: 'Titulo del servicio',
      inputs: [
        {
          name: 'title',
          type: 'email',
          value:this.service.title
        },
      ],
      buttons: [
        {
          text: 'Cancelar',
          role: 'cancel'

        },
        {
          text: ' Aceptar',
          handler: data => {
            this.service.title = data.title;
          }
        }
      ]
    });
    prompt.present();
  }

  goToCreate2(){
    this.navCtrl.push(Create2Page, {
      service: this.service, //paso el service
      parentPage: this
    });
  }

}


