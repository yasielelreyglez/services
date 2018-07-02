import {
    AfterContentChecked, AfterContentInit, AfterViewInit, Component, ElementRef, EventEmitter, NgZone, OnInit,
    ViewChild
} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Service} from '../../_models/service';
import {City} from '../../_models/city';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {ActivatedRoute, Router} from '@angular/router';
import {isNull} from 'util';
import {MatDialog, MatSnackBar} from '@angular/material';
import {TimesComponent} from '../_modals/times/times.component';
import {DeletedialogComponent} from '../_modals/deletedialog/deletedialog.component';
declare const google;
declare const $: any;

@Component({
    selector: 'app-wizardservice',
    templateUrl: './wizardservice.component.html',
    styleUrls: ['./wizardservice.component.css']
})

export class WizardserviceComponent implements OnInit, AfterViewInit {
    previews: any;
    previewvalue: string;
    service: Service;
    whatsapp: boolean;
    moreImage: boolean;
    positiontitle: string;
    cities: City[];
    categories: any;
    categ: any;
    latitude: number;
    longitude: number;
    positions: any;
    // week_days: any;
    firstForm: FormGroup;
    positionsForm: FormGroup;
    flagPosition = false;
    edit: boolean;
    dropsImages: any;
    citiesList: any;
    loading: boolean;


    @ViewChild('map') mapElement: ElementRef;
    map: any;
    latLng: any;
    infoWindow: any;
    markers: any;

