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
    week_daysPrevew: any;
    start_time: any;
    start_time_am: any;
    end_time: any;
    end_time_am: any;
    times: string[];
    previewsTimes: any;
    previewsTime: any;
    days: string[];

    constructor(public dialogRef: MatDialogRef<TimesComponent>,
                @Inject(MAT_DIALOG_DATA) public data: any, private snackBar: MatSnackBar) {
        this.week_daysValue = [false, false, false, false, false, false, false];
        this.week_days = [
            {title: 'Lunes'},
            {title: 'Martes'},
            {title: 'Miercoles'},
            {title: 'Jueves'},
            {title: 'Viernes'},
            {title: 'Sabado'},
            {title: 'Domingo'},
        ];
        this.days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        this.times = ['01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00'];
        this.start_time = '08:00';
        this.start_time_am = 'AM';
        this.end_time = '05:00';
        this.end_time_am = 'PM';
        this.week_daysPrevew = [false, false, false, false, false, false, false];
    }

    ngOnInit() {
        this.previewsTime = new Array();
        this.previewsTimes = new Array();


        if (this.data.timesList) {
            for (const time of this.data.timesList) {
                const days = time.week_days.split(',').map(Number);

                for (const day of days) {
                    this.week_daysPrevew[day] = true;
                }
                this.previewsTime.push(
                    {
                        weekdays: this.week_daysPrevew,
                        start_time: time.start_time,
                        end_time: time.end_time
                    });
                this.week_daysPrevew = [false, false, false, false, false, false, false];
            }
            this.previewsTimes = this.previewsTime;
        }
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
        console.log('eliminar', this.previewsTimes);
    }

    addTime() {
        this.previewsTimes.push(
            {
                weekdays: this.week_daysValue,
                start_time: this.start_time + ' ' + this.start_time_am,
                end_time: this.end_time + ' ' + this.end_time_am
            });
        this.week_daysValue = [false, false, false, false, false, false, false];
        this.start_time = '08:00';
        this.start_time_am = 'AM';
        this.end_time = '05:00';
        this.end_time_am = 'PM';
    }

    done() {
        console.log('al final', this.previewsTimes);
        this.dialogRef.close(this.previewsTimes);
    }

    result_week_days(weekdays: any) {
        let result = '';
        weekdays.weekdays.forEach((value, index) => {
                if (value) {
                    result += this.days[index] + ', ';
                }
            }
        );
        return result.substring(0, (result.length - 2));

        // if (weekdays !== '') {
        //     const days = weekdays.split(',');
        //     let result = '';
        //     for (const day of days) {
        //         result += this.days[day] + ', ';
        //     }
        // }
        // else {
        //     return '';
        // }
    }

}
