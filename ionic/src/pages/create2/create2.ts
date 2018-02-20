import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ViewController, ActionSheetController, AlertController } from 'ionic-angular';
import { Create3Page } from '../create3/create3';
import { sendService, sendGalery } from '../../models/sendService';
import { Camera, CameraOptions } from '@ionic-native/camera';
import { PhotoViewer } from '@ionic-native/photo-viewer';
/**
 * Generated class for the Create2Page page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-create2',
  templateUrl: 'create2.html',
})
export class Create2Page {
  edit: boolean =false;
   service: sendService;
   photos: sendGalery[];
   preview:any;

  //  photos: any;
  //  base64Image: string;
  constructor(public navCtrl: NavController,
     public navParams: NavParams,
     public viewCtrl: ViewController,
      public actionSheetCtrl: ActionSheetController ,
      private camera: Camera,public photoViewer: PhotoViewer, private alertCtrl: AlertController,
    ) {
    this.service = this.navParams.get("service");
    this.service.gallery=[];
    this.service.dropsImages=[];
  }

  ionViewDidLoad() {
    this.photos = [];
    this.preview = "as";
    if(this.navParams.get("service").id){
      this.edit=true;
    }
  }

  uploadPhoto(){
    let actionSheet = this.actionSheetCtrl.create({
      title: 'Seleccione la imagen',
      buttons: [
        {
          text: 'Cargar desde el almacenamiento',
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
    };
    this.camera.getPicture(options).then((imageData) => {

      if (this.edit) {
        this.service.imagesList.push({title:'data:image/jpeg;base64,' + imageData});
      }
      this.photos.push({filename:"imageData",filetype:"image/jpeg",value:imageData});
      // this.photos.reverse();
    }, (err) => {
    });
  }

  deletePhoto(index){

          let confirm = this.alertCtrl.create({
            title: "¿Esta seguro que desea eliminar la imagen? ",
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

                  if (this.edit) {
                    this.service.dropsImages.push(this.service.imagesList[index].id);
                    this.service.imagesList.splice(index, 1);
                  }else{
                    this.service.dropsImages.push(this.photos[index].id);
                    this.photos.splice(index, 1);

                  }

                  console.log(this.service);
                }
              }
            ]
          });
          confirm.present();
      }
      viewImg(data) {
        // this.platform.ready().then(() => {
        this.photoViewer.show( 'data:image/jpeg;base64,' + data);
        // });
      }

  goToCreate1(){
    this.viewCtrl.dismiss();
  }
  goToCreate3(){
      this.service.gallery=this.photos;
      // this.service.icon=this.service.gallery[0];
      this.navCtrl.push(Create3Page, {
        service: this.service
      });
  }



}
