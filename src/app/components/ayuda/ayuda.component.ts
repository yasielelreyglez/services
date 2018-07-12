import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {ActivatedRoute, Router} from '@angular/router';

/**
 * Generated class for the AyudaPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@Component({
    selector: 'app-page-ayuda',
    templateUrl: './ayuda.component.html',
    styleUrls: ['./ayuda.component.css']
})
export class AyudaComponent implements OnInit {
  msg: any;
  msgAdmin: any;
  constructor(private apiServices: ApiService, private route: ActivatedRoute, private router: Router) {}

  ionViewDidLoad() {
  }
  ngOnInit() {
  }
  mensajeAdmin() {

    this.msgAdmin = 'mailto:info@losyp.com?subject=DesdeLosyp&body=' + this.msg;
  }
}
