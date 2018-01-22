import {AfterViewInit, Component, ElementRef, NgZone, OnInit, ViewChild} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Service} from '../../_models/service';
import {City} from '../../_models/city';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {ActivatedRoute, Router} from '@angular/router';
import {isNull} from 'util';
import {MatSnackBar} from '@angular/material';

declare const google;

@Component({
    selector: 'app-wizardservice',
    templateUrl: './wizardservice.component.html',
    styleUrls: ['./wizardservice.component.css']
})

export class WizardserviceComponent implements OnInit, AfterViewInit {
    previews: any;
    previewvalue: string;
    service: Service;
    moreImage: boolean;
    positiontitle: string;
    cities: City[];
    categories: any;
    latitude: number
    longitude: number;
    positions: any;
    week_days: any;
    firstForm: FormGroup;
    positionsForm: FormGroup;
    flagPosition = false;
    edit: boolean;
    dropsImages: any;
    citiesList: any;

    @ViewChild('map') mapElement: ElementRef;
    map: any;
    latLng: any;
    infoWindow: any;
    markers: any;

    constructor(private apiServices: ApiService, private router: Router, private route: ActivatedRoute,
                private snackBar: MatSnackBar, public zone: NgZone) {

        if (typeof google !== 'undefined') {
            this.latLng = new google.maps.LatLng(23.13302, -82.38304);
            this.infoWindow = new google.maps.InfoWindow;
        }
        this.flagPosition = false;

        this.service = new Service();
        this.previews = [
            {
                position: false,
                src: 'assets/service_img.png',
                filename: null,
                filetype: null,
                value: null,
                id: null
            },
            {
                position: false,
                src: 'assets/service_img.png',
                filename: null,
                filetype: null,
                value: null,
                id: null
            },
            {
                position: false,
                src: 'assets/service_img.png',
                filename: null,
                filetype: null,
                value: null,
                id: null
            },
            {
                position: false,
                src: 'assets/service_img.png',
                filename: null,
                filetype: null,
                value: null,
                id: null
            },
            {
                position: false,
                src: 'assets/service_img.png',
                filename: null,
                filetype: null,
                value: null,
                id: null
            },
            {
                position: false,
                src: 'assets/service_img.png',
                filename: null,
                filetype: null,
                value: null,
                id: null
            },
            {
                position: false,
                src: 'assets/service_img.png',
                filename: null,
                filetype: null,
                value: null,
                id: null
            },
            {
                position: false,
                src: 'assets/service_img.png',
                filename: null,
                filetype: null,
                value: null,
                id: null
            },
            {
                position: false,
                src: 'assets/service_img.png',
                filename: null,
                filetype: null,
                value: null,
                id: null
            }];

        this.moreImage = true;
        this.service.gallery = new Array();
        this.service.positions = new Array();
        this.positions = new Array();

        this.week_days = [
            {title: 'Lunes'},
            {title: 'Martes'},
            {title: 'Miercoles'},
            {title: 'Jueves'},
            {title: 'Viernes'},
            {title: 'Sabado'},
            {title: 'Domingo'},
        ];

        this.dropsImages = new Array();
        this.markers = new Array();
        this.previewvalue = 'assets/service_img.png';
        this.service.week_days = [false, false, false, false, false, false, false];

        this.route.params.subscribe(params => {
            if (params['id']) {
                this.apiServices.service(params['id']).subscribe(result => {
                    this.edit = true;
                    this.service = result.data;

                    if (this.service.icon)
                        this.previewvalue = this.service.icon;

                    let citiesId = [];
                    for (let i = 0; i < result.data.citiesList.length; i++) {
                        citiesId.push(result.data.citiesList[i].id);
                    }
                    this.service.cities = citiesId;

                    let subcategoriesId = [];
                    for (let i = 0; i < result.data.subcategoriesList.length; i++) {
                        subcategoriesId.push(result.data.subcategoriesList[i].id);
                    }
                    this.service.categories = subcategoriesId;

                    for (let i = 0; i < result.data.imagesList.length; i++) {
                        this.previews[i].src = result.data.imagesList[i].title;
                        this.previews[i].position = true;
                        this.previews[i].id = result.data.imagesList[i].id;
                    }

                    // let daysId = result.data.week_days.split(',');
                    // this.service.week_days = [false, false, false, false, false, false, false];
                    //
                    // for (let i = 0; i < daysId.length; i++) {
                    //     this.service.week_days[daysId[i]] = true;
                    // }

                    this.positions = result.data.positionsList;
                    if (this.positions.length > 0)
                        this.addPositions();

                });
            }
        });
    }

