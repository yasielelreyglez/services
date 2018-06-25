import { Injectable } from "@angular/core";
import { Platform, ToastController } from "ionic-angular";
// import { FCM } from "@ionic-native/fcm";

@Injectable()
export class NotificacionesPushProvider {
  constructor(private platform: Platform, private toastCtrl:ToastController) {}

  // pushSetup() {
  //   this.fcm.onNotification().subscribe(data => {
  //     if (data.wasTapped) {
  //       console.log("Received in background");
  //     } else {
  //       let title = "Información";
  //       let body = "Revisar Aplicación";
  //       if ("title" in data) title = data["title"];
  //       if ("body" in data) body = data["body"];
  //       let toast = this.toastCtrl.create({
  //         message: body,
  //         duration: 15000,
  //         position: 'bottom',
  //         showCloseButton: true
  //       });
  //       toast.present();
  //     }
  //   });
  //   this.deviceRefreshToken();
  // }

  deviceRefreshToken() {
    // this.fcm.onTokenRefresh().subscribe(deviceID => {
      // this.storage.set("device_id", deviceID);
      //*TODO: enviar al back la notificacion */
    // });
  }
}
