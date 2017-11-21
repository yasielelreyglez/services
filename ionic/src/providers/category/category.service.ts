import {Injectable} from '@angular/core';
import { HttpClient } from "@angular/common/http";
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/toPromise';
import { ApiProvider } from "../api/api";



@Injectable()
export class CategoryProvider {

  constructor(public http: HttpClient,public api: ApiProvider) {
  }
  getcategories():Promise<Object>{
    return this.http.get(this.api.getbaseUrl() + 'api/categories')
      .toPromise()
      .then(
        (response) => {
         return response;
        }
      ).catch()
  }

}


