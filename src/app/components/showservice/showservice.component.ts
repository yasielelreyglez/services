import {Component, OnInit, ViewChild, ElementRef} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {RatingComponent} from '../_modals/rating/rating.component';
import {isNull} from 'util';
import {MatDialog} from '@angular/material';
import {AuthService} from '../../_services/auth.service';
import {FormControl, FormGroup, Validators} from '@angular/forms';

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

    constructor(private route: ActivatedRoute, private apiServices: ApiService,
                public dialog: MatDialog, private authServices: AuthService) {
        this.model = {};
        this.loading = false;
    }

    ngOnInit() {

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

        // var mapProp = {
        //     center: new google.maps.LatLng(51.508742, -0.120850),
        //     zoom: 5,
        //     mapTypeId: google.maps.MapTypeId.ROADMAP
        // };
        // var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        // this.initMap()
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

    createForm() {
        this.commentForm = new FormGroup({
            textcomment: new FormControl('', [Validators.required])
        });
    }

    getErrorMessage() {
        return this.commentForm.controls['textcomment'].hasError('required') ? 'You must enter a value' :
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
                this.loading = false;
                this.commentForm = new FormGroup({
                    textcomment: new FormControl('', [Validators.required])
                });
            }
            else {
                this.error = 'Error en el servidor';
                this.loading = false;
            }
        });
    }

}
