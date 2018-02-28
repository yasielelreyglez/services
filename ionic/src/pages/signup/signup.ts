import { Component,ViewChild } from '@angular/core';
import { IonicPage, NavController, NavParams ,ToastController, LoadingController} from 'ionic-angular';
import {User} from '../../models/user';
import {AuthProvider} from '../../providers/auth/auth';
 import { HomePage } from "../home/home";
import {CondicionesPage} from "../condiciones/condiciones";

@IonicPage()
@Component({
  selector: 'page-signup',
  templateUrl: 'signup.html',
})
export class SignupPage {
  user: User;
  error: string;
  condiciones:boolean;
  @ViewChild('f') f;

  constructor(public navCtrl: NavController,
    public navParams: NavParams,
    public toastCtrl: ToastController, public load: LoadingController,
    public auth: AuthProvider ) {
      this.user = new User();
      this.condiciones = false;
  }

  ionViewDidLoad() {

  }
  openCondiciones(){
    this.navCtrl.push(CondicionesPage);
  }

  doSignUp(){
    if( this.user.name.trim() != ''){
      let loading = this.load.create({
        content:"Registrando..."
      });
      loading.present();
      this.auth.signUp(this.user)
      .then(
        (result) => {
          if (result === true) {

               let toast = this.toastCtrl.create({
                message: "Se ha registrado satifactoriamente!",
                duration: 5000,
                position: 'bottom'
              });
              toast.present();
              this.navCtrl.setRoot(HomePage);
              //this.navCtrl.pop();
              } else {
                let toast = this.toastCtrl.create({
                  message: "Ya ese email esta en uso",
                  duration: 5000,
                  position: 'top'
                });
                toast.present();
              }
              loading.dismiss();

        }
      ).catch(
        (error) => {
          let toast = this.toastCtrl.create({
            message:error ,
            duration: 5000,
            position: 'top'
          });
          toast.present();
          loading.dismiss();
        }
      );
    }else{
      let toast = this.toastCtrl.create({
        message: "Llene todos los campos para registrarse",
        duration: 5000,
        position: 'bottom',
        showCloseButton:true,
        closeButtonText:"Cerrar"
      });
      toast.present();
    }


  }
  llenarCampos(){

    if(!this.f.form.valid){
      let toast = this.toastCtrl.create({
        message: "Llene todos los campos para registrarse",
        duration: 5000,
        position: 'bottom',
        showCloseButton:true,
        closeButtonText:"Cerrar"
      });
      toast.present();
    }
    else{
      let toast = this.toastCtrl.create({
        message: "Las contraseñas deben coincidir",
        duration: 5000,
        position: 'bottom',
        showCloseButton:true,
        closeButtonText:"Cerrar"
      });
      toast.present();
    }

 }

}
