import {Component, OnInit} from '@angular/core';
import {User} from '../../_models/user';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AuthService} from '../../_services/auth.service';
import {Router} from '@angular/router';


@Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.css'],
})
export class RegisterComponent implements OnInit {
    user: User;
    loading: boolean;
    error: string;
    registerForm: FormGroup;
    hide = true;

    constructor(private authService: AuthService, private router: Router) {
        this.user = new User();
        this.loading = false;
        this.error = '';
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
        return this.registerForm.controls['name'].hasError('required') ? 'You must enter a value' :
            this.registerForm.controls['email'].hasError('required') ? 'You must enter a value' :
                this.registerForm.controls['email'].hasError('email') ? 'Not a valid email' :
                    this.registerForm.controls['password'].hasError('required') ? 'You must enter a value' :
                        '';
    }

    register() {
        this.loading = true;
        this.authService.register(this.user).subscribe(result => {
            if (result === true) {
                this.router.navigate(['']);
            } else {
                this.error = 'Algo esta mal';
                this.loading = false;
            }
        });
    }
}
