import {Component, OnInit} from '@angular/core';
import {FormGroup} from '@angular/forms';
import {ApiService} from '../../_services/api.service';
import {ActivatedRoute, Router} from '@angular/router';
import {MatSnackBar} from '@angular/material';

@Component({
    selector: 'app-payservice',
    templateUrl: './payservice.component.html',
    styleUrls: ['./payservice.component.css']
})
export class PayserviceComponent implements OnInit {
    payForm: FormGroup;
    model: any;
    loading: boolean;
    error: string;
    type: any;
    previewvalue: string;
    id: number;
    memberships: any;


    constructor(private apiServices: ApiService, private route: ActivatedRoute, private router: Router, private snackBar: MatSnackBar) {
        this.model = {};
        this.model.membership = 1;
        this.model.type = 1;
        this.loading = false;
        this.error = '';
        this.type = false;
        this.previewvalue = '../../../assets/service_img.png';
        this.model.namepay = '';
        this.model.numberpay = '';
        this.model.caducidadpay = '';
        this.model.cvvpay = '';

    }

    ngOnInit() {
        this.route.params.subscribe(params => {
            this.id = params['id'];
        });

        this.apiServices.memberships().subscribe(result => {
            if (!result.error)
                this.memberships = result;
            this.error = result.error;
        });

        // this.createForm();
    }

    // createForm() {
    //     this.payForm = new FormGroup({
    //         membership: new FormControl(''),
    //         type: new FormControl(''),
    //         country: new FormControl('', [Validators.required]),
    //         phone: new FormControl('', [Validators.required])
    //     });
    // }

    // getErrorMessage() {
    //     return this.payForm.controls['country'].hasError('required') ? 'Debe escribir un valor' :
    //         this.payForm.controls['phone'].hasError('required') ? 'Debe escribir un valor' :
    //             '';
    // }

    onFileChange(event) {
        const reader = new FileReader();
        if (event.target.files && event.target.files.length > 0) {
            const file = event.target.files[0];
            reader.readAsDataURL(file);
            reader.onload = () => {
                this.model.evidence = ({
                    filename: file.name,
                    filetype: file.type,
                    value: reader.result.split(',')[1]
                });
                this.previewvalue = reader.result;
            };
        }
    }

    payEvidence() {
        console.log(this.model.membership);
        console.log(this.model.type);
        console.log(this.model.evidence);
        this.loading = true;
        this.apiServices.payService(this.id, {
            membership: this.model.membership,
            type: this.model.type,
            evidence: this.model.evidence
        }).subscribe(result => {
            this.loading = false;
            if (!result.error)
                this.router.navigate(['/myservices']);
            this.openSnackBar(result.error, 2500);
        });
    }

    payLine() {
        this.loading = true;

        console.log(this.model.namepay);
        console.log(this.model.numberpay);
        console.log(this.model.caducidadpay);
        console.log(this.model.cvvpay);
    }

    openSnackBar(message: string, duration: number, action?: string) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
        });
    }

}
