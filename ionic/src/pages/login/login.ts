import {Component} from '@angular/core';
import {
  IonicPage,
  NavController,
  LoadingController,
  ToastController,
  AlertController

} from "ionic-angular";
import {User} from '../../models/user';
import {AuthProvider} from '../../providers/auth/auth';
import {HomePage} from '../home/home';
import { NotificacionesPushProvider } from '../../providers/notificaciones-push/notificaciones-push';

// import { SignupPage } from '../signup/signup';

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {
  user: User;
  loading: any;
  showPassword: boolean = false;

  constructor(public navCtrl: NavController,
              public authService: AuthProvider,
              public toastCtrl: ToastController,
              public load: LoadingController,
              public push: NotificacionesPushProvider,
              public alertCtrl: AlertController) {
    this.user = new User();


  }

  loginFacebook(){
    let toast = this.toastCtrl.create({
      message: "Pronto estaremos conectados con Facebook!",
      duration: 5000,
      position: 'bottom',
      showCloseButton: true,
      closeButtonText: "Cerrar"
    });
    toast.present();
  }

  showPrompt() {
    let prompt = this.alertCtrl.create({
      title: 'Olvido de contraseña',
      message: "Escribe tu dirección de email",
      enableBackdropDismiss: false,
      inputs: [
        {
          name: 'email',
          type: 'email'
        },
      ],
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel'

        },
        {
          text: ' Enviarme contraseña',
          handler: data => {
            if (this.authService.validateEmail(data.email)) {
              // const navTransition = prompt.dismiss();

              // start some async method
              this.authService.forgot_password(data.email).then((respose) => {
                let toast = this.toastCtrl.create({
                  message: "La contraseña se a enviando a su correo",
                  duration: 5000,
                  position: 'bottom',
                  showCloseButton: true,
                  closeButtonText: "Cerrar"
                });
                toast.present();
                // navTransition.then(() => {
                //   this.navCtrl.pop();
                // });
              }).catch(
                (error) => {
                  let toast = this.toastCtrl.create({
                    message: "No se pudo mandar contraseña",
                    duration: 5000,
                    position: 'bottom',
                    showCloseButton: true,
                  });
                  toast.present();
                }
              );


            }
            else {
              return false;
            }


          }
        }
      ]
    });
    prompt.present();
  }

  doLogin() {
    this.loading = this.load.create({
      content: "Autenticando..."
    });
    this.loading.present();
    this.authService.login(this.user)
      .then(result => {
        if (result === true) {
          this.loading.dismiss();
          this.push.subcribe();
          this.navCtrl.setRoot(HomePage);
          //  this.navCtrl.pop();
        } else {
          let toast = this.toastCtrl.create({
            message: "Correo y/o contraseña incorrectos",
            duration: 5000,
            position: 'bottom',
            showCloseButton: true,
            closeButtonText: "Cerrar"
          });
          toast.present();
          this.loading.dismiss();
        }
      }).catch(
      (error) => {
        let toast = this.toastCtrl.create({
          message: "No hay conexión a internet",
          duration: 5000,
          position: 'bottom',
          showCloseButton: true,
        });
        toast.present();
        this.loading.dismiss();
        // this.navCtrl.goToRoot({});
        this.navCtrl.setRoot(HomePage, {
          connetionDown: true
        });
        this.navCtrl.pop();
      }
    );
  }


  llenarCampos() {
    let toast = this.toastCtrl.create({
      message: "Debe llenar los campos correctamente",
      duration: 5000,
      position: 'bottom',
      showCloseButton: true,
      closeButtonText: "Cerrar"
    });
    toast.present();
  }

  goToSignup() {
    this.navCtrl.push("SignupPage");
    // this.navCtrl.push(SignupPage);
  }

}

