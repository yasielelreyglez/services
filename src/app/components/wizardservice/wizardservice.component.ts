import {AfterViewInit, Component, ElementRef, EventEmitter, NgZone, OnInit, ViewChild} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Service} from '../../_models/service';
import {City} from '../../_models/city';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {ActivatedRoute, Router} from '@angular/router';
import {isNull} from 'util';
import {MatDialog, MatSnackBar} from '@angular/material';
import {TimesComponent} from '../_modals/times/times.component';

declare const google;
declare const $;

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
    // week_days: any;
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
                private snackBar: MatSnackBar, public zone: NgZone, public dialog: MatDialog) {

        if (typeof google !== 'undefined') {
            this.latLng = new google.maps.LatLng(23.13302, -82.38304);
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

        this.route.params.subscribe(params => {
            if (params['id']) {
                this.apiServices.service(params['id']).subscribe(result => {
                    this.edit = true;
                    this.service = result.data;

                    if (this.service.icon)
                        this.previewvalue = this.service.icon;

                    const citiesId = [];
                    for (let i = 0; i < result.data.citiesList.length; i++) {
                        citiesId.push(result.data.citiesList[i].id);
                    }
                    this.service.cities = citiesId;

                    const subcategoriesId = [];
                    for (let i = 0; i < result.data.subcategoriesList.length; i++) {
                        subcategoriesId.push(result.data.subcategoriesList[i].id);
                    }
                    this.service.categories = subcategoriesId;

                    for (let i = 0; i < result.data.imagesList.length; i++) {
                        this.previews[i].src = result.data.imagesList[i].title;
                        this.previews[i].position = true;
                        this.previews[i].id = result.data.imagesList[i].id;
                    }

                    $('#categories').select2('val', this.service.categories.map(String));
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

    ngOnInit() {
        this.apiServices.cities().subscribe(result => this.cities = result);
        this.apiServices.allSubCategories().subscribe(result => this.categories = result);
        this.createForms();
    }

    ngAfterViewInit() {
        if (typeof google !== 'undefined')
            this.initMap();

        this.scripts();
    }


    onChangeTab(event) {
        if (event.selectedIndex === 3) {
            const categories = $('#categories').select2('val');
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
            data: {service: this.service}
        });

        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                this.service.times = result;
                console.log(this.service);
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
        // this.service.times = new Array();

        // this.service.categories = $('#categories').select2('val').map(Number);
        // this.service.cities = $('#cities').select2('val').map(Number);
        console.log('al final', this.service);
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

    scripts() {
        'use strict';

        const $body = $('body');
        const body = $('body');
// const $head = $('head');
// const $mainWrapper = $('#main-wrapper');

        const contact = $(body).find('.contact-button');
        const contactWindow = $(contact).find('.contact-details');

        $('.sponsors-slider').owlCarousel({
            items: 6
        });

        $(contact).on('click', function (e) {
            $(this).find(contactWindow).toggle();
            e.preventDefault();
        });

        const share = $(body).find('.share-button');
        const shareWindow = $(share).find('.contact-share');

        $(share).on('click', function (e) {
            $(this).find(shareWindow).toggle();
            e.preventDefault();
        });

        const advancedButton = $(body).find('.map-toggleButton');
        const advancedContent = $(body).find('.advanced-search');
        const hide = $(body).find('.close');

        $(advancedButton).on('click', function () {
            $(this).toggleClass('active');
            $(advancedContent).toggle();
        });

        $(hide).on('click', function () {

            $(advancedButton).removeClass('active');
            $(advancedContent).hide();
        });


        $('.slider-range-container').each(function () {
            if ($.fn.slider) {

                const self = $(this),
                    slider = self.find('.slider-range'),
                    min = slider.data('min') ? slider.data('min') : 100,
                    max = slider.data('max') ? slider.data('max') : 2000,
                    step = slider.data('step') ? slider.data('step') : 100,
                    default_min = slider.data('default-min') ? slider.data('default-min') : 100,
                    default_max = slider.data('default-max') ? slider.data('default-max') : 500,
                    currency = slider.data('currency') ? slider.data('currency') : '$',
                    input_from = self.find('.range-from'),
                    input_to = self.find('.range-to');

                input_from.val(currency + ' ' + default_min);
                input_to.val(currency + ' ' + default_max);

                slider.slider({
                    range: true,
                    min: min,
                    max: max,
                    step: step,
                    values: [default_min, default_max],
                    slide: function (event, ui) {
                        input_from.val(currency + ' ' + ui.values[0]);
                        input_to.val(currency + ' ' + ui.values[1]);
                    }
                });
            }
        });

        $('.custom-select').select2();


        // $('#single-company-map').gmap3({
        //     map: {
        //         address: 'St james St New York, USA',
        //         options: {
        //             zoom: 14,
        //             mapTypeId: 'subtle',
        //             mapTypeControl: false,
        //             mapTypeControlOptions: {
        //                 mapTypeIds: ['subtle']
        //             },
        //             navigationControl: false,
        //             scrollwheel: false,
        //             draggable: false,
        //             streetViewControl: false,
        //             disableDefaultUI: true,
        //         },
        //     },
        //     styledmaptype: subtleOptions
        // });
        //
        // $('#map-listing-05').gmap3({
        //     map: {
        //         address: 'POURRIERES, FRANCE',
        //         options: {
        //             zoom: 17,
        //             mapTypeId: google.maps.MapTypeId.ROADMAP,
        //             mapTypeControl: false,
        //             mapTypeControlOptions: {
        //                 style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        //             },
        //             navigationControl: false,
        //             scrollwheel: false,
        //             streetViewControl: false
        //         }
        //     }
        // });
        //
        // $('a[href="#contact"]').on('shown.bs.tab', function () {
        //     $('#map-listing-04').gmap3({trigger: 'resize'});
        // });
        //
        // $('a[href="#contact"]'
        // ).on('shown.bs.tab', function () {
        //     $('#map-listing-05').gmap3({trigger: 'resize'});
        // });

// Mediaqueries
// ---------------------------------------------------------
// const XS = window.matchMedia('(max-width:767px)');
// const SM = window.matchMedia('(min-width:768px) and (max-width:991px)');
// const MD = window.matchMedia('(min-width:992px) and (max-width:1199px)');
// const LG = window.matchMedia('(min-width:1200px)');
// const XXS = window.matchMedia('(max-width:480px)');
// const SM_XS = window.matchMedia('(max-width:991px)');
// const LG_MD = window.matchMedia('(min-width:992px)');


// Google Maps Markers Array (for demo)
        const markers = [
            {
                lat: 37.780823,
                lng: -122.4231,
                title: 'Marker 1'
            }, {
                lat: 37.768068680454725,
                lng: -122.430739402771,
                title: 'Marker 2'
            }, {
                lat: 37.7791272169824,
                lng: -122.4296236038208,
                title: 'Marker 3'
            }, {
                lat: 37.770715,
                lng: -122.392631,
                title: 'Marker 4'
            }, {
                lat: 37.78197638783258,
                lng: -122.45829105377197,
                title: 'Marker 5'
            }, {
                lat: 37.769629187677,
                lng: -122.46798992156982,
                title: 'Marker 6'
            }
        ];


// Touch
// ---------------------------------------------------------
        const dragging = false;

        $body.on('touchmove', function () {
            this.dragging = true;
        });

        $body.on('touchstart', function () {
            this.dragging = false;
        });


// Set Background Image
// ---------------------------------------------------------
        $('.has-bg-image').each(function () {
            const $this = $(this),

                image = $this.data('bg-image'),
                color = $this.data('bg-color'),
                opacity = $this.data('bg-opacity'),

                $content = $('<div/>', {'class': 'content'}),
                $background = $('<div/>', {'class': 'background'});

            if (opacity) {
                $this.children().wrapAll($content);
                $this.append($background);

                $this.css({
                    'background-image': 'url(' + image + ')'
                });

                $background.css({
                    'background-color': '#' + color,
                    'opacity': opacity
                });
            } else {
                $this.css({
                    'background-image': 'url(' + image + ')',
                    'background-color': '#' + color
                });
            }
        });


// Superfish Menus
// ---------------------------------------------------------
        if ($.fn.superfish) {
            $('.sf-menu').superfish();
        } else {
            console.warn('not loaded -> superfish.min.js and hoverIntent.js');
        }


// Mobile Sidebar
// ---------------------------------------------------------
        $('.mobile-sidebar-toggle').on('click', function () {
            $body.toggleClass('mobile-sidebar-active');
            return false;
        });

        $('.mobile-sidebar-open').on('click', function () {
            $body.addClass('mobile-sidebar-active');
            return false;
        });

        $('.mobile-sidebar-close').on('click', function () {
            $body.removeClass('mobile-sidebar-active');
            return false;
        });


// UOU Tabs
// ---------------------------------------------------------
        if ($.fn.uouTabs) {
            $('.uou-tabs').uouTabs();
        } else {
            console.warn('not loaded -> uou-tabs.js');
        }


// UOU Accordions
// ---------------------------------------------------------
        if ($.fn.uouAccordions) {
            $('.uou-accordions').uouAccordions();
        } else {
            console.warn('not loaded -> uou-accordions.js');
        }


// UOU Alers
// ---------------------------------------------------------
        $('.alert').each(function () {
            const $this = $(this);

            if ($this.hasClass('alert-dismissible')) {
                $this.children('.close').on('click', function (event) {
                    event.preventDefault();

                    $this.remove();
                });
            }
        });


// Default Slider
// ---------------------------------------------------------
        if ($.fn.flexslider) {
            $('.default-slider').flexslider({
                slideshowSpeed: 10000,
                animationSpeed: 1000,
                prevText: '',
                nextText: ''
            });
        } else {
            console.warn('not loaded -> jquery.flexslider-min.js');
        }


// Range Slider (forms)
// ---------------------------------------------------------
        if ($.fn.rangeslider) {
            $('input[type="range"]'
            ).rangeslider({
                polyfill: false,
                onInit: function () {
                    this.$range.wrap('<div class="uou-rangeslider"></div>').parent().append('<div class="tooltip">' + this.$element.data('unit-before') + '<span></span>' + this.$element.data('unit-after') + '</div>');
                },
                onSlide: function (value, position) {
                    const $span = this.$range.parent().find('.tooltip span');
                    $span.html(position);
                }
            });
        } else {
            console.warn('not loaded -> rangeslider.min.js');
        }


// Placeholder functionality for selects (forms)
// ---------------------------------------------------------
        function selectPlaceholder(el) {
            const $el = $(el);

            if ($el.val() === 'placeholder') {
                $el.addClass('placeholder');
            } else {
                $el.removeClass('placeholder');
            }
        }

        $('select').each(function () {
            selectPlaceholder(this);
        }).change(function () {
            selectPlaceholder(this);
        });


// ---------------------------------------------------------
// BLOCKS
// BLOCKS
// BLOCKS
// BLOCKS
// BLOCKS
// ---------------------------------------------------------


// .uou-block-1a
// ---------------------------------------------------------
        $('.uou-block-1a').each(function () {
            const $block = $(this);

            // search
            $block.find('.search').each(function () {
                const $this = $(this);

                $this.find('.toggle').on('click', function (event) {
                    event.preventDefault();
                    $this.addClass('active');
                    setTimeout(function () {
                        $this.find('.search-input').focus();
                    }, 100);
                });

                $this.find('input[type="text"]'
                ).on('blur', function () {
                    $this.removeClass('active');
                });
            });

            // language
            $block.find('.language').each(function () {
                const $this = $(this);

                $this.find('.toggle').on('click', function (event) {
                    event.preventDefault();

                    if (!$this.hasClass('active')) {
                        $this.addClass('active');
                    } else {
                        $this.removeClass('active');
                    }
                });
            });
        });


// .uou-block-1b
// ---------------------------------------------------------
        $('.uou-block-1b').each(function () {
            const $block = $(this);

            // language
            $block.find('.language').each(function () {
                const $this = $(this);

                $this.find('.toggle').on('click', function (event) {
                    event.preventDefault();

                    if (!$this.hasClass('active')) {
                        $this.addClass('active');
                    } else {
                        $this.removeClass('active');
                    }
                });
            });
        });


// .uou-block-1e
// ---------------------------------------------------------
        $('.uou-block-1e').each(function () {
            const $block = $(this);

            // language
            $block.find('.language').each(function () {
                const $this = $(this);

                $this.find('.toggle').on('click', function (event) {
                    event.preventDefault();

                    if (!$this.hasClass('active')) {
                        $this.addClass('active');
                    } else {
                        $this.removeClass('active');
                    }
                });
            });
        });


// .uou-block-5b
// ---------------------------------------------------------
        $('.uou-block-5b').each(function () {
            const $block = $(this),
                $tabs = $block.find('.tabs > li');

            $tabs.on('click', function () {
                const $this = $(this),
                    target = $this.data('target');

                if (!$this.hasClass('active')) {
                    $block.find('.' + target).addClass('active').siblings('blockquote').removeClass('active');

                    $tabs.removeClass('active');
                    $this.addClass('active');

                    return false;
                }
            });
        });


// .uou-block-5c
// ---------------------------------------------------------
        $('.uou-block-5c').each(function () {
            const $block = $(this);

            if ($.fn.flexslider) {
                $block.find('.flexslider').flexslider({
                    slideshowSpeed: 10000,
                    animationSpeed: 1000,
                    prevText: '',
                    nextText: '',
                    controlNav: false,
                    smoothHeight: true
                });
            } else {
                console.warn('not loaded -> jquery.flexslider-min.js');
            }
        });


// .uou-block-7g
// ---------------------------------------------------------
        $('.uou-block-7g').each(function () {
            const $block = $(this),
                $badge = $block.find('.badge'),
                badgeColor = $block.data('badge-color');

            if (badgeColor) {
                $badge.css('background-color', '#' + badgeColor);
            }
        });


// .uou-block-7h
// ---------------------------------------------------------
        $('.uou-block-7h').each(function () {
            const $block = $(this);

            if ($.fn.flexslider) {
                $block.find('.flexslider').flexslider({
                    slideshowSpeed: 10000,
                    animationSpeed: 1000,
                    prevText: '',
                    nextText: '',
                    directionNav: false,
                    smoothHeight: true
                });
            } else {
                console.warn('not loaded -> jquery.flexslider-min.js');
            }
        });


// .uou-block-11a
// ---------------------------------------------------------
//         $('.uou-block-11a').each(function () {
//             const $block = $(this);
//
//             // nav
//             $block.find('.main-nav').each(function () {
//                 const $this = $(this).children('ul');
//
//                 $this.find('li').each(function () {
//                     const $this = $(this);
//
//                     if ($this.children('ul').length > 0) {
//                         $this.addClass('has-submenu');
//                         $this.append('<span class="arrow"></span>');
//                     }
//                 });
//
//                 const $submenus = $this.find('.has-submenu');
//
//                 $submenus.children('.arrow').on('click', function (event) {
//                     const $this = $(this),
//                         $li = $this.parent('li');
//
//                     if (!$li.hasClass('active')) {
//                         $li.addClass('active');
//                         $li.children('ul').slideDown();
//                     } else {
//                         $li.removeClass('active');
//                         $li.children('ul').slideUp();
//                     }
//                 });
//             });
//         });


// .uou-block-12a
// ---------------------------------------------------------
//         $('.uou-block-12a').each(function () {
//             const $block = $(this),
//                 $map = $block.find('.map-container .map');
//
//             // Map
//             const map,
//                 height = $map.data('height'),
//                 centerLat = $map.data('center-lat'),
//                 centerLng = $map.data('center-lng');
//
//             $map.css('height', height + 'px');
//
//             function initialize() {
//                 const mapOptions = {
//                     scrollwheel: false,
//                     zoom: 14,
//                     center: new google.maps.LatLng(centerLat, centerLng)
//                 };
//
//                 map = new google.maps.Map($map[0], mapOptions);
//
//                 for (const i = 0; i < markers.length; i++) {
//                     const marker = markers[i];
//
//                     new google.maps.Marker({
//                         position: new google.maps.LatLng(marker.lat, marker.lng),
//                         map: map,
//                         title: marker.title
//                     });
//                 }
//             }
//
//             google.maps.event.addDomListener(window, 'load', initialize);
//
//             google.maps.event.addDomListener(window, 'resize', function () {
//                 const center = map.getCenter();
//                 google.maps.event.trigger(map, 'resize');
//                 map.setCenter(center);
//             });
//         });


// .uou-block-12b
// ---------------------------------------------------------
//         $('.uou-block-12b').each(function () {
//             const $block = $(this),
//                 $map = $block.find('.map-container .map');
//
//             // Map
//             const map,
//                 height = $map.data('height'),
//                 centerLat = $map.data('center-lat'),
//                 centerLng = $map.data('center-lng');
//
//             $map.css('height', height + 'px');
//
//             function initialize() {
//                 const mapOptions = {
//                     scrollwheel: false,
//                     zoom: 14,
//                     center: new google.maps.LatLng(centerLat, centerLng)
//                 };
//
//                 let map = new google.maps.Map($map[0], mapOptions);
//
//                 for (const i = 0; i < markers.length; i++) {
//                     const marker = markers[i];
//
//                     new google.maps.Marker({
//                         position: new google.maps.LatLng(marker.lat, marker.lng),
//                         map: this.map,
//                         title: marker.title
//                     });
//                 }
//
//             }
//
//             google.maps.event.addDomListener(window, 'load', initialize);
//
//             google.maps.event.addDomListener(window, 'resize', function () {
//                 const center = map.getCenter();
//                 google.maps.event.trigger(this.map, 'resize');
//                 this.map.setCenter(center);
//             });
//         });


// .uou-block-12c
// ---------------------------------------------------------
//         $('.uou-block-12c').each(function () {
//             const $block = $(this),
//                 $map = $block.find('.map-container .map');
//
//             // Map
//             const map,
//                 height = $map.data('height'),
//                 centerLat = $map.data('center-lat'),
//                 centerLng = $map.data('center-lng');
//
//             $map.css('height', height + 'px');
//
//             function initialize() {
//                 const mapOptions = {
//                     scrollwheel: false,
//                     zoom: 14,
//                     center: new google.maps.LatLng(centerLat, centerLng)
//                 };
//
//                 map = new google.maps.Map($map[0], mapOptions);
//
//                 const marker = new google.maps.Marker({
//                     position: new google.maps.LatLng(centerLat, centerLng),
//                     map: map,
//                     title: ''
//                 });
//             }
//
//             google.maps.event.addDomListener(window, 'load', initialize);
//
//             google.maps.event.addDomListener(window, 'resize', function () {
//                 const center = map.getCenter();
//                 google.maps.event.trigger(map, 'resize');
//                 map.setCenter(center);
//             });
//         });

    }

}
