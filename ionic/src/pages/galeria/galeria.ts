import { Component } from '@angular/core';
import { IonicPage, NavParams, Platform} from "ionic-angular";
import { PhotoViewer } from '@ionic-native/photo-viewer';



// @IonicPage()
@Component({
  selector: 'page-galeria',
  templateUrl: 'galeria.html',
})
export class GaleriaPage {
  service: any = {};
  galeria : any[] = [];
  comentario : string;;
  cant_c:number;
  havePhoto:boolean;
  constructor(private platform: Platform,public navParams: NavParams,private photoViewer: PhotoViewer,) {
  }

  ionViewDidLoad() {
    this.service = this.navParams.get("service");
    this.cant_c = this.navParams.get("cant_c");
    this.galeria= this.service['imagesList'];
    this.havePhoto = this.galeria.length> 0?true:false;


  }
  viewImg(img) {
    this.platform.ready().then(() => {
    this.photoViewer.show(img);
    });
  }
}
