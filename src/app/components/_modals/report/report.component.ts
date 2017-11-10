import {Component, OnInit} from '@angular/core';
import {NgbActiveModal} from '@ng-bootstrap/ng-bootstrap';
import {ApiService} from '../../../_services/api.service';

@Component({
    selector: 'app-report',
    templateUrl: './report.component.html',
    styleUrls: ['./report.component.css']
})
export class ReportComponent implements OnInit {
    model: any;
    loading: boolean;
    error: string;

    constructor(public activeModal: NgbActiveModal, private apiServices: ApiService) {
        this.model = {};
        this.loading = false;
        this.error = '';
    }

    ngOnInit() {
    }

    enviar() {
        this.loading = true;
        this.apiServices.report(this.model.report).subscribe(result => {
            if (result === true) {
                this.activeModal.close();
            }
            else {
                this.error = result.error;
                this.loading = false;
            }
        });
    }
}
