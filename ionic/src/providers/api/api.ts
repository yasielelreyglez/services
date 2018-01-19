import { Injectable } from '@angular/core';
import {  HttpClient,  HttpHeaders } from "@angular/common/http";



/*
  Generated class for the ApiProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class ApiProvider {
  // private apiBaseUrl = 'http://192.168.137.1/services/';
  private apiBaseUrl = 'http://localhost/services/';
  // private apiBaseUrl = 'http://php-yoidel86941305.codeanyapp.com/services/';
  private days : object;
  user:any;

  constructor(public http: HttpClient) {
    this.days ={

      0:"Lunes",
      1:"Martes",
      2:"Miercoles",
      3:"Jueves",
      4:"Viernes",
      5:"Sábado",
      6:"Domingo"
    }
    this.user =JSON.parse(localStorage.getItem('ServCurrentUser')) ;
  }

  contactservice(id):Promise<any>{

    if (this.user){
    return this.http.get(this.apiBaseUrl + 'api/contactservice/'+id,{
      headers: new HttpHeaders().set('Authorization', this.user.token)
     })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
    }
  }

  test():Promise<any>{
    return this.http.get(this.apiBaseUrl + 'api/test')
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
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
    return this.http.get(this.apiBaseUrl + 'api/allsubcategories')
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }
  addComment(id, comment){
    if (this.user){
    return this.http.post(this.apiBaseUrl + 'api/addcomment/'+id,{comment}, {
      headers: new HttpHeaders().set('Authorization', this.user.token)
     })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
    }
  }
  showComment(id){
    return this.http.get(this.apiBaseUrl+ 'api/showcomment/'+id,{
      headers: new HttpHeaders().set('Authorization', this.user.token)
      })
    .toPromise()
    .then(
      (response) => {
        return response;
      }
    ).catch(this.handleError);
  }
  hideComment(id){
    return this.http.get(this.apiBaseUrl+ 'api/hidecomment/'+id,{
      headers: new HttpHeaders().set('Authorization', this.user.token)
      })
    .toPromise()
    .then(
      (response) => {
        return response;
      }
    ).catch(this.handleError);
  }

  reportComment(id,data){
    return this.http.get(this.apiBaseUrl+ 'api/reportcomment/'+id,{
      headers: new HttpHeaders().set('Authorization', this.user.token)
      })
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
