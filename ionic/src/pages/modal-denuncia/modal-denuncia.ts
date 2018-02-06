import { Component } from '@angular/core';
import { IonicPage, NavParams, ViewController, Platform } from 'ionic-angular';
import { ServiceProvider } from '../../providers/service/service.service';
import { ApiProvider } from '../../providers/api/api';
import { Keyboard } from '@ionic-native/keyboard';

/**
 * Generated class for the ModalDenunciaPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-modal-denuncia',
  templateUrl: 'modal-denuncia.html',
})
export class ModalDenunciaPage {
  tipo: any;
  id: any;
  denuncia:any;
  constructor( platform: Platform,
    public keyboard: Keyboard,
    public api: ApiProvider, public servProv: ServiceProvider,
    public viewCtrl: ViewController, public navParams: NavParams) {
    // platform.ready().then(() => {
    //   keyboard.show();
    // });
  }
  setFocus(){
     this.keyboard.show();
  }
  ionViewDidLoad() {
    this.id = this.navParams.get("id");
    this.tipo = this.navParams.get("tipo");
  }

  close() {
    this.viewCtrl.dismiss();
  }
  denunciar(){
    if (this.tipo== "servicio") {
      this.servProv.denunciarService(this.id, this.denuncia)
    }
    else{
      this.api.reportComment(this.id, this.denuncia)
    }
    this.viewCtrl.dismiss();
  }

}
