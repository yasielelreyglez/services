import { Component,OnInit } from '@angular/core';
import { ViewController,NavController,NavParams ,App} from 'ionic-angular';
import {LoginPage} from '../login/login';
// import {SignupPage} from '../signup/signup';
import {HomePage} from '../home/home';
import {FavoritesPage} from '../favorites/favorites';
import {MyservicesPage} from '../myservices/myservices';
import {BusquedaPage} from '../busqueda/busqueda';
import {AuthProvider} from  '../../providers/auth/auth';
import { Create1Page } from "../create1/create1";



@Component({
  selector: 'pop-over',
  templateUrl: 'pop-over.html',
})
export class PopoverPage implements OnInit {
  loggedIn: boolean;
  public loading: any;
  constructor(
    public navPar: NavParams,
    public auth: AuthProvider,
    public viewCtrl: ViewController,
    public navCtrl: NavController,
    public appCtrl: App
   ) {
  }
  ngOnInit() {
    this.loggedIn = this.navPar.get("login");
  }
  close() {
    this.viewCtrl.dismiss();
  }
  logout() {
    this.auth.logout();
    // this.navCtrl.popToRoot();
    this.close()
    this.appCtrl.getActiveNavs()[0].popToRoot();
  }
  openLoginPage(){
    this.close()
    this.appCtrl.getActiveNavs()[0].push("LoginPage");
  }
  openSignUpPage(){
    this.close()
    this.appCtrl.getActiveNavs()[0].push("SignupPage");
  }
  openFavoritesPage(){
    this.close()
    this.appCtrl.getActiveNavs()[0].push(FavoritesPage);
  }
  openBusquedaPage(){
    this.navCtrl.push(BusquedaPage);
    this.close()
  }
  openMyServicesPage(){
    // this.navCtrl.push(MyservicesPage);
    // this.close()

    this.close()
    this.appCtrl.getActiveNavs()[0].push(MyservicesPage);
  }
  openCreatePage(){
    this.navCtrl.push(Create1Page);
    this.close()
  }
}
