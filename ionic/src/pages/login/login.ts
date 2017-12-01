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
import { HomePage } from '../home/home';

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {
  user: User;
  loading: any;
  showPassword: boolean =false;

  constructor(public navCtrl: NavController,
     public authService: AuthProvider ,
     public toastCtrl: ToastController,
     public load: LoadingController,
     public modalCtrl: ModalController,
     public alertCtrl: AlertController) {
    this.user = new User();
  }
  showPrompt() {
    let prompt = this.alertCtrl.create({
      title: 'Olvido de contraseña',
      message: "Escribe tu dirección de email",
      enableBackdropDismiss:false,
      inputs: [
        {
          name: 'email',
          type: 'email'
        },
      ],
      buttons: [
        {
          text: 'Cancel',
          handler: data => {
            console.log('Cancel clicked');
          }
        },
        {
          text: ' Enviarme contraseña',
          handler: data => {
            console.log('Cancel clicked');
            // const navTransition = prompt.dismiss();

                  // start some async method
                  // someAsyncOperation().then(() => {
                  //   // once the async operation has completed
                  //   // then run the next nav transition after the
                  //   // first transition has finished animating out

                  //   navTransition.then(() => {
                  //     this.nav.pop();
                  //   });
                  // });
                  //return false;
          }
        }
      ]
    });
    prompt.present();
  }
  doLogin() {
     this.loading = this.load.create();
     this.loading.present();
     this.authService.login(this.user)
      .subscribe(result => {
        if (result === true) {
          this.loading.dismiss();
           this.navCtrl.setRoot(HomePage);
           this.navCtrl.pop();
        } else {
          let toast = this.toastCtrl.create({
            message: "Correo y/o contraseña incorrectos",
            duration: 5000,
            position: 'bottom',
            showCloseButton:true,
            closeButtonText:"Cerrar"
          });
          toast.present();
          this.loading.dismiss();
        }
      });
  }


llenarCampos(){
   let toast = this.toastCtrl.create({
      message: "llenar todos los campos",
      duration: 5000,
      position: 'bottom',
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

