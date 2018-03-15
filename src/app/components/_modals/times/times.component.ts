import {Component, OnInit, Inject, AfterContentChecked} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialogRef, MatSnackBar} from '@angular/material';

declare const $: any;

@Component({
    selector: 'app-times',
    templateUrl: './times.component.html',
    styleUrls: ['./times.component.css']
})
export class TimesComponent implements OnInit, AfterContentChecked {
    week_days: any;
    week_daysValue: any;
    start_time: any;
    end_time: any;
    previewsTimes: any;
    days: string[] = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

    constructor(public dialogRef: MatDialogRef<TimesComponent>,
                @Inject(MAT_DIALOG_DATA) public data: any, private snackBar: MatSnackBar) {
        this.week_daysValue = [false, false, false, false, false, false, false];
        this.previewsTimes = this.data.timesList;
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

    ngAfterContentChecked(): void {
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

    deleteTime(pos: number) {
        this.previewsTimes.splice(pos, 1);
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

    result_week_days(weekdays: string) {
        if (weekdays !== '') {
            const days = weekdays.split(',');
            let result = '';
            for (const day of days) {
                result += this.days[day] + ', ';
            }
            return result.substring(0, (result.length - 2));
        }
        else {
            return '';
        }
    }


}
