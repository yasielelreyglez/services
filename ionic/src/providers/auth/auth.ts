import { Injectable } from '@angular/core';
import {  HttpClient } from "@angular/common/http";
import {BehaviorSubject} from 'rxjs/Rx';
import 'rxjs/add/operator/map';
import {User} from '../../models/user';
import { ApiProvider } from "../api/api";


@Injectable()
export class AuthProvider {
  public currentUser = new BehaviorSubject(false);
  public zz = new BehaviorSubject(false);


  constructor(public http: HttpClient,public api: ApiProvider) {
    this.currentUser.next(this.getUser());
  }
// Login
  login(user: User): Promise<any> {
    const body = JSON.stringify({email: user.email, password: user.password});
    return this.http.post(this.api.getbaseUrl()+'auth/login', body)
    .toPromise()
    .then(
      (response) => {
        if (response['error']){
          return false;
          }
        else{
          localStorage.setItem('ServCurrentUser',JSON.stringify({email: user.email, token: response['token'], rol:response['role']}));
          this.currentUser.next(true);
        }
        return true;
      }
    ).catch(this.handleError);
  }

  // regista y autentica al usuario si todo sale bien
  signUp(user: User): Promise<any> {
    const body = JSON.stringify({name: user.name, email: user.email, password: user.password});
    return this.http.post(this.api.getbaseUrl()+'auth/register', body)
    .toPromise()
    .then(
      (response) => {
        if (response['error']){
          return false;
        }
        else{
          localStorage.setItem('ServCurrentUser',JSON.stringify({email: user.email, token: response['token'], rol:response['role']}));
          this.currentUser.next(true);
          return true;
        }

      }
    ).catch(this.handleError);
  }


  getUser(){
    var user = localStorage.getItem('ServCurrentUser');
    return user ? JSON.parse(user): false;
  }

  logout(): void {
    localStorage.removeItem('ServCurrentUser');
    this.currentUser.next(false);
  }

  isLoggedIn(): boolean{
    return !!this.getUser();
  }

  forgotPassword(email: string): Promise<any> {
    return this.http.post(this.api.getbaseUrl+'api/forgotpassword', email)
    .toPromise()
    .then(
      (response) => {
        console.log(response);
        if (response['error']){
          return false;
        }
        return true;
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