    constructor(private apiServices: ApiService, private router: Router, private route: ActivatedRoute,
                private snackBar: MatSnackBar, public zone: NgZone, public dialog: MatDialog) {
        $('#categories').select2();
        $('#cities').select2();
        this.edit = false;
        this.loading = false;
        if (typeof google !== 'undefined') {
            this.latLng = new google.maps.LatLng(-0.1911519, -78.4820116);
            this.infoWindow = new google.maps.InfoWindow;
        }
        this.flagPosition = false;

        this.service = new Service();
        this.service.title = '';
        this.service.subtitle = '';
        this.service.address = '';
        this.service.phone = '';
        this.service.description = '';
        this.service.categories = new Array();
        this.service.cities = new Array();
        this.service.whatsapp = false;
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
            }];

        this.moreImage = true;
        this.service.gallery = new Array();
        this.service.positions = new Array();
        this.positions = new Array();

        // this.week_days = [
        //     {title: 'Lunes'},
        //     {title: 'Martes'},
        //     {title: 'Miercoles'},
        //     {title: 'Jueves'},
        //     {title: 'Viernes'},
        //     {title: 'Sabado'},
        //     {title: 'Domingo'},
        // ];

        this.dropsImages = new Array();
        this.markers = new Array();
        this.previewvalue = 'assets/service_img.png';

    }


    ngOnInit() {
        window.scrollTo(0, 0);

        this.apiServices.cities().subscribe(result => {
            this.cities = result;
            $('#cities').select2();
        });

        this.apiServices.allSubCategories().subscribe(result => {
            this.categories = result;
            $('#categories').select2();
            $('#categoriesedit').select2();
        });

        this.apiServices.categories().subscribe(result => {
            this.categ = result;
            $('#categedit').select2();

            $('#categ').select2();
            $('#categ')
                .on('change', (e) => {
                    const id = $('#categ').select2('val');

                    this.apiServices.subCategories(id).subscribe(result => {
                        this.categories = result;
                       // $('#categories').select2();
                    });
                });
        });

        this.createForms();

        this.route.params.subscribe(params => {
            if (params['id']) {
                this.apiServices.service(params['id']).subscribe(result => {
                    this.edit = true;
                    this.service = result.data;
                    this.whatsapp = this.service.whatsapp;
                    if (this.service.icon)
                        this.previewvalue = this.service.icon;

                    const citiesId = [];
                    for (let i = 0; i < result.data.citiesList.length; i++) {
                        citiesId.push(result.data.citiesList[i].id);
                    }
                    this.service.cities = citiesId;
                    const subList = result.data.subcategoriesList;

                    this.apiServices.subCategories(result.data.subcategoriesList[0].category.id).subscribe(result => {
                        this.categories = result;
                        $('#categoriesedit').select2();
                        const subcategoriesId = [];
                        for (let i = 0; i < subList.length; i++) {
                            subcategoriesId.push(subList[i].id);
                        }
                        this.service.categories = subcategoriesId;
                        $('#categoriesedit').select2('val', subcategoriesId.map(String));
                        $('#categedit').select2();
                        $('#categedit').select2('val', subList[0].category.id);
                        $('#categedit')
                            .on('change', (e) => {
                                const id = $('#categedit').select2('val');

                                this.apiServices.subCategories(id).subscribe(result => {
                                    this.categories = result;
                                    // $('#categoriesedit').select2();
                                });
                            });
                    });

                    for (let i = 0; i < result.data.imagesList.length; i++) {
                        this.previews[i].src = result.data.imagesList[i].title;
                        this.previews[i].position = true;
                        this.previews[i].id = result.data.imagesList[i].id;
                    }

                    // $('#categ').select2('val', result.data.subcategoriesList[0].category.id);
                    $('#cities').select2('val', this.service.cities.map(String));


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

    ngAfterViewInit() {
        if (typeof google !== 'undefined') {
            this.initMap();
        }


    }

    onChangeTab(event) {
        window.scrollTo(0, 0);
        if (event.selectedIndex === 3) {
            let categories: any;
            if (this.edit === true) {
                categories = $('#categoriesedit').select2('val');
            }
            else {
                categories = $('#categories').select2('val');
            }
            const cities = $('#cities').select2('val');
            if (!isNull(categories))
                this.service.categories = categories.map(Number);
            if (!isNull(cities))
                this.service.cities = cities.map(Number);
        }
    }


    addPositions() {
        // this.directionsDisplay.setMap(this.map);
        // this.directionsDisplay.setOptions({suppressMarkers: true});
        if (typeof google !== 'undefined') {
            for (let i = 0; i < this.positions.length; i++) {
                setTimeout(() => {
                    const marker = new google.maps.Marker({
                        map: this.map,
                        position: new google.maps.LatLng(this.positions[i].latitude, this.positions[i].longitude),
                        animation: google.maps.Animation.DROP,
                    });
                    this.markers.push(marker);
                    const content = '<h6 class="tc-blue">' + this.positions[i].title + '</h6>';
                    this.addInfoWindow(marker, content);
                }, i * 200);
            }
        }
    }

    timesDialog(id: number): void {
        const dialogRef = this.dialog.open(TimesComponent, {
            width: '60%',
            height: '450px',
            data: this.service
        });

        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                this.service.times = result;
                // this.openSnackBar('El servicio ha sido evaluado satisfactoriamente', 2500);
            }
        });
    }

    initMap() {
        const mapOptions = {
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
                const marker = new google.maps.Marker({
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
            cities: new FormControl(''),
            categories: new FormControl(''),
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
        let count = 4;
        for (let i = 0; i < 4; i++) {
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
                for (let i = 0; i < 4; i++) {
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
        let dialogRef = this.dialog.open(DeletedialogComponent, {
            width: '300px',
            height: '180px',
            data: { name:'esta imagen' }
        });

        dialogRef.afterClosed().subscribe(result => {
            console.log('The dialog was closed',result);
            if(result){
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
        });


    }
changWhatsapp() {
        this.service.whatsapp = !this.whatsapp
    }

    finishFunction() {
        this.loading = true;
        console.log(this.service)
        if (this.previews.length > 0) {

            this.service.gallery = new Array();
            for (let i = 0; i < 4; i++) {
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
        this.apiServices.createFullService(this.service).subscribe(result => {
            this.loading = false;
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

    openSnackBar(message: string, duration: number, action ?: string) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
        });
    }

}

