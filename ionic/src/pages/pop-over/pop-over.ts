import { User } from './../../models/user';
import { ApiProvider } from './../../providers/api/api';
import { Component,OnInit } from '@angular/core';
import { ViewController,NavController,NavParams ,App} from 'ionic-angular';
// import {SignupPage} from '../signup/signup';
import {FavoritesPage} from '../favorites/favorites';
import {MyservicesPage} from '../myservices/myservices';
import {BusquedaPage} from '../busqueda/busqueda';
import {AuthProvider} from  '../../providers/auth/auth';
import { Create1Page } from "../create1/create1";
import { ModalDenunciaPage } from '../modal-denuncia/modal-denuncia';
// import { ChangePassPage } from '../change-pass/change-pass';
// import { BuzonPage } from './../buzon/buzon';

@Component({
  selector: 'pop-over',
  templateUrl: 'pop-over.html',
})
export class PopoverPage implements OnInit {
  tipo: any;
  id: any;
  denuncia: any;
  loggedIn: boolean;
  user: any;
  public loading: any;
  cantMensajesNoLeidos = 0;
  constructor(
    public navPar: NavParams,
    public auth: AuthProvider,
    public viewCtrl: ViewController,
    public navCtrl: NavController,
    public appCtrl: App,
    public api: ApiProvider
   ) {
  }
  ngOnInit() {
    this.user = this.api.getUser();
    this.loggedIn = this.navPar.get("login");
    this.denuncia = this.navPar.get("denuncia");
    this.tipo = this.navPar.get("tipo");
    this.id = this.navPar.get("id");
    setTimeout(() => {
      if(this.loggedIn){
        this.api.mensajesNoLeidos().then(result=>{
          if (result['data'] && result['data'].length > 0) {
                this.cantMensajesNoLeidos = result['data'].length;
          }
        })
      }
    }, 100);
  }

  close() {
    this.viewCtrl.dismiss();
  }

  logout() {
    this.auth.logout();
    // this.navCtrl.popToRoot();
    this.close();
    this.appCtrl.getActiveNavs()[0].popToRoot();
  }

  denunciar(){
    this.close();
    this.appCtrl.getActiveNavs()[0].push(ModalDenunciaPage,{tipo:this.tipo ,id:this.id});
  }

  openLoginPage(){
    this.close();
    this.appCtrl.getActiveNavs()[0].push("LoginPage");
  }

  openChangePassPage(){
    this.close();
    this.appCtrl.getActiveNavs()[0].push("ChangePassPage");
  }

  openSignUpPage(){
    this.close();
    this.appCtrl.getActiveNavs()[0].push("SignupPage");
  }
  openAyuda(){
    this.close();
    this.appCtrl.getActiveNavs()[0].push("AyudaPage");
  }
  openBuzon(){
    this.close();
    this.appCtrl.getActiveNavs()[0].push("BuzonPage");
  }

  openFavoritesPage(){
    this.close();
    this.appCtrl.getActiveNavs()[0].push(FavoritesPage);
  }
  openBusquedaPage(){
    this.close();
    this.appCtrl.getActiveNavs()[0].push(BusquedaPage);
  }
  openMyServicesPage(){
    this.close();
    this.appCtrl.getActiveNavs()[0].push(MyservicesPage);
  }
  openCreatePage(){
    this.close();
    this.appCtrl.getActiveNavs()[0].push(Create1Page);
  }
}
