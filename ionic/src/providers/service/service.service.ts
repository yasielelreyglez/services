import {Injectable} from '@angular/core';
import {AuthProvider} from '../auth/auth'
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {ApiProvider} from "../api/api";
import {sendService} from '../../models/sendService';

/*
  Generated class for the ServiceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class ServiceProvider {


  constructor(public http: HttpClient, public auth: AuthProvider, public api: ApiProvider) {

  }
  getBaseUrl(){
      return this.api.getbaseUrl();
  }

  deleteService(id) {
    if (this.auth.getUser()) {
      return this.http.get(this.api.getbaseUrl() + 'api/deleteservice/' + id, {
        headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
      })
        .toPromise()
        .then(
          (response) => {
            return response;
          }
        ).catch(this.handleError);
    }
  }

  createFullService(serv: sendService) {
    return this.http.post(this.api.getbaseUrl() + 'api/createservicefull', serv, {
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
    })
      .toPromise()
      .then(
        (response) => {
          // if (response['error']){
          return response;
          // console.log(response);
          //  return true;
        }
      ).catch(this.handleError);
  }

  getServiceBySubCat(subcategory): any {

    if (this.auth.getUser()) {
      return this.http.get(this.api.getbaseUrl() + 'api/servicessub/' + subcategory, {
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
      return this.http.get(this.api.getbaseUrl() + 'api/servicessub/' + subcategory)
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
      .get(this.api.getbaseUrl() + 'api/searchService/' + search)
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError)
  }

  getServiceBySearch(search): Promise<Object> {
    if (this.auth.getUser()) {
      return this.http.get(this.api.getbaseUrl() + 'api/searchService/' + search, {
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
      return this.http.get(this.api.getbaseUrl() + 'api/searchService/' + search)
        .toPromise()
        .then(
          (response) => {
            return response;
          }
        ).catch(this.handleError);
    }
  }

  getServicesFavorites(): Promise<Object> {
    return this.http.get(this.api.getbaseUrl() + 'api/myfavorites', {
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
    })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }

  denunciarService(id, denuncia): Promise<Object> {
    return this.http.get(this.api.getbaseUrl() + 'api/complaint/' + id + "?complaint=" + denuncia, {
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
    })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }

  getMyServices(): Promise<Object> {
    return this.http.get(this.api.getbaseUrl() + 'api/myservices', {
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
    })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }

  removeServiceVisited(id): Promise<Object> {
      return this.http.get(this.api.getbaseUrl() + 'api/removevisited/' + id, {
          headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
      })
          .toPromise()
          .then(
              (response) => {
                  return response;
              }
          ).catch(this.handleError);
  }

  getServicesVisited(): Promise<Object> {
    return this.http.get(this.api.getbaseUrl() + 'api/myvisits', {
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
    })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }

  getService(id): Promise<Object> {
    if (this.auth.getUser()) {
      return this.http.get(this.api.getbaseUrl() + 'api/service/' + id, {
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
      return this.http.get(this.api.getbaseUrl() + 'api/service/' + id)
        .toPromise()
        .then(
          (response) => {
            return response;
          }
        ).catch(this.handleError);
    }
  }

  markfavorite(id): Promise<Object> {
    return this.http.get(this.api.getbaseUrl() + 'api/markfavorite/' + id, {
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
    })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);

  }

  diskMarkfavorite(id): Promise<Object> {
    return this.http.get(this.api.getbaseUrl() + 'api/dismarkfavorite/' + id, {
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
    })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);

  }

  ejemplo_post(cities, categories, distance, current) {
    return this.http.post(this.api.getbaseUrl() + 'api/filter', {cities, categories})
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }

  rateservice(id, value,comment): Promise<Object> {
    return this.http.post(this.api.getbaseUrl() + 'api/rateservice/' + id + '/' + value,{comment},{
      headers: new HttpHeaders().set('Authorization', this.auth.getUser().token)
    })
      .toPromise()
      .then(
        (response) => {
          return response;
        }
      ).catch(this.handleError);
  }

  filterService(cities, categories, distance,current,query) {
    return this.http.post(this.api.getbaseUrl() + 'api/filter', {cities, categories,distance,current,query})
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
