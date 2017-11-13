import {User} from './../../_models/user';
import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {AuthService} from '../../_services/auth.service';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {ForgotpassComponent} from '../_modals/forgotpass/forgotpass.component';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
    user: User;
    loading: boolean;
    error: string;

    constructor(private router: Router, private authService: AuthService, private modalService: NgbModal) {
        this.user = new User();
        this.loading = false;
        this.error = '';
    }

    ngOnInit() {
        // reset login status
        this.authService.logout();
    }

    login() {
        this.loading = true;
        this.authService.login(this.user)
            .subscribe(result => {
                if (result === true) {
                    this.router.navigate(['']);
                } else {
                    this.error = 'Username or password is incorrect';
                    this.loading = false;
                }
            });
    }

    open() {
        const modalRef = this.modalService.open(ForgotpassComponent);
    }

}
