import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams ,ToastController} from 'ionic-angular';
import {User} from '../../models/user';
import {AuthProvider} from '../../providers/auth/auth';
// import { HomePage } from "../home/home";

@IonicPage()
@Component({
  selector: 'page-signup',
  templateUrl: 'signup.html',
})
export class SignupPage {
  user: User;
  loading: any;
  error: string;


  constructor(public navCtrl: NavController,
    public navParams: NavParams,
    public toastCtrl: ToastController,
    public auth: AuthProvider ) {

    this.user = new User();
  }

  doSignUp(){
    this.auth.signUp(this.user)
    .subscribe(result => {
      if (result === true) {
        this.loading.dismiss();
        // this.navCtrl.setRoot(HomePage);
        this.navCtrl.pop();
      } else {
        let toast = this.toastCtrl.create({
          message: "Ya ese email esta en uso",
          duration: 5000,
          position: 'middle',
          showCloseButton:true,
          closeButtonText:"Cerrar"
        });
        toast.present();
      }
    });

  }
  llenarCampos(){
    let toast = this.toastCtrl.create({
       message: "Llene todos los campos para registarse",
       duration: 5000,
       position: 'middle',
       showCloseButton:true,
       closeButtonText:"Cerrar"
     });
     toast.present();
 }

}
