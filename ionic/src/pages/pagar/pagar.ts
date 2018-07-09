import {Component} from '@angular/core';
import {NavController, NavParams, Platform, ToastController} from 'ionic-angular';
import {PhotoViewer} from '@ionic-native/photo-viewer';
import {ApiProvider} from '../../providers/api/api';

/**
 * Generated class for the PagarPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

// @IonicPage()
@Component({
    selector: 'page-pagar',
    templateUrl: 'pagar.html',
})
export class PagarPage {
    membresia: any;
    memberships: any;
    tipo_p: any;
    codigo: any;
    nombre_t: any;
    numero_t: any;
    cvv_t: any;
    expire: any;
    mostrandopago: boolean;
    service_id: number;
    pagos: any;
    private preview: string;

    constructor(public navCtrl: NavController,
                public navParams: NavParams,
                public photoViewer: PhotoViewer,
                private platform: Platform,
                public toastCtrl: ToastController,
                public apiProv: ApiProvider) {
        this.service_id = this.navParams.get('id');


        this.apiProv.memberships().then((result) => {

            this.memberships = result;
            //console.log(result);
        });
    }

    mostrarPagos() {
      this.mostrandopago = !this.mostrandopago;
      if (this.mostrandopago){
        this.apiProv.pagosrealizados( this.service_id ).then((result) => {
          this.pagos = result;
        });
      }

    }
    getPaymentType(tipo:any){
        if(tipo==1){
            return "por evidencia";
        }else{
            return "en linea"
        }
    }
    getTarjetaValues(pago:any){
        return pago.nombre+"("+pago.numero+")";
    }
    getPaymentState(state:any){
        if(state==0){
            return "sin aprobar";
        }else if(state==1){
            return "aprobado";
        }else{
            return "denegado";
        }
    }
    pagar() {
        if (this.tipo_p == 1) {
          if (this.preview == undefined || this.preview == "assets/imgs/service_img.png") this.mostrarMsg("Favor adjuntar evidencia");
          else
            this.apiProv.payService(this.service_id, {
                membership: this.membresia,
                type: this.tipo_p,
                evidence: this.preview
            }).then(result => {
                    this.pagos.push(result);
                    if(!this.mostrandopago) {
                        this.mostrarPagos();
                    }
                    // this.navCtrl.pop().then((valor) => {
                    //
                    // });
                  this.mostrarMsg("Gracias por su pago!");
                }
            ).catch(error=>this.mostrarMsg("Ha ocurrido un error"));
        } else {
            this.apiProv.payServiceOnline(this.service_id, {
                name: this.nombre_t,
                number: this.numero_t,
                type: this.tipo_p,
                cvv: this.cvv_t,
                expire: this.expire,
                membership: this.membresia
            }).then(result => {
                this.pagos.push(result,0);
                if(!this.mostrandopago) {
                    this.mostrarPagos();
                }
                    // this.navCtrl.pop().then((valor) => {
                    //
                    // });
                  this.mostrarMsg("Gracias por su pago!");
                }
            ).catch(error=>this.mostrarMsg("Ha ocurrido un error"));;
        }

    }

    ionViewDidLoad() {
        this.preview = 'assets/imgs/service_img.png';

    }

    viewImg() {
        this.platform.ready().then(() => {
            this.photoViewer.show(this.preview);
        });
    }
    mostrarMsg(msg){
      let toast = this.toastCtrl.create({
        message: msg,
        duration: 5000,
        position: "bottom"
      });
      toast.present();
    }
}
