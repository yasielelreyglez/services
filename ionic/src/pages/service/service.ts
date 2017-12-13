import { Component } from '@angular/core';
import { IonicPage,NavParams,ModalController,NavController, Events} from "ionic-angular";
import  {ServiceProvider} from  '../../providers/service/service.service';
import { InfoPage } from "../info/info";
import { MapaPage } from "../mapa/mapa";
import { AuthProvider } from "../../providers/auth/auth";
import { GaleriaPage } from "../galeria/galeria";
import { ComentariosPage } from "../comentarios/comentarios";
import { Service } from '../../models/service';

@IonicPage()
@Component({
  selector: 'page-service',
  templateUrl: 'service.html',
})
export class ServicePage {
  response: Object;
  private service: Service;
  private passedService: Service;

  cant_c :number;
  loggedIn: boolean;
  constructor(public navParams: NavParams,
    // private callNumber: CallNumber,
    public servPro: ServiceProvider,
    public modalCtrl: ModalController,
    public auth: AuthProvider,
    public navCtrl: NavController,
    public events: Events
   ) {
    this.passedService = this.navParams.get("service");
      // si recibo el id del servicio
        this.servPro.getService(this.navParams.get("serviceId")).then(data=> {
        this.response = data;
        this.service = data['data'];
      });

  }

  ionViewDidLoad() {
    this.loggedIn = this.auth.isLoggedIn();
    this.cant_c=this.passedService.servicecommentsList.length  ? this.passedService.servicecommentsList.length : 0
  }
  ionViewDidEnter() {

    this.events.subscribe('user:commented', (comentarios) => {
    this.passedService.servicecommentsList= comentarios;
    this.cant_c=this.passedService.servicecommentsList.length  ? this.passedService.servicecommentsList.length : 0
    //this.cant_c+=1;

    });
  }

  openInfo(){
      this.navCtrl.push(InfoPage,{
        service:this.passedService,
        cant_c:this.cant_c
      });
  }
  openMapa(){
      this.navCtrl.push(MapaPage,{
        response:this.response,
        cant_c:this.cant_c,
        service:this.passedService
      });
  }
  openGaleria(){
    this.navCtrl.push(GaleriaPage,{
      service:this.passedService,
      cant_c:this.cant_c
    });
}
  openComentarios(){
    this.navCtrl.push(ComentariosPage,{
      service:this.passedService,
      cant_c:this.cant_c
    });
  }
}
