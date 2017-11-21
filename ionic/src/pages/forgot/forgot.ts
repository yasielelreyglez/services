import { Component } from '@angular/core';
import { IonicPage, ViewController, NavController } from "ionic-angular";
import { AuthProvider } from "../../providers/auth/auth";


@IonicPage()
@Component({
  selector: 'page-forgot',
  templateUrl: 'forgot.html',
})
export class ForgotPage {

  email:any
  constructor(public auth: AuthProvider,public navCtrl: NavController,public viewCtrl: ViewController) {
  }

  close(){
      this.viewCtrl.dismiss();
  }
  sendPassword(){
    if (this.auth.validateEmail(this.email)){
      let data = { 'email': this.email };
      this.viewCtrl.dismiss(data);
    }else
    {
      console.log("validar email");
    }

  }
  goSearch(keyCode) {
    if (keyCode === 13){
      this.sendPassword();
     }

  }



}
