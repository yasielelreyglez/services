import { Component, Input, Output, EventEmitter } from '@angular/core';
import { CallNumber } from '@ionic-native/call-number';
import { AuthProvider } from '../../providers/auth/auth';
import { ApiProvider } from '../../providers/api/api';
import { RatePage } from '../../pages/rate/rate';
import { ModalController, Platform } from 'ionic-angular';
import { ServiceProvider } from '../../providers/service/service.service';
import {PhotoViewer} from '@ionic-native/photo-viewer';
import { Service } from '../../models/service';

@Component({
  selector: 'serv-up-info',
  templateUrl: 'serv-up-info.html'
})
export class ServUpInfoComponent {
	@Input() passedService:Service;
  loggedIn: boolean;
  @Input() cant_c :number = 0;
  @Output() rateService: EventEmitter<any> = new EventEmitter<any>();

  constructor(public api: ApiProvider, public auth: AuthProvider,
    private callNumber: CallNumber,
    public servPro: ServiceProvider,
    public modalCtrl: ModalController,
    private photoViewer: PhotoViewer,private platform: Platform
  ) {

  }
  ngAfterViewInit(){
    this.loggedIn = this.auth.isLoggedIn();
  }
  Llamar(number){
    this.callNumber.callNumber(number, true)
    .then(() => {
      this.api.contactservice(this.passedService.id);
    })
    .catch(() => console.log('Error launching dialer'));
  }
  openRate(id,rated){
    const profileModal = this.modalCtrl.create(RatePage,{rated:rated});
    profileModal.onDidDismiss(data => {
      if(data.rate !== "cancel")
      this.servPro.rateservice(id,data.rate).then(
        data => {
          //  this.rateService.emit({globalRate:data['data'].globalrate,rated:data['data'].rated});
          this.passedService['globalrate'] = data['data'].globalrate;
          this.passedService['rated'] =data['data'].rated;;
        });
    });

    profileModal.present();
  }
  viewImg(img) {
    this.platform.ready().then(() => {
    this.photoViewer.show( img);
    });
  }

}
