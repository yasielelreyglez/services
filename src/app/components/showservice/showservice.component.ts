import {Component, OnInit, ViewChild, ElementRef} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {RatingComponent} from '../_modals/rating/rating.component';
import {isNull} from 'util';
import {MatDialog} from '@angular/material';
import {AuthService} from '../../_services/auth.service';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {DatePipe} from '@angular/common';

declare var google: any;

@Component({
    selector: 'app-showservice',
    templateUrl: './showservice.component.html',
    styleUrls: ['./showservice.component.css']
})

export class ShowserviceComponent implements OnInit {
    @ViewChild('map2') mapElement: ElementRef;
    map: any;
    start = 'chicago, il';
    end = 'chicago, il';
    // directionsService = new google.maps.DirectionsService;

    // directionsDisplay = new google.maps.DirectionsRenderer;
    service: any = {};
    images: any[] = [];
    days: string[] = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    week_days: any = '';
    comment: number;
    loggedIn = false;
    commentForm: FormGroup;
    model: any;
    loading: boolean;
    error: string;
    submitAttempt: boolean;
    currentUser: any;

    constructor(private route: ActivatedRoute, private apiServices: ApiService,
                public dialog: MatDialog, private authServices: AuthService) {
        this.model = {};
        this.loading = false;
        this.submitAttempt = false;
    }

    ngOnInit() {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            this.currentUser = JSON.parse(currentUser).email;
            console.log(this.currentUser);
        }

        this.authServices.currentUser.subscribe(user => {
            this.loggedIn = !!user;
        });

        this.route.params.subscribe(params => {
            const id = params['id'];
            this.apiServices.service(id).subscribe(result => {
                this.service = result.data;
                this.images = result.data.imagesList;
                this.comment = result.data.servicecommentsList.length;
                this.result_week_days();
            });
        });

        this.createForm();

        this.commentForm.controls['textcomment'].valueChanges.subscribe(result => {
            if (result && (result.length > 9))
                this.submitAttempt = true;
            else
                this.submitAttempt = false;
        });

        // var mapProp = {
        //     center: new google.maps.LatLng(51.508742, -0.120850),
        //     zoom: 5,
        //     mapTypeId: google.maps.MapTypeId.ROADMAP
        // };
        // var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        // this.initMap()
        // console.log(this.commentForm.controls['textcomment'].dirty );
    }

    initMap() {
        console.log('CUALQUIER TEXTO');
        console.log(this.mapElement)

        const cuba = new google.maps.LatLng(23.11941, -82.32134);
        this.map = new google.maps.Map(document.getElementById('map2'), {
            zoom: 7,
            center: cuba
        });

        // this.directionsDisplay.setMap(this.map);
    }

    result_week_days() {
        if (!isNull(this.service.week_days)) {
            const days = this.service.week_days.split(',');
            let result = '';
            for (let day in days) {
                result += this.days[day] + ', ';
            }
            console.log(this.week_days.length - 1);
            this.week_days = result.substring(0, (result.length - 2));
        }
    }

    hideComment(id: number) {
        this.apiServices.hidecomment(id).subscribe(result => {
            if (result) {
                if (result.data) {
                    this.service = result.data;
                }
                else {
                    this.error = result.error;
                }
            }
            else {
                this.error = 'Error en el servidor';
            }
        });
    }

    reportComment(id: number) {
        this.apiServices.reportcomment(id).subscribe(result => {
            if (result.data) {
                this.service = result.data;
            }
            else {
                this.error = result.error;
            }
        });
    }

    createForm() {
        this.commentForm = new FormGroup({
            textcomment: new FormControl('', Validators.minLength(10))
        });
    }

    getErrorMessage() {
        return this.commentForm.controls['textcomment'].hasError('minlength') ? 'Min 10 characters' :
            '';
    }

    ratingDialog(id: number): void {
        const dialogRef = this.dialog.open(RatingComponent, {
            width: '70%',
            data: {id: id}
        });

        dialogRef.afterClosed().subscribe(result => {
            this.service = result;
        });
    }

    sendComment() {
        this.loading = true;
        this.apiServices.addComment(this.service.id, this.model.textcomment).subscribe(result => {
            if (result) {
                this.service = result;
                this.comment = this.service.servicecommentsList.length;
                this.loading = false;
                this.submitAttempt = false;
                this.commentForm.reset();
            }
            else {
                this.error = 'Error en el servidor';
                this.loading = false;
            }

        });
    }
}
