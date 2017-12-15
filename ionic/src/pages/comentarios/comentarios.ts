import { Component } from '@angular/core';
import { IonicPage, NavParams, Events, AlertController} from "ionic-angular";
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

  currentUser: any;
  cant_c:number;

  constructor(public alertCtrl: AlertController,
    public events: Events,
    public navParams: NavParams,
    public auth: AuthProvider,public api:ApiProvider ) {
  }

  ionViewDidLoad() {
    this.service = this.navParams.get("service");
    this.cant_c = this.navParams.get("cant_c");
    this.comentarios= this.service['servicecommentsList'];
    this.currentUser = this.auth.getUser();
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

  toggleComment(id: number, hided: boolean) {
    // let button = document.getElementById('hided-' + id);
    if (hided) {
        this.api.showComment(id).then(
          data => {
            this.comentarios = data['data'].servicecommentsList;
          },
          (err: HttpErrorResponse) => {
          console.log(err)
          });
    }
    else {
        this.api.hideComment(id).then(
          data => {
            this.comentarios = data['data'].servicecommentsList;
          },
          (err: HttpErrorResponse) => {
          console.log(err)
          });
    }
  }
  showPromptDenuncia(id) {
    let prompt = this.alertCtrl.create({
      title: 'Denunciar comentario',
      message: "Escriba la denuncia",
      enableBackdropDismiss: false,
      inputs: [
        {
          name: 'denuncia',
          type: 'textarea',

        },
      ],
      buttons: [
        {
          text: 'Cancelar',
          handler: data => {
            console.log('Cancel clicked');
          }
        },
        {
          text: 'Denunciar',
          handler: data => {
             this.api.reportComment(id)
          }
        }
      ]
    });
    prompt.present();
  }


}
