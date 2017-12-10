import {AfterViewInit, Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {RatingComponent} from '../_modals/rating/rating.component';
import {isNull} from 'util';
import {MatDialog, MatTabChangeEvent} from '@angular/material';
import {AuthService} from '../../_services/auth.service';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {DatePipe} from '@angular/common';

declare const google;

@Component({
    selector: 'app-showservice',
    templateUrl: './showservice.component.html',
    styleUrls: ['./showservice.component.css']
})

export class ShowserviceComponent implements OnInit, AfterViewInit {
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
    selectedIndex = 2;

    @ViewChild('map') mapElement: ElementRef;
    map: any;
    latLng: any;
    infoWindow: any;
    positions: any;

    constructor(private route: ActivatedRoute, private apiServices: ApiService,
                public dialog: MatDialog, private authServices: AuthService) {
        this.model = {};
        this.loading = false;
        this.submitAttempt = false;

        this.latLng = new google.maps.LatLng(23.13302, -82.38304);
        this.infoWindow = new google.maps.InfoWindow;
    }

    ngOnInit() {
        const currentUser = localStorage.getItem('currentUser');
        if (currentUser) {
            this.currentUser = JSON.parse(currentUser).email;
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
                this.addPositions();
            });
        });

        this.createForm();

        this.commentForm.controls['textcomment'].valueChanges.subscribe(result => {
            if (result && (result.length > 9)) {
                this.submitAttempt = true;
            } else {
                this.submitAttempt = false;
            }
        });
    }

    ngAfterViewInit() {
        this.initMap();
    }

    tabChanged = (tabChangeEvent: MatTabChangeEvent): void => {
        // if (tabChangeEvent.index === 1) {
        //     console.log('Mapa');
        //     google.maps.event.trigger(this.map, 'resize');
        // }
    }

    initMap() {
        let mapOptions = {
            center: this.latLng,
            zoom: 11,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);

    }

    addPositions() {
        // this.directionsDisplay.setMap(this.map);
        // this.directionsDisplay.setOptions({suppressMarkers: true});
        this.positions = this.service.positionsList;
        for (let i = 0; i < this.positions.length; i++) {
            let marker = new google.maps.Marker({
                map: this.map,
                position: new google.maps.LatLng(this.positions[i].latitude, this.positions[i].longitude)
            });


            let content = '<h6 class="tc-blue">' + this.positions[i].title + '</h6>';
            this.addInfoWindow(marker, content);
        }
    }

    addInfoWindow(marker, content) {
        google.maps.event.addListener(marker, 'click', () => {
            this.infoWindow.setContent(content)
            this.infoWindow.open(this.map, marker);
        });

    }


    result_week_days() {
        if (this.service.week_days !== '') {
            const days = this.service.week_days.split(',');
            let result = '';
            for (const day of days) {
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
