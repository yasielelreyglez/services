import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import {HomePage} from '../home/home'
import { TabMapaPage } from '../tab-mapa/tab-mapa';

/**
 * Generated class for the TabPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

// @IonicPage()
@Component({
  selector: 'page-tab',
  templateUrl: 'tab.html',
})
export class TabPage {

  tab1Root = HomePage;
  tab2Root = TabMapaPage;
  constructor(public navCtrl: NavController, public navParams: NavParams) {
  }

}
