import {Component, Inject, OnInit} from '@angular/core';
import {ApiService} from '../../../_services/api.service';
import {MAT_DIALOG_DATA, MatDialogRef} from '@angular/material';
import {FormControl, FormGroup, Validators} from '@angular/forms';

@Component({
    selector: 'app-report',
    templateUrl: './report.component.html',
    styleUrls: ['./report.component.css']
})
export class ReportComponent implements OnInit {
    model: any;
    loading: boolean;
    error: string;
    reportForm: FormGroup;

    constructor(public dialogRef: MatDialogRef<ReportComponent>,
                @Inject(MAT_DIALOG_DATA) public data: any,
                private apiServices: ApiService) {
        this.model = {id: data.id};
        this.loading = false;
        this.error = '';

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
                this.error = result.error;
                this.loading = false;
            }
        });
    }

    getErrorMessage() {
        return this.reportForm.controls['report'].hasError('required') ? 'You must enter a value' :
            this.reportForm.controls['report'].hasError('email') ? 'Not a valid email' :
                '';
    }

    onNoClick(): void {
        this.dialogRef.close();
    }
}
