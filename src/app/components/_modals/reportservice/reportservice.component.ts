import {Component, Inject, OnInit} from '@angular/core';
import {ApiService} from '../../../_services/api.service';
import {MAT_DIALOG_DATA, MatDialogRef, MatSnackBar} from '@angular/material';
import {FormControl, FormGroup, Validators} from '@angular/forms';

@Component({
    selector: 'app-report',
    templateUrl: './reportservice.component.html',
    styleUrls: ['./reportservice.component.css']
})
export class ReportServiceComponent implements OnInit {
    model: any;
    loading: boolean;
    reportForm: FormGroup;

    constructor(public dialogRef: MatDialogRef<ReportServiceComponent>,
                @Inject(MAT_DIALOG_DATA) public data: any,
                private apiServices: ApiService, private snackBar: MatSnackBar) {
        this.model = {id: this.data.id};
        this.loading = false;
    }

    ngOnInit() {
        this.createForm();
    }

    private createForm() {
        this.reportForm = new FormGroup({
            report: new FormControl('', [Validators.required])
        });
    }

    enviar() {
        this.loading = true;
        this.apiServices.report(this.model).subscribe(result => {
            if (result === true) {
                this.dialogRef.close();
            } else {
                this.loading = false;
                this.openSnackBar(result, 2500);
            }
        });
    }

    getErrorMessage() {
        return this.reportForm.controls['report'].hasError('required') ? 'Debe escribir un valor' :
            this.reportForm.controls['report'].hasError('email') ? 'Correo no valido' :
                '';
    }

    onNoClick(): void {
        this.dialogRef.close();
    }

    openSnackBar(message: string, duration: number, action?: string) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
        });
    }
}
