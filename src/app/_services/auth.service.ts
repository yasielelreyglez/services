import {User} from './../_models/user';
import {Injectable} from '@angular/core';
import {Http, Headers, Response} from '@angular/http';
import {Observable} from 'rxjs/Observable';
import {BehaviorSubject} from 'rxjs/BehaviorSubject';
import 'rxjs/add/operator/map';


@Injectable()
export class AuthService {
    public token: string;
    currentUser: BehaviorSubject<boolean> = new BehaviorSubject(false);

    constructor(private http: Http) {
        // set token if saved in local storage
        this.currentUser.next(this.isAutenticate());
    }

    login(user: User): Observable<boolean> {
        const body = JSON.stringify({email: user.email, password: user.password});
        return this.http.post('http://localhost/services/auth/login', body).map(response => response.json()).map(result => {
            if (!result.error) {
                localStorage.setItem('currentUser', JSON.stringify(result));
                this.currentUser.next(result);
                return true;
            }
            return false;
        });
    }

    register(user: User): Observable<boolean> {
        const body = JSON.stringify({name: user.name, email: user.email, password: user.password});
        return this.http.post('http://localhost/services/auth/register', body).map(response => response.json()).map(result => {
            if (!result.error) {
                localStorage.setItem('currentUser', JSON.stringify(result));
                this.currentUser.next(result);
                return true;
            }
            return false;
        });
    }

    logout(): void {
        // clear token remove user from local storage to log user out
        localStorage.removeItem('currentUser');
        this.currentUser.next(false);
    }

    isAutenticate(): boolean {
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (currentUser && currentUser.token)
            return true;
        return false;
    }

    forgotPassword(email: string): Observable<any> {
        return this.http.post('http://localhost/services/api/forgotpassword', email).map((response: Response) => {
                if (response.json().result === true) {
                    return true;
                } else {
                    return {error: response.json().result};
                }
            }
        );
    }

    private error(error: any) {
        const msg = (error.message) ? error.message : 'Error desconocido';
        console.log(msg);
        return Observable.throw(msg);
    }

}
