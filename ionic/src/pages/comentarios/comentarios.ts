import { Component } from '@angular/core';
import { IonicPage, NavParams, Events, AlertController, PopoverController} from "ionic-angular";
import { AuthProvider } from '../../providers/auth/auth';
import {ApiProvider} from '../../providers/api/api'
import { HttpErrorResponse } from '@angular/common/http';
import { PopoverPage } from '../pop-over/pop-over';


@IonicPage()
@Component({
  selector: 'page-comentarios',
  templateUrl: 'comentarios.html'
})
export class ComentariosPage {
  loggedIn: boolean;
  service: any = {};
  comentarios : any[] = [];
  comentario : string;

  currentUser: any;
  cant_c:number;

  constructor(public alertCtrl: AlertController,
    public events: Events,
    public navParams: NavParams,
    public auth: AuthProvider,public api:ApiProvider,
    public popCtrl: PopoverController ) {
  }

  ionViewDidLoad() {
    this.service = this.navParams.get("service");
    this.cant_c = this.navParams.get("cant_c");
    this.comentarios= this.service['servicecommentsList'];
    this.currentUser = this.auth.getUser();
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
      message: "Elije la denuncia que desea hacer",
      enableBackdropDismiss: false,
      // <ion-radio checked="true" value="go"></ion-radio>
      inputs: [
        {
          name: 'denuncia1',
          type: 'radio',
          label: 'Denuncia 1'

        }, {
          name: 'denuncia2',
          type: 'radio',
          label: 'Denuncia 2'

        }, {
          name: 'denuncia3',
          type: 'radio',
          label: 'Denuncia 3'

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
          text: 'Realizar denuncia',
          handler: data => {
            //  this.api.reportComment(id)
          }
        }
      ]
    });
    prompt.present();
  }

  presentPopover(ev) {
    let popover = this.popCtrl.create(PopoverPage,{login:this.loggedIn,tipo:"comentario",denuncia:true,id:this.service.id});
    popover.present({
      ev: ev,
    });
  }


}
