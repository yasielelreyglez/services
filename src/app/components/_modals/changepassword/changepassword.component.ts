import {Component, Inject, OnInit} from '@angular/core';
import {AuthService} from '../../../_services/auth.service';
import {MAT_DIALOG_DATA, MatDialogRef, MatSnackBar} from '@angular/material';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';

@Component({
    selector: 'app-changepassword',
    templateUrl: './changepassword.component.html',
    styleUrls: ['./changepassword.component.css']
})
export class ChangepasswordComponent implements OnInit {
    model: any;
    loading: boolean;
    error: string;
    forgotForm: FormGroup;

    constructor(public dialogRef: MatDialogRef<ChangepasswordComponent>,
                @Inject(MAT_DIALOG_DATA) public data: any,
                private authService: AuthService, private snackBar: MatSnackBar, private router: Router) {
        this.model = {};
        this.loading = false;
        this.error = '';
    }

    ngOnInit() {
        // this.createForm();
    }

    // private createForm() {
    //     this.forgotForm = new FormGroup({
    //         email: new FormControl('', [Validators.required, Validators.email])
    //     });
    // }

    enviar() {
        this.loading = true;
        this.authService.changePassword(this.model).subscribe(result => {
            if (result === true) {
                this.dialogRef.close();
                this.authService.logout();
                this.router.navigate(['login']);
                this.openSnackBar('Su contraseña ha sido modificada correctamente.', 2500);
            }
            else {
                this.loading = false;
                this.openSnackBar('Ha ocurrido un error en la operación.', 2500);
            }
        });
    }

    getErrorMessage() {
        return this.forgotForm.controls['email'].hasError('required') ? 'Debe escribir un valor' :
            this.forgotForm.controls['email'].hasError('email') ? 'Correo no valido' :
                '';
    }

    onNoClick(): void {
        this.dialogRef.close();
    }

    openSnackBar(message: string, duration: number, action?: string ) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
        });
    }
}
