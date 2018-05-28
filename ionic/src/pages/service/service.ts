import { Component } from "@angular/core";
import {
  IonicPage,
  NavParams,
  ModalController,
  NavController,
  Events,
  PopoverController,
  AlertController,
  ToastController
} from "ionic-angular";
import { ServiceProvider } from "../../providers/service/service.service";
import { InfoPage } from "../info/info";
import { MapaPage } from "../mapa/mapa";
import { AuthProvider } from "../../providers/auth/auth";
import { GaleriaPage } from "../galeria/galeria";
import { ComentariosPage } from "../comentarios/comentarios";
import { Service } from "../../models/service";
import { PopoverPage } from "../pop-over/pop-over";
import { SocialSharing } from "@ionic-native/social-sharing";

// @IonicPage()
@Component({
  selector: "page-service",
  templateUrl: "service.html"
  // entryComponents:[ ServUpInfoComponent]
})
export class ServicePage {
  response: Object;
  private service: Service;
  passedService: Service;
  cant_c: number;
  loggedIn: boolean;

  constructor(
    public navParams: NavParams,
    public servPro: ServiceProvider,
    public modalCtrl: ModalController,
    public auth: AuthProvider,
    public navCtrl: NavController,
    public events: Events,
    public popCtrl: PopoverController,
    public socialSharing: SocialSharing,
    private alertCtrl: AlertController,
    public toastCtrl: ToastController
  ) {
    this.passedService = this.navParams.get("service");
    // si recibo el id del servicio
    this.servPro.getService(this.navParams.get("serviceId")).then(data => {
      this.response = data;
      this.service = data["data"];
      this.passedService.servicecommentsList = this.service.servicecommentsList
        ? this.service.servicecommentsList
        : [];
      // this.cant_c = this.passedService.servicecommentsList.length ? this.passedService.servicecommentsList.length : 0;
      this.cant_c = this.passedService.servicecommentsList
        ? this.passedService.servicecommentsList.length
        : 0;
    });
  }

  ionViewDidLoad() {
    this.loggedIn = this.auth.isLoggedIn();
  }
  regularShare() {
    this.socialSharing.share(
      this.service.title + "/n" + this.service.address,
      null,
      null,
      null
    );
  }

  ionViewDidEnter() {
    this.events.subscribe("user:commented", comentarios => {
      this.passedService.servicecommentsList = comentarios;
      this.cant_c = this.passedService.servicecommentsList.length
        ? this.passedService.servicecommentsList.length
        : 0;
      //this.cant_c+=1;
    });
  }

  presentPopover(ev) {
    let popover = this.popCtrl.create(PopoverPage, {
      login: this.loggedIn,
      tipo: "servicio",
      denuncia: true,
      id: this.passedService.id
    });
    popover.present({
      ev: ev
    });
  }

  openInfo() {
    this.navCtrl.push(InfoPage, {
      service: this.passedService,
      cant_c: this.cant_c
    });
  }

  openMapa() {
    this.navCtrl.push(MapaPage, {
      response: this.response,
      cant_c: this.cant_c,
      service: this.passedService
    });
  }

  openGaleria() {
    this.navCtrl.push(GaleriaPage, {
      service: this.passedService,
      cant_c: this.cant_c
    });
  }

  openComentarios() {
    this.navCtrl.push(ComentariosPage, {
      service: this.passedService,
      cant_c: this.cant_c
    });
  }

  toogleFavorite(id) {
    if (this.passedService.favorite == 1) {
      let confirm = this.alertCtrl.create({
        title: "¿Está seguro que desea eliminar de favoritos? ",
        message: "",
        buttons: [
          {
            text: "No",
            handler: () => {}
          },
          {
            text: "Si",
            handler: () => {
              this.servPro.diskMarkfavorite(id).then(data => {
                this.passedService.favorite = 0;
                let toast = this.toastCtrl.create({
                  message: "Eliminado de Favoritos",
                  duration: 2000,
                  position: 'bottom',
                });
                toast.present();
              });
            }
          }
        ]
      });
      confirm.present();
    } else {
      this.servPro.markfavorite(id).then(data => {
        this.passedService.favorite = 1;
        let toast = this.toastCtrl.create({
          message: "Adicionado a Favoritos",
          duration: 2000,
          position: 'bottom',
        });
        toast.present();
      });
    }
  }
}
