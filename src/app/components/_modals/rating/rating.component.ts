import {Component, Inject, OnInit} from '@angular/core';
import {ApiService} from '../../../_services/api.service';
import {MAT_DIALOG_DATA, MatDialogRef} from '@angular/material';

@Component({
    selector: 'app-rating',
    templateUrl: './rating.component.html',
    styleUrls: ['./rating.component.css']
})
export class RatingComponent implements OnInit {
    model: any;
    loading: boolean;
    error: string;

    constructor(public dialogRef: MatDialogRef<RatingComponent>,
                @Inject(MAT_DIALOG_DATA) public data: any, private apiServices: ApiService) {
        this.model = {};
        this.loading = false;
        this.error = '';
    }

    ngOnInit() {
    }

}
