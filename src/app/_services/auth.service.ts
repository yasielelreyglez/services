import {User} from './../_models/user';
import {Injectable} from '@angular/core';
import {Http, Headers, Response} from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';


@Injectable()
export class AuthService {
    public token: string;
    // private apiUrl = '/api/';

    constructor(private http: Http) {
        // set token if saved in local storage
        let currentUser = JSON.parse(localStorage.getItem('currentUser'));
        this.token = currentUser && currentUser.token;
    }

    login(user: User): Observable<boolean> {
        let body = JSON.stringify({email: user.username, password: user.password})
        return this.http.post('/login/auth/login', body).map(this.getData);
    }

    logout(): void {
        // clear token remove user from local storage to log user out
        this.token = null;
        localStorage.removeItem('currentUser');
    }

    private getData(response: Response) {
        let token = response.json() && response.json().token;
        if (token) {
            // set token property
            this.token = token;
            console.log(response.json());
            // store username and jwt token in local storage to keep user logged in between page refreshes
            localStorage.setItem('currentUser', JSON.stringify({username: response.json().username, token: token}));

            // return true to indicate successful login
            return true;
        } else {
            // return false to indicate failed login
            return false;
        }
    }

    private error(error: any) {
        let msg = (error.message) ? error.message : 'Error desconocido';
        console.log(msg);
        Observable.throw(msg);
    }

    // private getUrl(url: string) {
    //     return this.apiUrl + url;
    // }

}