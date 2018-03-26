import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
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
  public currentUser = new BehaviorSubject(false);
  public currentPosition = null;
  latitud = null;
  longitud = null;
  watch = null;

  constructor(public http: HttpClient, public api: ApiProvider, private geolocation: Geolocation) {
    this.currentUser.next(this.getUser());
    this.currentPosition = Observable.create((observer: Observer<Geoposition>) => {
      this.watch = this.geolocation.watchPosition({maximumAge: 60000, timeout: 60000})
        .filter((p) => p.coords !== undefined)
        .subscribe(position => {
          if (this.latitud != null) {
            if (this.latitud != position.coords.latitude || this.longitud != position.coords.longitude) {
              this.latitud = position.coords.latitude;
              this.longitud = position.coords.longitude;
              observer.next(position);
            }
          }
          if (this.latitud == null) {
            this.latitud = position.coords.latitude;
            this.longitud = position.coords.longitude;
            observer.next(position);
          }
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
            localStorage.setItem('ServCurrentUser', JSON.stringify({
              email: user.email,
              token: response['token'],
              rol: response['role']
            }));
            this.currentUser.next(true);
          }
          return true;
        }
      ).catch(this.handleError);
  }
  change_pass(old_password,new_password): Promise<any> {
      const currentUser = localStorage.getItem('currentUser');
    return this.http.post(this.api.getbaseUrl() + 'auth/change_password', {old_password,new_password},{headers: new HttpHeaders().set('Authorization', JSON.parse(currentUser).token)})
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

  // regista y autentica al usuario si todo sale bien
  signUp(user: User): Promise<any> {
    const body = JSON.stringify({name: user.name, email: user.email, password: user.password});
    return this.http.post(this.api.getbaseUrl() + 'auth/register', body)
      .toPromise()
      .then(
        (response) => {
          if (response['error']) {
            return false;
          }
          else {
            localStorage.setItem('ServCurrentUser', JSON.stringify({
              email: user.email,
              token: response['token'],
              rol: response['role']
            }));
            this.currentUser.next(true);
            return true;
          }

        }
      ).catch(this.handleError);
  }


  getUser() {
    var user = localStorage.getItem('ServCurrentUser');
    return user ? JSON.parse(user) : false;
  }

  getCurrentPosition() {
    return this.currentPosition;

  }

  setCurrentPosition() {
    return this.currentPosition;

  }

  logout(): void {
    localStorage.removeItem('ServCurrentUser');
    this.currentUser.next(false);
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
