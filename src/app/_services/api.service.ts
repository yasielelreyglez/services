import {Injectable} from '@angular/core';
import {Http, Response} from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import {Subcategory} from '../_models/subcategory';

@Injectable()
export class ApiService {

    constructor(private http: Http) {
    }

    topSubcategories(): Observable<Subcategory[]> {
        return this.http.get('/login/api/topsubcategories').map((response) => {
            if (response)
                return response.json() as Subcategory[];
            else {
                return new Subcategory[0];
            }
        });
    }
}
