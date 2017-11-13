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
        return this.http.get('/login/api/topsubcategories').map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Subcategory[0];
            }
        });
    }

    categories(): Observable<any> {
        return this.http.get('/login/api/categories').map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    subCategories(id: number): Observable<Subcategory[]> {
        return this.http.get('/login/api/subcategories/' + id).map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    servicesSub(id: number): Observable<any> {
        return this.http.get('/login/api/servicessub/' + id).map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    myfavorites(): Observable<any> {
        return this.http.get('/login/api/myfavorites').map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    myServices(): Observable<any> {
        return this.http.get('/login/api/myservices').map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    service(id: string): Observable<any> {
        return this.http.get('/login/api/service/' + id).map((response: Response) => {
            if (response)
                return response.json().data;
            else {
                return new Array();
            }
        });
    }

    report(report: string): Observable<any> {
        return this.http.post('/login/api/report', report).map((response: Response) => {
                if (response.json().result === true) {
                    return true;
                } else {
                    return {error: response.json().result};
                }
            }
        );
    }
}
