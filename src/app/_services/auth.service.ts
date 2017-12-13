import {User} from './../_models/user';
import {Injectable} from '@angular/core';
import {Http} from '@angular/http';
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

    login(user: User): Observable<any> {
        const body = JSON.stringify({email: user.email, password: user.password});
        return this.http.post('services/auth/login', body).map(response => response.json()).map(result => {
            if (!result.error) {
                localStorage.setItem('currentUser', JSON.stringify(result));
                this.currentUser.next(result);
                return true;
            }
            return result.error;
        });
    }

    register(user: User): Observable<any> {
        const body = JSON.stringify({name: user.name, email: user.email, password: user.password});
        return this.http.post('services/auth/register', body).map(response => response.json()).map(result => {
            if (!result.error) {
                localStorage.setItem('currentUser', JSON.stringify(result));
                this.currentUser.next(result);
                return true;
            }
            return result.error;
        });
    }

    logout(): void {
        // clear token remove user from local storage to log user out
        localStorage.removeItem('currentUser');
        localStorage.removeItem('searchServices');
        this.currentUser.next(false);
    }

    isAutenticate(): boolean {
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (currentUser && currentUser.token)
            return true;
        return false;
    }

    forgotPassword(email: string): Observable<any> {
        return this.http.post('services/api/forgotpassword', email).map((response) => {
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
        return Observable.throw(msg);
    }

}
