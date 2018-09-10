import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {BehaviorSubject} from 'rxjs/Rx';
import 'rxjs/add/operator/map';
import {User} from '../../models/user';
import {ApiProvider} from "../api/api";
import {Observable} from "rxjs/Observable";
import 'rxjs/Rx';
import {Observer} from 'rxjs/Observer';
import {Geolocation, Geoposition} from "@ionic-native/geolocation";

// import {google} from "../../pages/mapa/mapa";


@Injectable()
export class AuthProvider {
  public currentUser = new BehaviorSubject<any>(false);
  public currentPosition = null;
  public lastPosition = null;
  latitud = null;
  longitud = null;
  watch = null;
  cantidad=0;
  constructor(public http: HttpClient, public api: ApiProvider, private geolocation: Geolocation) {
    this.currentUser.next(this.getUser());
    this.currentPosition = Observable.create((observer: Observer<Geoposition>) => {
      this.watch = this.geolocation.watchPosition({maximumAge: 60000, timeout: 60000})
        .filter((p) => p.coords !== undefined)
        .subscribe(position => {
          console.log("latitud iguales: ", this.latitud == position.coords.latitude);
          this.cantidad++
          if (this.latitud != position.coords.latitude || this.longitud != position.coords.longitude) {
            this.lastPosition = position;
            this.latitud = position.coords.latitude;
            this.longitud = position.coords.longitude;
            observer.next(position);
          }
          if (this.cantidad == 10)
            observer.next(position);
        });
    });
  }

// Login
  login(user: User): Promise<any> {
    const body = JSON.stringify({email: user.email, password: user.password});
    return this.http.post(this.api.getbaseUrl() + 'auth/login', body)
      .toPromise()
      .then(
        (response) => {
          if (response['error']) {
            return false;
          }
          else {
            let userD = {
              email: response['email'],
              token: response['token'],
              rol: response['role'],
              name: response['name'],
              loginProvider: response['loginProvider']
            }
            localStorage.setItem('ServCurrentUser', JSON.stringify(userD));
            this.currentUser.next(userD);
            this.api.updateUser();
          }
          return true;
        }
      ).catch(this.handleError);
  }

  change_pass(old_password, new_password): Promise<any> {
    const currentUser = localStorage.getItem('ServCurrentUser');
    return this.http.post(this.api.getbaseUrl() + 'auth/change_password', {
      old_password,
      new_password
    }, {headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)})
      .toPromise()
      .then(
        (response) => {
          if (response['error']) {
            return false;
          }
          else {
            console.log(response);
          }
          return true;
        }
      ).catch(this.handleError);
  }

  forgot_password(identity): Promise<any> {
    return this.http.post(this.api.getbaseUrl() + 'auth/forgot_password', {identity})
      .toPromise()
      .then(
        (response) => {
          console.log(response);
          if (response['error']) {
            return false;
          }
          else {
            console.log(response);
          }
          return true;
        }
      ).catch(this.handleError);
  }

  getLatitud(): number {
    return this.latitud;
  }

  getLongitud(): number {
    return this.longitud;
  }

  getlastPosition() {
    return this.lastPosition ? this.lastPosition : false;
  }

  // regista y autentica al usuario si todo sale bien
  signUp(user: User): Promise<any> {
    const body = JSON.stringify(user);
    return this.http.post(this.api.getbaseUrl() + 'auth/register', body)
      .toPromise()
      .then(
        (response) => {
          if (response['error']) {
            return false;
          }
          else {
            let userD = {
              email: response["email"],
              token: response['token'],
              rol: response['role'],
              name: response['name'],
              loginProvider: response['loginProvider']
            };
            localStorage.setItem('ServCurrentUser', JSON.stringify(userD));
            this.currentUser.next(userD);
            this.api.updateUser();
            return true;
          }

        }
      ).catch(this.handleError);
  }


  getUser() {
    var user = localStorage.getItem('ServCurrentUser');
    return user ? JSON.parse(user) : false;
  }

  logout(): void {
    localStorage.removeItem('ServCurrentUser');
    this.currentUser.next(false);
    this.api.updateUser();

  }

  isLoggedIn(): boolean {
    return this.getUser();
  }

  forgotPassword(email: string): Promise<any> {
    return this.http.post(this.api.getbaseUrl + 'api/forgotpassword', email)
      .toPromise()
      .then(
        (response) => {
          return !response['error'];

        }
      ).catch(this.handleError);

  }


  validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }

  private handleError(error: any): Promise<any> {
    return Promise.reject(error.message || error);
  }


}
