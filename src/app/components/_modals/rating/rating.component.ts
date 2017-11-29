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
    stars: boolean[];
    value: number;

    constructor(public dialogRef: MatDialogRef<RatingComponent>,
                @Inject(MAT_DIALOG_DATA) public data: any, private apiServices: ApiService) {
        this.model = {};
        this.loading = false;
        this.error = '';
        this.stars = [false, false, false, false, false, false, false, false, false, false];
        this.value = 0;
    }

    ngOnInit() {
    }

    rate() {
        this.apiServices.rateService(this.data.id, this.value).subscribe(result => {
            if (result) {
                this.dialogRef.close(result);
            }
        });
    }

    paint(value: number) {
        this.stars = [false, false, false, false, false, false, false, false, false, false];
        for (let i = 0; i <= value; i++) {
            this.stars[i] = true;
        }
    }

    click(val: number) {
        this.value = val + 1;
        this.paint(val);
    }

    clear() {
        this.stars = [false, false, false, false, false, false, false, false, false, false];
        if (this.value !== 0) {
            for (let i = 0; i <= (this.value - 1); i++) {
                this.stars[i] = true;
            }
        }
    }

    onNoClick(): void {
        this.dialogRef.close();
    }

}
