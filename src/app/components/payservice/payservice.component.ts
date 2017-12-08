import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {ApiService} from '../../_services/api.service';
import {ActivatedRoute, Router} from '@angular/router';

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


    constructor(private apiServices: ApiService, private route: ActivatedRoute, private router: Router) {
        this.model = {};
        this.model.membership = 1;
        this.model.type = 1;
        this.loading = false;
        this.error = '';
        this.type = false;
        this.previewvalue = '../../../assets/service_img.png';

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

        this.createForm();
    }

    createForm() {
        this.payForm = new FormGroup({
            membership: new FormControl(''),
            type: new FormControl(''),
            country: new FormControl('', [Validators.required]),
            phone: new FormControl('', [Validators.required])
        });
    }

    getErrorMessage() {
        return this.payForm.controls['country'].hasError('required') ? 'You must enter a value' :
            this.payForm.controls['phone'].hasError('required') ? 'You must enter a value' :
                '';
    }

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
        this.apiServices.payService(this.id, {
            membership: this.model.membership,
            type: this.model.type,
            evidence: this.model.evidence
        }).subscribe(result => {
            if (!result.error)
                this.router.navigate(['/myservices']);
            this.error = result.error;
        });
    }

    payPhone() {

    }

}
