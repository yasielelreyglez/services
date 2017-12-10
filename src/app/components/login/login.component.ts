import {User} from './../../_models/user';
import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {AuthService} from '../../_services/auth.service';
import {ForgotpassComponent} from '../_modals/forgotpass/forgotpass.component';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {MatDialog, MatSnackBar} from '@angular/material';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
    user: User;
    loading: boolean;
    error: string;
    hide = true;
    loginForm: FormGroup;

    constructor(public dialog: MatDialog, private router: Router, private authService: AuthService,
                private snackBar: MatSnackBar) {
        this.user = new User();
        this.loading = false;
        this.error = '';
    }

    ngOnInit() {
        // reset login status
        // this.authService.logout();
        this.createForm();
    }

    private createForm() {
        this.loginForm = new FormGroup({
            email: new FormControl('', [Validators.required, Validators.email]),
            password: new FormControl('', Validators.required),
        });
    }

    getErrorMessage() {
        return this.loginForm.controls['email'].hasError('required') ? 'You must enter a value' :
            this.loginForm.controls['email'].hasError('email') ? 'Not a valid email' :
                this.loginForm.controls['password'].hasError('required') ? 'You must enter a value' :
                    '';
    }

    login() {
        this.loading = true;
        this.authService.login(this.user)
            .subscribe(result => {
                if (result === true) {
                    this.router.navigate(['']);
                    this.openSnackBar('Usuario autenticado correctamente', 2500);
                } else {
                    this.error = 'Username or password is incorrect';
                    this.loading = false;
                }
            });
    }

    openDialog(): void {
        const dialogRef = this.dialog.open(ForgotpassComponent, {
            width: '70%',
        });

        dialogRef.afterClosed().subscribe(() => {
            console.log('The dialog was closed');
        });
    }

    openSnackBar(message: string, duration: number, action?: string ) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
        });
    }

}
