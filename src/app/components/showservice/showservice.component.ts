import {Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {RatingComponent} from '../_modals/rating/rating.component';
import {isNull} from 'util';
import {MatDialog} from '@angular/material';
import {AuthService} from '../../_services/auth.service';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {DatePipe} from '@angular/common';

declare var google;
@Component({
    selector: 'app-showservice',
    templateUrl: './showservice.component.html',
    styleUrls: ['./showservice.component.css']
})

export class ShowserviceComponent implements OnInit {
    map: any;
    start = 'chicago, il';
    end = 'chicago, il';
    // directionsService = new google.maps.DirectionsService;

    // directionsDisplay = new google.maps.DirectionsRenderer;
    service: any = {};
    images: any[] = [];
    days: string[] = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    week_days: any = '';
    comment: number;
    loggedIn = false;
    commentForm: FormGroup;
    model: any;
    loading: boolean;
    error: string;
    submitAttempt: boolean;
    currentUser: any;

    @ViewChild('map') mapElement: ElementRef;
    latLng: any;
    // if(typeof(google)!='undefined') {
    // directionsService = new google.maps.DirectionsService;
    // directionsDisplay = new google.maps.DirectionsRenderer;
    // distanceM = new google.maps.DistanceMatrixService();
    // locations: any;
    // positions: any;
    // infowindow = new google.maps.InfoWindow;
    // }
    constructor(private route: ActivatedRoute, private apiServices: ApiService,
                public dialog: MatDialog, private authServices: AuthService) {
        this.model = {};
        this.loading = false;
        this.submitAttempt = false;
        // this.loadMap();
    }
    // loadMap() {
    //     let mapOptions = {
    //         center: new google.maps.LatLng(23.126606, -82.32528),
    //         // center: this.latLng,
    //         zoom: 15,
    //         mapTypeId: google.maps.MapTypeId.ROADMAP
    //     };
    //     this.map = new google.maps.Map(document.getElementById('map'), mapOptions);
    //     // this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);
    //     this.directionsDisplay.setMap(this.map);
    //     this.directionsDisplay.setOptions({suppressMarkers: true});
    //     this.positions = this.service.positionsList;
    //
    //     for (let i = 0; i < this.positions.length; i++) {
    //         let marker = new google.maps.Marker({
    //             map: this.map,
    //             position: new google.maps.LatLng(this.positions[i].latitude, this.positions[i].longitude)
    //         });
    //         let content = '<h4>' + this.positions[i].title + '</h4>';
    //         this.addInfoWindow(marker, content);
    //     }
    // }
    // addInfoWindow(marker, content) {
    //
    //     google.maps.event.addListener(marker, 'click', () => {
    //         this.infowindow.setContent(content)
    //         this.infowindow.open(this.map, marker);
    //     });
    //
    // }





    ngOnInit() {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            this.currentUser = JSON.parse(currentUser).email;
        }

        // console.log(this.cuba.nativeElement.hasClass('bc-red'));

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
        if (this.service.week_days !== '') {
            const days = this.service.week_days.split(',');
            let result = '';
            for (let day of days) {
                result += this.days[day] + ', ';
            }
            this.week_days = result.substring(0, (result.length - 2));
        }
        else {
            this.week_days = '';
        }
    }

    // hasClass(element, cls) {
    //     return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
    // }

    hideComment(id: number, hided: boolean) {
        // let button = document.getElementById('hided-' + id);
        if (hided) {
            this.apiServices.showComment(id).subscribe(result => {
                if (result) {
                    if (result.data) {
                        this.service = result.data;
                        return true;
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
        else {
            this.apiServices.hideComment(id).subscribe(result => {
                if (result) {
                    if (result.data) {
                        this.service = result.data;
                        return true;
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
    }

    reportComment(id: number) {
        this.apiServices.reportComment(id).subscribe(result => {
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
            // data: {id: id}
            data: {service: this.service}
        });

        dialogRef.afterClosed().subscribe(result => {
            if (result)
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
