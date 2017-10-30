import {Injectable} from '@angular/core';
import {Http, Jsonp, Headers, RequestOptions, Response} from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import {AuthService} from './auth.service';
import {User} from '../_models/user';

@Injectable()
export class UserService {
    // private apiUrl = '/api/';

    constructor(private http: Http,
                private jsonp: Jsonp,
                private authService: AuthService) {

    }

    // getUsers(): Observable<User[]> {
    //     // add authorization header with jwt token
    //     let headers = new Headers({ 'Authorization': 'Bearer ' + this.authService.token });
    //     let options = new RequestOptions({ headers: headers });
    //
    //     // get users from api
    //     return this.http.get('/api/users', options)
    //         .map((response: Response) => response.json());
    // }
    getTest(): Observable<any> {
        // add authorization header with jwt token
        let headers = new Headers();
        let token = localStorage.getItem('currentUser');
        // console.log('TOKEN', token);
        // headers.append("pepito", 'Bearer ' + token);
        headers.append('Authorization', JSON.parse(token).token);
        // let options = new RequestOptions({headers: headers});

        let value = this.http.get('/login/api/peticion', {headers: headers})
            .map((response: Response) => response.json()    );
        return value;
    }

    // private getUrl(url: string) {
    //     return this.apiUrl + url;
    // }
}