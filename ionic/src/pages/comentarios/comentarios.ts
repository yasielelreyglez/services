import { Component } from '@angular/core';
import { IonicPage, NavParams, Events} from "ionic-angular";
import { AuthProvider } from '../../providers/auth/auth';
import {ApiProvider} from '../../providers/api/api'
import { HttpErrorResponse } from '@angular/common/http';


@IonicPage()
@Component({
  selector: 'page-comentarios',
  templateUrl: 'comentarios.html'
})
export class ComentariosPage {
  service: any = {};
  comentarios : any[] = [];
  comentario : string;

  loggedIn: boolean;
  cant_c:number;

  constructor( public events: Events,public navParams: NavParams,public auth: AuthProvider,public api:ApiProvider ) {
  }

  ionViewDidLoad() {
    this.service = this.navParams.get("service");
    this.cant_c = this.navParams.get("cant_c");
    this.comentarios= this.service['servicecommentsList'];
    this.loggedIn = this.auth.isLoggedIn();
  }
 comentar(){
   this.api.addComment(this.service.id,this.comentario).then(
    data => {
      this.events.publish('user:commented', data['data'].servicecommentsList);
      this.comentario = null;
      this.comentarios = data['data'].servicecommentsList;
      this.cant_c+=1;
    },
    (err: HttpErrorResponse) => {
      if (err.error instanceof Error) {
      }
    });

 }


}
