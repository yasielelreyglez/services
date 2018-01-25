import { Component } from '@angular/core';
import { IonicPage, ToastController, NavController} from 'ionic-angular';
import { ApiProvider } from '../../providers/api/api';

/**
 * Generated class for the ChangePassPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-change-pass',
  templateUrl: 'change-pass.html'
})
export class ChangePassPage {

  anterior_pass:string;
  new_pass:string;
  confirm_new_pass:string;
  constructor(public navCtrl: NavController,public api: ApiProvider,public toastCtrl: ToastController) {

  }
  cambiar_password(){
        let toast = this.toastCtrl.create({
          message: "Contraseña cambiada ",
          duration: 5000,
          position: 'bottom',
        });
        toast.present();
        this.anterior_pass=null;
        this.new_pass=null;
        this.confirm_new_pass=null;
        this.navCtrl.pop();
  }

}
