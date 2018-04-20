import {User} from './../../_models/user';
import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {AuthService} from '../../_services/auth.service';
import {ForgotpassComponent} from '../_modals/forgotpass/forgotpass.component';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {MatDialog, MatSnackBar} from '@angular/material';
import {Globals} from '../../_models/globals';
import {ApiService} from '../../_services/api.service';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
    user: User;
    loading: boolean;
    hide = true;
    loginForm: FormGroup;

    constructor(public dialog: MatDialog, private router: Router, private authService: AuthService, private globals: Globals,
                private snackBar: MatSnackBar, private apiServices: ApiService) {
        this.user = new User();
        this.loading = false;
    }

    ngOnInit() {
        this.createForm();
    }

    private createForm() {
        this.loginForm = new FormGroup({
            email: new FormControl('', [Validators.required, Validators.email]),
            password: new FormControl('', Validators.required),
        });
    }

    getErrorMessage() {
        return this.loginForm.controls['email'].hasError('required') ? 'Debe escribir un valor' :
            this.loginForm.controls['email'].hasError('email') ? 'Correo no valido' :
                this.loginForm.controls['password'].hasError('required') ? 'Debe escribir un valor' :
                    '';
    }

    login() {
        this.loading = true;
        this.authService.login(this.user)
            .subscribe(result => {
                if (result === true) {
                    this.router.navigate(['']);
                    this.openSnackBar('Usuario autenticado correctamente.', 2500);
                    this.apiServices.mensajesNoleidos().subscribe(response => {
                        if (response['data']) {
                            if (response['data'].length > 0) {
                                this.globals.mensajes.next(true);
                            }
                            else {
                                this.globals.mensajes.next(false);
                            }
                        }
                        else {
                            this.openSnackBar(response['error'], 2500);
                        }
                    });
                } else {
                    this.loading = false;
                    this.openSnackBar(result, 2500);
                }
            });
    }

    openDialog(): void {
        const dialogRef = this.dialog.open(ForgotpassComponent, {
            width: '70%',
            height: '330px'
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
