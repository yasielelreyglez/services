import { Component } from '@angular/core';
import { IonicPage,NavParams,ModalController,NavController} from "ionic-angular";
import { CallNumber } from '@ionic-native/call-number';
import  {ServiceProvider} from  '../../providers/service/service.service';
import { ApiProvider } from "../../providers/api/api";
import { RatePage } from "../rate/rate";
import { InfoPage } from "../info/info";
import { MapaPage } from "../mapa/mapa";
import { AuthProvider } from "../../providers/auth/auth";
import { GaleriaPage } from "../galeria/galeria";
import { ComentariosPage } from "../comentarios/comentarios";

@IonicPage()
@Component({
  selector: 'page-service',
  templateUrl: 'service.html',
})
export class ServicePage {
  response: Object;
  private service: any = {};
  private baseUrl: any;
  loggedIn: boolean;
  constructor(public navParams: NavParams,
    private callNumber: CallNumber,
    public servPro: ServiceProvider,
    public api: ApiProvider,
    public modalCtrl: ModalController,
    public auth: AuthProvider,
    public navCtrl: NavController
   ) {
      this.loggedIn = auth.isLoggedIn();
      this.baseUrl = this.api.getbaseUrl();
      // si recibo el id del servicio
      this.servPro.getService(this.navParams.get("serviceId")).then(data=> {
        this.response = data;
        this.service = data['data'];
      });
      // si recibo el servicio por params
    //  this.service = this.navParams.get("service");
  }

  ionViewDidLoad() {

  }
  openRate(){
    const profileModal = this.modalCtrl.create(RatePage);
    profileModal.onDidDismiss(data => {
      if(data.rate !== "cancel")
      this.servPro.rateservice(this.service.id,data.rate).then(
        data => {
          this.service.globalrate =data ['data'].globalrate;
        });

    });

    profileModal.present();
  }

  Llamar(number){
    this.callNumber.callNumber(number, true)
    .then(() => console.log('Launched dialer!'))
    .catch(() => console.log('Error launching dialer'));
  }
  openInfo(){
      this.navCtrl.push(InfoPage,{
        service:this.service,
        baseUrl:this.baseUrl
      });
  }
  openMapa(){
      this.navCtrl.push(MapaPage,{
        response:this.response,
        baseUrl:this.baseUrl
      });
  }
  openGaleria(){
    this.navCtrl.push(GaleriaPage,{
      service:this.service,
      baseUrl:this.baseUrl
    });
}
openComentarios(){
  this.navCtrl.push(ComentariosPage,{
    service:this.service,
    baseUrl:this.baseUrl
  });
}
}
