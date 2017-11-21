import { Component } from '@angular/core';
import { IonicPage,NavParams,ModalController,NavController} from "ionic-angular";
import { CallNumber } from '@ionic-native/call-number';
import  {ServiceProvider} from  '../../providers/service/service.service';
import { ApiProvider } from "../../providers/api/api";
import { RatePage } from "../rate/rate";
import { InfoPage } from "../info/info";
import { MapaPage } from "../mapa/mapa";

@IonicPage()
@Component({
  selector: 'page-service',
  templateUrl: 'service.html',
})
export class ServicePage {
  private service: any = {};
  private baseUrl: any;

  constructor(public navParams: NavParams,
    private callNumber: CallNumber,
    public servPro: ServiceProvider,
    public api: ApiProvider,
    public modalCtrl: ModalController,
    public navCtrl: NavController
   ) {
      this.baseUrl = this.api.getbaseUrl() + "resources/image";
      this.servPro.getService(this.navParams.get("serviceId")).then(data=> {
        this.service = data['data'];
      });
  }

  ionViewDidLoad() {

  }
  openRate(){
    const profileModal = this.modalCtrl.create(RatePage);
    profileModal.onDidDismiss(data => {
      // enviar rate
      console.log(data);
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
        service:this.service,
        baseUrl:this.baseUrl
      });
  }
}
