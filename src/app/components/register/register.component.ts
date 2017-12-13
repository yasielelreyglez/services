import {Component, OnInit} from '@angular/core';
import {User} from '../../_models/user';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AuthService} from '../../_services/auth.service';
import {Router} from '@angular/router';
import {MatSnackBar} from '@angular/material';


@Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.css'],
})
export class RegisterComponent implements OnInit {
    user: User;
    loading: boolean;
    registerForm: FormGroup;
    hide = true;

    constructor(private authService: AuthService, private router: Router, private snackBar: MatSnackBar) {
        this.user = new User();
        this.loading = false;
    }

    ngOnInit() {
        this.createForm();
    }

    private createForm() {
        this.registerForm = new FormGroup({
            name: new FormControl('', Validators.required),
            email: new FormControl('', [Validators.required, Validators.email]),
            password: new FormControl('', Validators.required),
            confirmpassword: new FormControl('', Validators.required),
        });
    }

    getErrorMessage() {
        return this.registerForm.controls['name'].hasError('required') ? 'Debe escribir un valor' :
            this.registerForm.controls['email'].hasError('required') ? 'Debe escribir un valor' :
                this.registerForm.controls['email'].hasError('email') ? 'Correo no valido' :
                    this.registerForm.controls['password'].hasError('required') ? 'Debe escribir un valor' :
                        '';
    }

    register() {
        this.loading = true;
        this.authService.register(this.user).subscribe(result => {
            if (result === true) {
                this.router.navigate(['']);
            } else {
                this.loading = false;
                this.openSnackBar(result, 2500);
            }
        });
    }

    openSnackBar(message: string, duration: number, action?: string) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
        });
    }
}