    ngOnInit() {
        this.apiServices.cities().subscribe(result => this.cities = result);
        this.apiServices.allSubCategories().subscribe(result => this.categories = result);
        this.createForms();
    }

    ngAfterViewInit() {
        if (typeof google !== 'undefined')
            this.initMap();
    }

    addPositions() {
        // this.directionsDisplay.setMap(this.map);
        // this.directionsDisplay.setOptions({suppressMarkers: true});

        for (let i = 0; i < this.positions.length; i++) {
            setTimeout(() => {
                const marker = new google.maps.Marker({
                    map: this.map,
                    position: new google.maps.LatLng(this.positions[i].latitude, this.positions[i].longitude),
                    animation: google.maps.Animation.DROP,
                });
                this.markers.push(marker);
                let content = '<h6 class="tc-blue">' + this.positions[i].title + '</h6>';
                this.addInfoWindow(marker, content);
            }, i * 200);
        }
    }

    initMap() {
        let mapOptions = {
            center: this.latLng,
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: true,
            fullscreenControl: false
        };
        this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);
        google.maps.event.addListener(this.map, 'click', this.addMarker(this));
    }

    addMarker(that) {
        if (typeof google !== 'undefined') {
            return function (event) {
                let marker = new google.maps.Marker({
                    position: event.latLng,
                    map: that.map,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                });
                that.latitude = marker.getPosition().lat();
                that.longitude = marker.getPosition().lng();

                that.map.panTo(event.latLng);

                that.markers.push(marker);
                that.flagPosition = true;
                that.zone.run(() => {
                });


                google.maps.event.addListener(marker, 'dragend', function () {
                    that.latitude = marker.getPosition().lat();
                    that.longitude = marker.getPosition().lng();
                    that.map.panTo(marker.getPosition());
                });

                google.maps.event.clearListeners(that.map, 'click');
            };
        }
    }

    addPosition() {
        if (typeof google !== 'undefined') {
            this.positions.push({
                title: this.positiontitle,
                longitude: this.longitude,
                latitude: this.latitude
            });

            const content = '<h6 class="tc-blue">' + this.positiontitle + '</h6>';
            this.addInfoWindow(this.markers[this.markers.length - 1], content);

            this.markers[this.markers.length - 1].draggable = false;
            google.maps.event.addListener(this.map, 'click', this.addMarker(this));

            this.flagPosition = false;

            this.positiontitle = '';
            this.longitude = null;
            this.latitude = null;
        }
    }

    addInfoWindow(marker, content) {
        if (typeof google !== 'undefined') {
            google.maps.event.addListener(marker, 'click', () => {
                this.infoWindow.setContent(content)
                this.infoWindow.open(this.map, marker);
            });
        }
    }

    createForms() {
        this.firstForm = new FormGroup({
            title: new FormControl('', [Validators.required]),
            subtitle: new FormControl('', [Validators.required]),
            address: new FormControl('', [Validators.required]),
            phone: new FormControl('', [Validators.required]),
            description: new FormControl('', [Validators.required]),
            cities: new FormControl('', [Validators.required]),
            categories: new FormControl('', [Validators.required]),
        });

        this.positionsForm = new FormGroup({
            positiontitle: new FormControl('', [Validators.minLength(1)])
        });
    }

    getErrorMessage() {
        return this.firstForm.controls['title'].hasError('required') ? 'Debe escribir un valor' :
            this.firstForm.controls['subtitle'].hasError('required') ? 'Debe escribir un valor' :
                this.firstForm.controls['address'].hasError('required') ? 'Debe escribir un valor' :
                    this.firstForm.controls['phone'].hasError('required') ? 'Debe escribir un valor' :
                        this.firstForm.controls['description'].hasError('required') ? 'Debe escribir un valor' :
                            this.firstForm.controls['cities'].hasError('required') ? 'Debe escribir un valor' :
                                this.firstForm.controls['categories'].hasError('required') ? 'Debe escribir un valor' :
                                    this.positionsForm.controls['positiontitle'].hasError('minlength') ? 'Debe escribir un valor' :
                                        '';
    }


    deletePosition(pos: number) {
        this.positions.splice(pos, 1);
        if (typeof google !== 'undefined')
            this.markers[pos].setMap(null);
        this.markers.splice(pos, 1);
    }

    moreImageGalery() {
        let count = 9;
        for (let i = 0; i < 9; i++) {
            const current = this.previews[i];
            if (current.position) {
                count--;
            }
        }
        if (count === 0) {
            this.moreImage = false;
        }
        else {
            this.moreImage = true;
        }
    }

    onFotoChange(event) {
        const reader = new FileReader();
        if (event.target.files && event.target.files.length > 0) {
            const file = event.target.files[0];
            reader.readAsDataURL(file);
            reader.onload = () => {
                for (let i = 0; i < 9; i++) {
                    const current = this.previews[i];
                    if (!current.position) {
                        current.position = true;
                        current.src = reader.result;
                        current.filename = file.name;
                        current.filetype = file.type;
                        current.value = reader.result.split(',')[1];
                        break;
                    }
                }
                this.moreImageGalery();
            };
        }
    }

    deleteImage(pos: number) {
        this.previews[pos].position = false;
        this.previews[pos].src = 'assets/service_img.png';
        this.previews[pos].filename = null;
        this.previews[pos].filetype = null;
        this.previews[pos].value = null;
        if (!isNull(this.previews[pos].id)) {
            this.dropsImages.push(this.previews[pos].id);
            this.previews[pos].id = null;
        }
        this.moreImageGalery();
    }


    finishFunction() {
        if (this.previews.length > 0) {

            this.service.gallery = new Array();
            for (let i = 0; i < 9; i++) {
                const current = this.previews[i];
                if (current.position && isNull(current.id)) {
                    this.service.gallery.push({
                        filename: current.filename,
                        filetype: current.filetype,
                        value: current.value
                    });
                }
            }
        }

        this.service.positions = new Array();
        if (this.positions.length > 0) {
            for (let i = 0; i < this.positions.length; i++) {
                const current = this.positions[i];

                this.service.positions.push({
                    title: current.title,
                    longitude: current.longitude,
                    latitude: current.latitude
                });
            }
        }

        this.service.dropsImages = this.dropsImages;
        this.service.times = new Array();

        this.apiServices.createFullService(this.service).subscribe(result => {
            if (result) {
                this.router.navigate(['myservices/service', result.id]);
                if (this.edit) {
                    this.openSnackBar('El servicio ha sido editado satisfactoriamente.', 2500);
                }
                else {
                    this.openSnackBar('El servicio ha sido creado satisfactoriamente.', 2500);
                }
            }
        });
    }


    onFileChange(event) {
        const reader = new FileReader();
        if (event.target.files && event.target.files.length > 0) {
            const file = event.target.files[0];
            reader.readAsDataURL(file);
            reader.onload = () => {
                this.service.icon = ({
                    filename: file.name,
                    filetype: file.type,
                    value: reader.result.split(',')[1]
                });
                this.previewvalue = reader.result;
            };
        }
    }

    openSnackBar(message: string, duration: number, action?: string) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
        });
    }

}
