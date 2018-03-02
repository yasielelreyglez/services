import {AfterViewInit, Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {RatingComponent} from '../_modals/rating/rating.component';
import {MatDialog, MatSnackBar, MatTabChangeEvent} from '@angular/material';
import {AuthService} from '../../_services/auth.service';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {DatePipe} from '@angular/common';

declare const google;
declare const $: any;

@Component({
    selector: 'app-showservice',
    templateUrl: './showservice.component.html',
    styleUrls: ['./showservice.component.css']
})

export class ShowserviceComponent implements OnInit, AfterViewInit {
    service: any;
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
    recentvisits: any;

    @ViewChild('map') mapElement: ElementRef;
    map: any;
    latLng: any;
    infoWindow: any;
    positions: any;
    currentPosition: any;
    currentEnd: any;
    image: any;
    directionsService: any;
    directionsDisplay: any;
    distanceMatrix;
    markers: any;
    flagMap: boolean;

    constructor(private route: ActivatedRoute, private apiServices: ApiService,
                public dialog: MatDialog, private authServices: AuthService, private snackBar: MatSnackBar) {
        this.model = {};
        this.loading = false;
        this.flagMap = false;
        this.markers = new Array();
        this.currentEnd = {id: -1};
        this.service = {};

        this.submitAttempt = false;
        if (typeof google !== 'undefined') {
            this.latLng = new google.maps.LatLng(23.13302, -82.38304);
            this.infoWindow = new google.maps.InfoWindow;

            this.image = new google.maps.MarkerImage('https://upload.wikimedia.org/wikipedia/commons/a/a2/Location_dot_cyan.svg', null, null, null, new google.maps.Size(15, 15));
            this.currentPosition = new google.maps.Marker({});

            this.distanceMatrix = new google.maps.DistanceMatrixService;

            this.directionsService = new google.maps.DirectionsService;
            this.directionsDisplay = new google.maps.DirectionsRenderer;
            const content = '<h6 class="tc-blue">Mi Posición</h6>';
            this.addInfoWindow(this.currentPosition, content);
        }
    }

    ngOnInit() {
        // window.scrollTo(0, 0);

        this.apiServices.recentVisits().subscribe(result => this.recentvisits = result);

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
        // this.scripts();
    }

//     scripts() {
//         'use strict';
//
//         const $body = $('body');
//         const body = $('body');
//         // const $head = $('head');
//         // const $mainWrapper = $('#main-wrapper');
//
//         const contact = $(body).find('.contact-button');
//         const contactWindow = $(contact).find('.contact-details');
//
//         $('.sponsors-slider').owlCarousel({
//             items: 6
//         });
//
//         $(contact).on('click', function (e) {
//             $(this).find(contactWindow).toggle();
//             e.preventDefault();
//         });
//
//         const share = $(body).find('.share-button');
//         const shareWindow = $(share).find('.contact-share');
//
//         $(share).on('click', function (e) {
//             $(this).find(shareWindow).toggle();
//             e.preventDefault();
//         });
//
//         const advancedButton = $(body).find('.map-toggleButton');
//         const advancedContent = $(body).find('.advanced-search');
//         const hide = $(body).find('.close');
//
//         $(advancedButton).on('click', function () {
//             $(this).toggleClass('active');
//             $(advancedContent).toggle();
//         });
//
//         $(hide).on('click', function () {
//
//             $(advancedButton).removeClass('active');
//             $(advancedContent).hide();
//         });
//
//
//         $('.slider-range-container').each(function () {
//             if ($.fn.slider) {
//
//                 const self = $(this),
//                     slider = self.find('.slider-range'),
//                     min = slider.data('min') ? slider.data('min') : 100,
//                     max = slider.data('max') ? slider.data('max') : 2000,
//                     step = slider.data('step') ? slider.data('step') : 100,
//                     default_min = slider.data('default-min') ? slider.data('default-min') : 100,
//                     default_max = slider.data('default-max') ? slider.data('default-max') : 500,
//                     currency = slider.data('currency') ? slider.data('currency') : '$',
//                     input_from = self.find('.range-from'),
//                     input_to = self.find('.range-to');
//
//                 input_from.val(currency + ' ' + default_min);
//                 input_to.val(currency + ' ' + default_max);
//
//                 slider.slider({
//                     range: true,
//                     min: min,
//                     max: max,
//                     step: step,
//                     values: [default_min, default_max],
//                     slide: function (event, ui) {
//                         input_from.val(currency + ' ' + ui.values[0]);
//                         input_to.val(currency + ' ' + ui.values[1]);
//                     }
//                 });
//             }
//         });
//
//         // $('.custom-select').select2();
//
//
//         // $('#single-company-map').gmap3({
//         //     map: {
//         //         address: 'St james St New York, USA',
//         //         options: {
//         //             zoom: 14,
//         //             mapTypeId: 'subtle',
//         //             mapTypeControl: false,
//         //             mapTypeControlOptions: {
//         //                 mapTypeIds: ['subtle']
//         //             },
//         //             navigationControl: false,
//         //             scrollwheel: false,
//         //             draggable: false,
//         //             streetViewControl: false,
//         //             disableDefaultUI: true,
//         //         },
//         //     },
//         //     styledmaptype: subtleOptions
//         // });
//         //
//         // $('#map-listing-05').gmap3({
//         //     map: {
//         //         address: 'POURRIERES, FRANCE',
//         //         options: {
//         //             zoom: 17,
//         //             mapTypeId: google.maps.MapTypeId.ROADMAP,
//         //             mapTypeControl: false,
//         //             mapTypeControlOptions: {
//         //                 style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
//         //             },
//         //             navigationControl: false,
//         //             scrollwheel: false,
//         //             streetViewControl: false
//         //         }
//         //     }
//         // });
//         //
//         // $('a[href="#contact"]').on('shown.bs.tab', function () {
//         //     $('#map-listing-04').gmap3({trigger: 'resize'});
//         // });
//         //
//         // $('a[href="#contact"]'
//         // ).on('shown.bs.tab', function () {
//         //     $('#map-listing-05').gmap3({trigger: 'resize'});
//         // });
//
// // Mediaqueries
// // ---------------------------------------------------------
// // const XS = window.matchMedia('(max-width:767px)');
// // const SM = window.matchMedia('(min-width:768px) and (max-width:991px)');
// // const MD = window.matchMedia('(min-width:992px) and (max-width:1199px)');
// // const LG = window.matchMedia('(min-width:1200px)');
// // const XXS = window.matchMedia('(max-width:480px)');
// // const SM_XS = window.matchMedia('(max-width:991px)');
// // const LG_MD = window.matchMedia('(min-width:992px)');
//
//
// // Google Maps Markers Array (for demo)
//         const markers = [
//             {
//                 lat: 37.780823,
//                 lng: -122.4231,
//                 title: 'Marker 1'
//             }, {
//                 lat: 37.768068680454725,
//                 lng: -122.430739402771,
//                 title: 'Marker 2'
//             }, {
//                 lat: 37.7791272169824,
//                 lng: -122.4296236038208,
//                 title: 'Marker 3'
//             }, {
//                 lat: 37.770715,
//                 lng: -122.392631,
//                 title: 'Marker 4'
//             }, {
//                 lat: 37.78197638783258,
//                 lng: -122.45829105377197,
//                 title: 'Marker 5'
//             }, {
//                 lat: 37.769629187677,
//                 lng: -122.46798992156982,
//                 title: 'Marker 6'
//             }
//         ];
//
//
// // Touch
// // ---------------------------------------------------------
//         const dragging = false;
//
//         $body.on('touchmove', function () {
//             this.dragging = true;
//         });
//
//         $body.on('touchstart', function () {
//             this.dragging = false;
//         });
//
//
// // Set Background Image
// // ---------------------------------------------------------
//         $('.has-bg-image').each(function () {
//             const $this = $(this),
//
//                 image = $this.data('bg-image'),
//                 color = $this.data('bg-color'),
//                 opacity = $this.data('bg-opacity'),
//
//                 $content = $('<div/>', {'class': 'content'}),
//                 $background = $('<div/>', {'class': 'background'});
//
//             if (opacity) {
//                 $this.children().wrapAll($content);
//                 $this.append($background);
//
//                 $this.css({
//                     'background-image': 'url(' + image + ')'
//                 });
//
//                 $background.css({
//                     'background-color': '#' + color,
//                     'opacity': opacity
//                 });
//             } else {
//                 $this.css({
//                     'background-image': 'url(' + image + ')',
//                     'background-color': '#' + color
//                 });
//             }
//         });
//
//
// // Superfish Menus
// // ---------------------------------------------------------
// //         if ($.fn.superfish) {
// //             $('.sf-menu').superfish();
// //         } else {
// //             console.warn('not loaded -> superfish.min.js and hoverIntent.js');
// //         }
//
//
// // Mobile Sidebar
// // ---------------------------------------------------------
//         $('.mobile-sidebar-toggle').on('click', function () {
//             $body.toggleClass('mobile-sidebar-active');
//             return false;
//         });
//
//         $('.mobile-sidebar-open').on('click', function () {
//             $body.addClass('mobile-sidebar-active');
//             return false;
//         });
//
//         $('.mobile-sidebar-close').on('click', function () {
//             $body.removeClass('mobile-sidebar-active');
//             return false;
//         });
//
//
// // UOU Tabs
// // ---------------------------------------------------------
//         if ($.fn.uouTabs) {
//             $('.uou-tabs').uouTabs();
//         } else {
//             console.warn('not loaded -> uou-tabs.js');
//         }
//
//
// // UOU Accordions
// // ---------------------------------------------------------
//         if ($.fn.uouAccordions) {
//             $('.uou-accordions').uouAccordions();
//         } else {
//             console.warn('not loaded -> uou-accordions.js');
//         }
//
//
// // UOU Alers
// // ---------------------------------------------------------
//         $('.alert').each(function () {
//             const $this = $(this);
//
//             if ($this.hasClass('alert-dismissible')) {
//                 $this.children('.close').on('click', function (event) {
//                     event.preventDefault();
//
//                     $this.remove();
//                 });
//             }
//         });
//
//
// // Default Slider
// // ---------------------------------------------------------
//         if ($.fn.flexslider) {
//             $('.default-slider').flexslider({
//                 slideshowSpeed: 10000,
//                 animationSpeed: 1000,
//                 prevText: '',
//                 nextText: ''
//             });
//         } else {
//             console.warn('not loaded -> jquery.flexslider-min.js');
//         }
//
//
// // Range Slider (forms)
// // ---------------------------------------------------------
//         if ($.fn.rangeslider) {
//             $('input[type="range"]'
//             ).rangeslider({
//                 polyfill: false,
//                 onInit: function () {
//                     this.$range.wrap('<div class="uou-rangeslider"></div>').parent().append('<div class="tooltip">' + this.$element.data('unit-before') + '<span></span>' + this.$element.data('unit-after') + '</div>');
//                 },
//                 onSlide: function (value, position) {
//                     const $span = this.$range.parent().find('.tooltip span');
//                     $span.html(position);
//                 }
//             });
//         } else {
//             console.warn('not loaded -> rangeslider.min.js');
//         }
//
//
// // Placeholder functionality for selects (forms)
// // ---------------------------------------------------------
//         function selectPlaceholder(el) {
//             const $el = $(el);
//
//             if ($el.val() === 'placeholder') {
//                 $el.addClass('placeholder');
//             } else {
//                 $el.removeClass('placeholder');
//             }
//         }
//
//         $('select').each(function () {
//             selectPlaceholder(this);
//         }).change(function () {
//             selectPlaceholder(this);
//         });
//
//
// // ---------------------------------------------------------
// // BLOCKS
// // BLOCKS
// // BLOCKS
// // BLOCKS
// // BLOCKS
// // ---------------------------------------------------------
//
//
// // .uou-block-1a
// // ---------------------------------------------------------
//         $('.uou-block-1a').each(function () {
//             const $block = $(this);
//
//             // search
//             $block.find('.search').each(function () {
//                 const $this = $(this);
//
//                 $this.find('.toggle').on('click', function (event) {
//                     event.preventDefault();
//                     $this.addClass('active');
//                     setTimeout(function () {
//                         $this.find('.search-input').focus();
//                     }, 100);
//                 });
//
//                 $this.find('input[type="text"]'
//                 ).on('blur', function () {
//                     $this.removeClass('active');
//                 });
//             });
//
//             // language
//             $block.find('.language').each(function () {
//                 const $this = $(this);
//
//                 $this.find('.toggle').on('click', function (event) {
//                     event.preventDefault();
//
//                     if (!$this.hasClass('active')) {
//                         $this.addClass('active');
//                     } else {
//                         $this.removeClass('active');
//                     }
//                 });
//             });
//         });
//
//
// // .uou-block-1b
// // ---------------------------------------------------------
//         $('.uou-block-1b').each(function () {
//             const $block = $(this);
//
//             // language
//             $block.find('.language').each(function () {
//                 const $this = $(this);
//
//                 $this.find('.toggle').on('click', function (event) {
//                     event.preventDefault();
//
//                     if (!$this.hasClass('active')) {
//                         $this.addClass('active');
//                     } else {
//                         $this.removeClass('active');
//                     }
//                 });
//             });
//         });
//
//
// // .uou-block-1e
// // ---------------------------------------------------------
//         $('.uou-block-1e').each(function () {
//             const $block = $(this);
//
//             // language
//             $block.find('.language').each(function () {
//                 const $this = $(this);
//
//                 $this.find('.toggle').on('click', function (event) {
//                     event.preventDefault();
//
//                     if (!$this.hasClass('active')) {
//                         $this.addClass('active');
//                     } else {
//                         $this.removeClass('active');
//                     }
//                 });
//             });
//         });
//
//
// // .uou-block-5b
// // ---------------------------------------------------------
//         $('.uou-block-5b').each(function () {
//             const $block = $(this),
//                 $tabs = $block.find('.tabs > li');
//
//             $tabs.on('click', function () {
//                 const $this = $(this),
//                     target = $this.data('target');
//
//                 if (!$this.hasClass('active')) {
//                     $block.find('.' + target).addClass('active').siblings('blockquote').removeClass('active');
//
//                     $tabs.removeClass('active');
//                     $this.addClass('active');
//
//                     return false;
//                 }
//             });
//         });
//
//
// // .uou-block-5c
// // ---------------------------------------------------------
//         $('.uou-block-5c').each(function () {
//             const $block = $(this);
//
//             if ($.fn.flexslider) {
//                 $block.find('.flexslider').flexslider({
//                     slideshowSpeed: 10000,
//                     animationSpeed: 1000,
//                     prevText: '',
//                     nextText: '',
//                     controlNav: false,
//                     smoothHeight: true
//                 });
//             } else {
//                 console.warn('not loaded -> jquery.flexslider-min.js');
//             }
//         });
//
//
// // .uou-block-7g
// // ---------------------------------------------------------
//         $('.uou-block-7g').each(function () {
//             const $block = $(this),
//                 $badge = $block.find('.badge'),
//                 badgeColor = $block.data('badge-color');
//
//             if (badgeColor) {
//                 $badge.css('background-color', '#' + badgeColor);
//             }
//         });
//
//
// // .uou-block-7h
// // ---------------------------------------------------------
//         $('.uou-block-7h').each(function () {
//             const $block = $(this);
//
//             if ($.fn.flexslider) {
//                 $block.find('.flexslider').flexslider({
//                     slideshowSpeed: 10000,
//                     animationSpeed: 1000,
//                     prevText: '',
//                     nextText: '',
//                     directionNav: false,
//                     smoothHeight: true
//                 });
//             } else {
//                 console.warn('not loaded -> jquery.flexslider-min.js');
//             }
//         });
//
//
// // .uou-block-11a
// // ---------------------------------------------------------
// //         $('.uou-block-11a').each(function () {
// //             const $block = $(this);
// //
// //             // nav
// //             $block.find('.main-nav').each(function () {
// //                 const $this = $(this).children('ul');
// //
// //                 $this.find('li').each(function () {
// //                     const $this = $(this);
// //
// //                     if ($this.children('ul').length > 0) {
// //                         $this.addClass('has-submenu');
// //                         $this.append('<span class="arrow"></span>');
// //                     }
// //                 });
// //
// //                 const $submenus = $this.find('.has-submenu');
// //
// //                 $submenus.children('.arrow').on('click', function (event) {
// //                     const $this = $(this),
// //                         $li = $this.parent('li');
// //
// //                     if (!$li.hasClass('active')) {
// //                         $li.addClass('active');
// //                         $li.children('ul').slideDown();
// //                     } else {
// //                         $li.removeClass('active');
// //                         $li.children('ul').slideUp();
// //                     }
// //                 });
// //             });
// //         });
//
//
// // .uou-block-12a
// // ---------------------------------------------------------
// //         $('.uou-block-12a').each(function () {
// //             const $block = $(this),
// //                 $map = $block.find('.map-container .map');
// //
// //             // Map
// //             const map,
// //                 height = $map.data('height'),
// //                 centerLat = $map.data('center-lat'),
// //                 centerLng = $map.data('center-lng');
// //
// //             $map.css('height', height + 'px');
// //
// //             function initialize() {
// //                 const mapOptions = {
// //                     scrollwheel: false,
// //                     zoom: 14,
// //                     center: new google.maps.LatLng(centerLat, centerLng)
// //                 };
// //
// //                 map = new google.maps.Map($map[0], mapOptions);
// //
// //                 for (const i = 0; i < markers.length; i++) {
// //                     const marker = markers[i];
// //
// //                     new google.maps.Marker({
// //                         position: new google.maps.LatLng(marker.lat, marker.lng),
// //                         map: map,
// //                         title: marker.title
// //                     });
// //                 }
// //             }
// //
// //             google.maps.event.addDomListener(window, 'load', initialize);
// //
// //             google.maps.event.addDomListener(window, 'resize', function () {
// //                 const center = map.getCenter();
// //                 google.maps.event.trigger(map, 'resize');
// //                 map.setCenter(center);
// //             });
// //         });
//
//
// // .uou-block-12b
// // ---------------------------------------------------------
// //         $('.uou-block-12b').each(function () {
// //             const $block = $(this),
// //                 $map = $block.find('.map-container .map');
// //
// //             // Map
// //             const map,
// //                 height = $map.data('height'),
// //                 centerLat = $map.data('center-lat'),
// //                 centerLng = $map.data('center-lng');
// //
// //             $map.css('height', height + 'px');
// //
// //             function initialize() {
// //                 const mapOptions = {
// //                     scrollwheel: false,
// //                     zoom: 14,
// //                     center: new google.maps.LatLng(centerLat, centerLng)
// //                 };
// //
// //                 let map = new google.maps.Map($map[0], mapOptions);
// //
// //                 for (const i = 0; i < markers.length; i++) {
// //                     const marker = markers[i];
// //
// //                     new google.maps.Marker({
// //                         position: new google.maps.LatLng(marker.lat, marker.lng),
// //                         map: this.map,
// //                         title: marker.title
// //                     });
// //                 }
// //
// //             }
// //
// //             google.maps.event.addDomListener(window, 'load', initialize);
// //
// //             google.maps.event.addDomListener(window, 'resize', function () {
// //                 const center = map.getCenter();
// //                 google.maps.event.trigger(this.map, 'resize');
// //                 this.map.setCenter(center);
// //             });
// //         });
//
//
// // .uou-block-12c
// // ---------------------------------------------------------
// //         $('.uou-block-12c').each(function () {
// //             const $block = $(this),
// //                 $map = $block.find('.map-container .map');
// //
// //             // Map
// //             const map,
// //                 height = $map.data('height'),
// //                 centerLat = $map.data('center-lat'),
// //                 centerLng = $map.data('center-lng');
// //
// //             $map.css('height', height + 'px');
// //
// //             function initialize() {
// //                 const mapOptions = {
// //                     scrollwheel: false,
// //                     zoom: 14,
// //                     center: new google.maps.LatLng(centerLat, centerLng)
// //                 };
// //
// //                 map = new google.maps.Map($map[0], mapOptions);
// //
// //                 const marker = new google.maps.Marker({
// //                     position: new google.maps.LatLng(centerLat, centerLng),
// //                     map: map,
// //                     title: ''
// //                 });
// //             }
// //
// //             google.maps.event.addDomListener(window, 'load', initialize);
// //
// //             google.maps.event.addDomListener(window, 'resize', function () {
// //                 const center = map.getCenter();
// //                 google.maps.event.trigger(map, 'resize');
// //                 map.setCenter(center);
// //             });
// //         });
//
//     }

    result_rate(service) {
        let result = '';
        for (const value of [1, 2, 3, 4, 5]) {
            if (value <= service.globalrate) {
                result += '<li><i class="fa fa-star"></i></li> ';
            }
            else {
                result += '<li><i class="fa fa-star-o"></i></li> ';
            }
        }

        return result;
    }

    // tabChanged = (tabChangeEvent: MatTabChangeEvent): void => {
    //     if (tabChangeEvent.index === 1) {
    //         if (typeof google !== 'undefined') {
    //             this.initMap();
    //             this.addPositions(this);
    //             this.currentEnd.id = -1;
    //
    //             this.directionsDisplay.setMap(null);
    //             // google.maps.event.trigger(this.map, 'resize');
    //         }
    //     }
    // }

    MapPos() {
        if (!this.flagMap) {
            if (typeof google !== 'undefined') {
                this.initMap();
                this.addPositions(this);
                this.currentEnd.id = -1;

                this.directionsDisplay.setMap(null);
                // google.maps.event.trigger(this.map, 'resize');
                this.flagMap = true;
            }
        }
    }

    initMap() {
        if (typeof google !== 'undefined') {
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
        }
    }

    addPositions(that: any) {
        if (typeof google !== 'undefined') {
            this.directionsDisplay.setMap(this.map);
            this.directionsDisplay.setOptions({suppressMarkers: true});
            this.positions = this.service.positionsList;
            for (let i = 0; i < this.positions.length; i++) {
                setTimeout(() => {
                    const marker = new google.maps.Marker({
                        map: this.map,
                        position: new google.maps.LatLng(this.positions[i].latitude, this.positions[i].longitude),
                        animation: google.maps.Animation.DROP,
                    });

                    that.markers.push(marker);

                    const content = '<h6 class="tc-blue"><a>' + this.positions[i].title + '</a></h6>';
                    this.addInfoWindow(marker, content);
                }, i * 200);
            }

            // navigator.geolocation.getCurrentPosition(function (position) {
            //     console.log(position);
            // })

            if (window.navigator.geolocation) {
                window.navigator.geolocation.watchPosition(function (position) {
                    const latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                    that.currentPosition.setPosition(latLng);
                    that.currentPosition.setIcon(that.image);
                    that.currentPosition.setMap(that.map);
                    that.map.panTo(latLng);

                    if (that.currentEnd.id !== -1)
                        that.calculateAndDisplayRoute();

                }, function () {
                    that.currentPosition.setMap(null);
                });
            }
            else {
                that.currentPosition.setMap(null);
            }
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

    changeCurrentEnd(pos) {
        if (this.currentEnd.id !== -1) {
            if (this.currentEnd.id === pos) {
                this.currentEnd.id = -1;
                this.directionsDisplay.setMap(null);
                this.map.setZoom(11);
            }
            else {
                this.currentEnd.id = pos;
                this.currentEnd.marker = this.markers[pos];
                this.directionsDisplay.setMap(this.map);
                this.calculateAndDisplayRoute();
            }
        }
        else {
            this.directionsDisplay.setMap(this.map);
            this.currentEnd.id = pos;
            this.currentEnd.marker = this.markers[pos];
            this.calculateAndDisplayRoute();
        }
    }

    calculateAndDisplayRoute() {
        this.directionsService.route({
            origin: this.currentPosition.getPosition(),
            destination: this.currentEnd.marker.getPosition(),
            travelMode: 'DRIVING'
        }, (response, status) => {
            if (status === 'OK') {
                this.directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }

    result_week_days() {
        // if (this.service.week_days !== '') {
        //     const days = this.service.week_days.split(',');
        //     let result = '';
        //     for (const day of days) {
        //         result += this.days[day] + ', ';
        //     }
        //     this.week_days = result.substring(0, (result.length - 2));
        // }
        // else {
        //     this.week_days = '';
        // }
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
                        this.openSnackBar(result.error, 2500);
                    }
                }
                else {
                    this.error = 'Error en el servidor';
                    this.openSnackBar('Error inesperado', 2500);
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
                        this.openSnackBar(result.error, 2500);
                    }
                }
                else {
                    this.openSnackBar('Error inesperado', 2500);
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
                this.openSnackBar(result.error, 2500);
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
            width: '60%',
            height: '405px',
            data: {service: this.service}
        });

        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                this.service = result;
                this.openSnackBar('El servicio ha sido evaluado satisfactoriamente', 2500);
                this.apiServices.recentVisits().subscribe(response => this.recentvisits = response);
            }
        });
    }

    openSnackBar(message: string, duration: number, action ?: string) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
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
                this.openSnackBar('Su comentario ha sido insertado correctamente', 2500);
            }
            else {
                this.error = 'Error en el servidor';
                this.loading = false;
            }
        });
    }
}
