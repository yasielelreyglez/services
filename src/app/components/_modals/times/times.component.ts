import {Component, OnInit, Inject} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialogRef, MatSnackBar} from '@angular/material';


@Component({
    selector: 'app-times',
    templateUrl: './times.component.html',
    styleUrls: ['./times.component.css']
})
export class TimesComponent implements OnInit {
    week_days: any;
    week_daysValue: any;
    start_time: any;
    end_time: any;
    previewsTimes: any;

    constructor(public dialogRef: MatDialogRef<TimesComponent>,
                @Inject(MAT_DIALOG_DATA) public data: any, private snackBar: MatSnackBar) {
        this.week_daysValue = [false, false, false, false, false, false, false];
        this.previewsTimes = new Array();
        this.week_days = [
            {title: 'Lunes'},
            {title: 'Martes'},
            {title: 'Miercoles'},
            {title: 'Jueves'},
            {title: 'Viernes'},
            {title: 'Sabado'},
            {title: 'Domingo'},
        ];
        this.start_time = '';
        this.end_time = '';
    }

    ngOnInit() {
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

    addTime() {
        this.previewsTimes.push(
            {
                weekdays: this.week_daysValue,
                start_time: this.start_time,
                end_time: this.end_time
            });
        this.week_daysValue = [false, false, false, false, false, false, false];
        this.start_time = '';
        this.end_time = '';
        console.log(this.previewsTimes);
    }

    done() {
        this.dialogRef.close(this.previewsTimes);
    }


}
