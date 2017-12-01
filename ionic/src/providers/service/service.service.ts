import { Injectable } from '@angular/core';
import {AuthProvider} from  '../auth/auth'
import {  HttpClient,  HttpHeaders } from "@angular/common/http";
import { ApiProvider } from "../api/api";

/*
  Generated class for the ServiceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class ServiceProvider {


  constructor(public http: HttpClient,public auth: AuthProvider,public api: ApiProvider) {

  }
   getServiceBySubCat(subcategory):any{

    if (this.auth.getUser()){
            return this.http.get(this.api.getbaseUrl() + 'api/servicessub/'+subcategory,{
        headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
       })
        .toPromise()
        .then(
          (response) => {
           return response;
          }
        ).catch(this.handleError);
      }
      else{
        return this.http.get(this.api.getbaseUrl() + 'api/servicessub/'+subcategory)
        .toPromise()
        .then(
          (response) => {
           return response;
          }
        ).catch(this.handleError);
      }
  }

  get(search): Promise<Object> {
    return this.http
      .get(this.api.getbaseUrl() + 'api/searchService/'+search)
      // .get<MyModel>(`${this.url}`)
      .toPromise()
      .then(
        (response) => {
          console.log(response);
         return response;
        }
      ).catch(this.handleError);;
}

  getServiceBySearch(search):Promise<Object>{
    if (this.auth.getUser()){
    return this.http.get(this.api.getbaseUrl() + 'api/searchService/'+search,{
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
     })
      .toPromise()
      .then(
        (response) => {
         return response;
        }
      ).catch(this.handleError);
    }
    else{
      return this.http.get(this.api.getbaseUrl() + 'api/searchService/'+search)
      .toPromise()
      .then(
        (response) => {
         return response;
        }
      ).catch(this.handleError);
    }
  }

  getServicesFavorites():Promise<Object>{
    return this.http.get(this.api.getbaseUrl() + 'api/myfavorites',{
      headers: new HttpHeaders().set('Authorization',this.auth.getUser().token)
     })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }
  denunciarService(id,denuncia):Promise<Object>{
    return this.http.get(this.api.getbaseUrl() + 'api/complaint/'+id+"?complaint="+denuncia,{
      headers: new HttpHeaders().set('Authorization',this.auth.getUser().token)
     })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }

  getMyServices():Promise<Object>{
    return this.http.get(this.api.getbaseUrl() + 'api/myservices',{
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
     })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }
  getServicesVisited():Promise<Object>{
    return this.http.get(this.api.getbaseUrl() + 'api/myvisits',{
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
     })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }
  getService(id):Promise<Object>{
    if (this.auth.getUser()){
      return this.http.get(this.api.getbaseUrl() + 'api/service/'+id,{
        headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
        })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
    }
    else {
      return this.http.get(this.api.getbaseUrl() + 'api/service/'+id)
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
    }
  }
  markfavorite(id):Promise<Object>{
      return this.http.get(this.api.getbaseUrl() + 'api/markfavorite/'+id,{
        headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
        })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);

  }
  diskMarkfavorite(id):Promise<Object>{
    return this.http.get(this.api.getbaseUrl() + 'api/dismarkfavorite/'+id,{
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
      })
    .toPromise()
    .then(
      (response) => {
        return response;
      }
    ).catch(this.handleError);

}
rateservice(id,value):Promise<Object>{
  return this.http.get(this.api.getbaseUrl() + 'api/rateservice/'+id+'/'+value,{
    headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
    })
  .toPromise()
  .then(
    (response) => {
      return response;
    }
  ).catch(this.handleError);

}


  private handleError(error: any): Promise<any> {
    return Promise.reject(error.message || error);
  }


}
