import { Component } from '@angular/core';
import { IonicPage, ToastController, NavController} from 'ionic-angular';
import {AuthProvider} from "../../providers/auth/auth";

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
  constructor( public authService: AuthProvider ,public navCtrl: NavController,public toastCtrl: ToastController) {

  }
  cambiar_password(){
    this.authService.change_pass(this.anterior_pass,this.new_pass).then(
      result=>{
        if (result){
          let toast = this.toastCtrl.create({
            message: "Contraseña cambiada exitosamente",
            duration: 5000,
            position: 'bottom',
          });
          toast.present();
          this.anterior_pass=null;
          this.new_pass=null;
          this.confirm_new_pass=null;
          this.navCtrl.pop();
        }
        else {
          let toast = this.toastCtrl.create({
            message: "Contraseña almacenada en el servidor no coincide con la ingresada",
            duration: 5000,
            position: 'bottom',
          });
          toast.present();
        }
      }
    )

  }

}
