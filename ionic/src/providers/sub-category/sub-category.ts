import {Injectable} from '@angular/core';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/toPromise';
import {AuthProvider} from  '../auth/auth';
import { HttpClient } from "@angular/common/http";
import { ApiProvider } from "../api/api";


@Injectable()
export class SubCategoryProvider {

  constructor(public http: HttpClient,public auth: AuthProvider,public api: ApiProvider) {  }

  topSubcategories():Promise<any>{
      return this.http.get(this.api.getbaseUrl()+'api/topSubcategories').toPromise()
      .then(
        (response) => {
         return response;
        }
      ).catch(this.handleError);
  }
  getsubcategories(category):Promise<Object[]>{
    return this.http.get(this.api.getbaseUrl()+ 'api/subcategories/'+category)
      .toPromise()
      .then(
        (response) => {
         return response;
        }
      ).catch(this.handleError)
  }

  private handleError(error: any): Promise<any> {
    return Promise.reject(error.message || error);
  }

}


