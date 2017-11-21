import { Component } from '@angular/core';
import {
  IonicPage,
  ModalController,
  NavController,
  LoadingController,
  ToastController,
  AlertController
} from "ionic-angular";
import {User} from '../../models/user';
import {AuthProvider} from '../../providers/auth/auth';
import { ForgotPage } from "../forgot/forgot";
// import { HomePage } from "../home/home";

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {
  user: User;
  loading: any;

  constructor(public navCtrl: NavController,
     public authService: AuthProvider ,
     public toastCtrl: ToastController,
     public load: LoadingController,
     public modalCtrl: ModalController,
     public alertCtrl: AlertController) {
    this.user = new User();
  }

  doLogin() {
     this.loading = this.load.create();
     this.loading.present();
     this.authService.login(this.user)
      .subscribe(result => {
        if (result === true) {
          this.loading.dismiss();
          // this.navCtrl.setRoot(HomePage);
           this.navCtrl.pop();
        } else {
          let toast = this.toastCtrl.create({
            message: "Correo y/o contraseña incorrectos",
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
      message: "llenar todos los campos",
      duration: 5000,
      position: 'middle',
      showCloseButton:true,
      closeButtonText:"Cerrar"
    });
    toast.present();
}
openForgot(){
  const profileModal = this.modalCtrl.create(ForgotPage);
  profileModal.onDidDismiss(data => {
    // enviar contraseña
    console.log(data);
  });

  profileModal.present();
}




}

