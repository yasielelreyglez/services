import { Component,OnInit } from '@angular/core';
import { ViewController,NavController,NavParams ,App} from 'ionic-angular';
import {LoginPage} from '../login/login';
import {SignupPage} from '../signup/signup';
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
    this.viewCtrl.dismiss();
    let navList =this.appCtrl.getActiveNavs();
    navList[0].pop;
    navList[0].pop;
    navList[0].pop;
    console.log(this.appCtrl.getActiveNavs());
    this.navCtrl.setRoot(HomePage);


   // this.auth.logout();
    //let navList =this.appCtrl.getActiveNavs();
    //console.log(navList);
   // this.navCtrl.popToRoot();
   // this.viewCtrl.dismiss();

  }

  openLoginPage(){
    this.navCtrl.push(LoginPage);
    this.viewCtrl.dismiss();
  }
  openSignUpPage(){
    this.navCtrl.push(SignupPage);
    this.viewCtrl.dismiss();
  }
  openFavoritesPage(){
    //this.navCtrl.push(FavoritesPage,);
    this.viewCtrl.dismiss();
    // this.appCtrl.getRootNav().push(FavoritesPage);

    this.appCtrl.getActiveNavs()[0].push(FavoritesPage);

  }
  openBusquedaPage(){
    this.navCtrl.push(BusquedaPage);
    this.viewCtrl.dismiss();
  }
  openMyServicesPage(){
    this.navCtrl.push(MyservicesPage);
    this.viewCtrl.dismiss();
  }

  openCreatePage(){
    this.navCtrl.push(Create1Page);
     this.viewCtrl.dismiss();

    // this.viewCtrl.dismiss();
  }
}
