import {Component, OnInit} from '@angular/core';
import {NgbActiveModal} from '@ng-bootstrap/ng-bootstrap';
import {ApiService} from '../../../_services/api.service';

@Component({
    selector: 'app-rating',
    templateUrl: './rating.component.html',
    styleUrls: ['./rating.component.css']
})
export class RatingComponent implements OnInit {
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

}
