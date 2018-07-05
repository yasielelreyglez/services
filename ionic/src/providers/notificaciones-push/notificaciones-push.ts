import { Injectable } from "@angular/core";
import { Platform, ToastController } from "ionic-angular";
import { FCM } from "@ionic-native/fcm";
import { ApiProvider } from "../api/api";
import { AuthProvider } from "../auth/auth";

@Injectable()
export class NotificacionesPushProvider {
  constructor(
    private platform: Platform,
    private fcm: FCM,
    private toastCtrl: ToastController,
    private api: ApiProvider,
    private auht: AuthProvider
  ) {}

  getOS(): string {
    let os = "";
    if (this.platform.is("ios")) {
      os = "IOS";
    } else if (this.platform.is("android")) {
      os = "ANDROID";
    }
    return os;
  }

  checkTokenMovil() {
    this.fcm.getToken().then(deviceID => {
      if (localStorage.getItem("device_id") != deviceID) {
        this.api.updateDeviceID(deviceID, this.getOS()).then(resp => {
          localStorage.setItem("device_id", deviceID);
        });
      }
    });
  }

  adminSubcribe() {
    this.fcm.subscribeToTopic("losypAdminNotificacion");
  }

  adminUnsubcribe() {
    this.fcm.unsubscribeFromTopic("losypAdminNotificacion");
  }

  pushSetup() {
    this.fcm.onNotification().subscribe(data => {
      if (data.wasTapped) {
        console.log("Received in background");
      } else {
        let title = "Información";
        let body = "Nueva Notificación, Ver App";
        if ("title" in data) title = data["title"];
        if ("body" in data) body = data["body"];
        let toast = this.toastCtrl.create({
          message: body,
          duration: 15000,
          position: "bottom",
          showCloseButton: true
        });
        toast.present();
      }
    });
  }

  subcribe() {
    this.auht.currentUser.subscribe(user => {
      this.checkTokenMovil();
        this.pushSetup();
        this.deviceRefreshToken();
        if (user && user["rol"] == "admin") this.adminSubcribe();
        else this.adminUnsubcribe();
    });
  }

  deviceRefreshToken() {
    this.fcm.onTokenRefresh().subscribe(deviceID => {
      localStorage.set("device_id", deviceID);
      this.api.updateDeviceID(deviceID, this.getOS()).then(resp => {
        localStorage.setItem("device_id", deviceID);
        let toast = this.toastCtrl.create({
          message: deviceID,
          duration: 15000,
          position: "bottom",
          showCloseButton: true
        });
        toast.present();
      });
    });
  }
}
