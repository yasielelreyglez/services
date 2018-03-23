import {User} from './../_models/user';
import {Injectable} from '@angular/core';
import {Observable} from 'rxjs/Observable';
import {BehaviorSubject} from 'rxjs/BehaviorSubject';
import 'rxjs/add/operator/map';
import {HttpClient} from '@angular/common/http';


@Injectable()
export class AuthService {
    public token: string;
    currentUser: BehaviorSubject<boolean> = new BehaviorSubject(false);

    constructor(private http: HttpClient) {
        // set token if saved in local storage
        this.currentUser.next(this.isAutenticate());
    }

    // Metodo utilizado para poder utilizar el proxy en desarrollo y el baseURI en producción
    getBaseURL() {
        if (document.baseURI === 'http://localhost:4200/')
            return 'services/';
        return '';
    }

    login(user: User): Observable<any> {
        const body = JSON.stringify({email: user.email, password: user.password});
        return this.http.post(this.getBaseURL() + 'auth/login', body).map(response => response).map(result => {
            if (!result['error']) {
                localStorage.setItem('currentUser', JSON.stringify(result));
                this.currentUser.next(true);
                return true;
            }
            return result['error'];
        });
    }

    forgotPassword(email): Observable<any> {
        return this.http.post(this.getBaseURL() + 'auth/forgot_password/', {identity: email}).map(result => {
            if (!result['error']) {
                return true;
            } else {
                return result['error'];
            }
        });
    }

    changePassword(model) {
        console.log(model);
        return this.http.post(this.getBaseURL() + 'auth/change_password/', {
            old_password: model.old_password,
            new_password: model.new_password,
            new_password_confirm: model.new_password_confirm
        }).map(result => {
            if (!result['error']) {
                return true;
            } else {
                return result['error'];
            }
        });
    }

    register(user: User): Observable<any> {
        const body = JSON.stringify({name: user.name, email: user.email, password: user.password});
        return this.http.post(this.getBaseURL() + 'auth/register', body).map(response => response).map(result => {
            if (!result['error']) {
                localStorage.setItem('currentUser', JSON.stringify(result));
                this.currentUser.next(true);
                return true;
            }
            return result['error'];
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

    private error(error: any) {
        const msg = (error.message) ? error.message : 'Error desconocido';
        return Observable.throw(msg);
    }

}
