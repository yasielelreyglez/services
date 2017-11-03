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
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        this.token = currentUser && currentUser.token;
    }

    login(user: User): Observable<boolean> {
        const body = JSON.stringify({email: user.email, password: user.password});
        return this.http.post('/login/auth/login', body).map(this.getData);
    }

    logout(): void {
        // clear token remove user from local storage to log user out
        this.token = null;
        localStorage.removeItem('currentUser');
    }

    public isAutenticate(): boolean {
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (currentUser && currentUser.token)
            return true;
        return false;
    }

    forgotPassword(email: string): Observable<any> {
        return this.http.post('/login/api/forgotpassword', email).map((response: Response) => {
                if (response.json().result === true) {
                    return true;
                } else {
                    return {error: response.json().result};
                }
            }
        );

    }


    private getData(response: Response) {
        const token = response.json() && response.json().token;
        if (token) {
            // set token property
            this.token = token;
            console.log(response.json());
            // store username and jwt token in local storage to keep user logged in between page refreshes
            localStorage.setItem('currentUser', JSON.stringify({email: response.json().email, token: token}));

            // return true to indicate successful login
            return true;
        } else {
            // return false to indicate failed login
            return false;
        }
    }

    private error(error: any) {
        const msg = (error.message) ? error.message : 'Error desconocido';
        console.log(msg);
        return Observable.throw(msg);
    }

    // private getUrl(url: string) {
    //     return this.apiUrl + url;
    // }

}
