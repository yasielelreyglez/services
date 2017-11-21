import { Injectable } from '@angular/core';
import {AuthProvider} from  '../auth/auth'
import {  HttpClient,  HttpHeaders } from "@angular/common/http";

/*
  Generated class for the ApiProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class ApiProvider {

  private apiBaseUrl = 'http://192.168.137.1/login/';  // URL to web apid
  private days : object = {
    0:"Domingo",
    1:"Lunes",
    2:"Martes",
    3:"Miercoles",
    4:"Jueves",
    5:"Viernes",
    6:"Sabado",
   };
  // private apiBaseUrl = ' http://localhost//login/';  // URL to web apid
  constructor(public http: HttpClient) {

  }

  getCities():Promise<Object>{
    return this.http.get(this.apiBaseUrl + 'api/cities')
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }
  getCategories():Promise<Object>{
    return this.http.get(this.apiBaseUrl + 'api/allsubcateogries')
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }

  getbaseUrl(): string{
    return this.apiBaseUrl;
  }
  getDays(): string{
    return this.apiBaseUrl;
  }
  private handleError(error: any): Promise<any> {
    return Promise.reject(error.message || error);
  }


}
