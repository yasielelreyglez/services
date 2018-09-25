import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {ActivatedRoute, Router} from '@angular/router';

/**
 * Generated class for the politicaPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@Component({
    selector: 'app-page-politica',
    templateUrl: './politica.component.html',
    styleUrls: ['./politica.component.css']
})
export class PoliticaComponent implements OnInit {
  msg: any;
  msgAdmin: any;
  dinamicContent: string;
  constructor(private apiServices: ApiService, private route: ActivatedRoute, private router: Router) {
      this.msg = '';
      this.apiServices.dinamicpage('terminos_condiciones').subscribe(result => {
          if (!(result === 'false')) {
              this.dinamicContent = result;
              console.log(result);
          }
      });
  }

    sendMessage(){
        this.apiServices.sendmessage(this.msg).subscribe(result => {
            if (!(result === 'false')) {
                this.dinamicContent = result;
                console.log(result);
            }
        });
    }
  ionViewDidLoad() {

  }
  ngOnInit() {
  }
  mensajeAdmin() {

    this.msgAdmin = 'mailto:info@losyp.com?subject=DesdeLosyp&body=' + this.msg;
  }
}
