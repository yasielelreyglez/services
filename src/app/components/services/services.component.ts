import {Component, OnInit, Input, AfterViewInit, AfterViewChecked, AfterContentChecked} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {ReportComponent} from '../_modals/report/report.component';
import {AuthService} from '../../_services/auth.service';
import {MatDialog, MatSnackBar} from '@angular/material';
import {isNull} from 'util';
import {ReportServiceComponent} from "../_modals/reportservice/reportservice.component";
import {DeletedialogComponent} from '../_modals/deletedialog/deletedialog.component';

declare const $: any;
declare const google;

@Component({
    selector: 'app-services',
    templateUrl: './services.component.html',
    styleUrls: ['./services.component.css']
})
export class ServicesComponent implements OnInit, AfterViewInit, AfterViewChecked, AfterContentChecked {

    @Input() services: any;
    @Input() myfavorites?: boolean;
    @Input() myservices?: boolean;
    @Input() mysearch?: boolean;

    loggedIn = false;
    citiesList: string;

    constructor(public dialog: MatDialog, private apiServices: ApiService, private authServices: AuthService,
                private snackBar: MatSnackBar) {

    }

    ngOnInit() {
        window.scrollTo(0, 0);

        this.authServices.currentUser.subscribe(user => {
            this.loggedIn = !!user;
        });
    }

    ngAfterViewChecked(): void {
        if ($.fn.uouAccordions) {
            $('.uou-accordions').uouAccordions();
        } else {
            console.warn('not loaded -> uou-accordions.js');
        }

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
    }

    ngAfterContentChecked(): void {
    }

    ngAfterViewInit(): void {
        // this.scripts();
    }

    reportDialog(id: number): void {
        const dialogRef = this.dialog.open(ReportServiceComponent, {
            width: '60%',
            height: '400px',
            data: {id: id}
        });

        dialogRef.afterClosed().subscribe(result => {
            if (result) {
                this.openSnackBar('El servicio ha sido evaluado satisfactoriamente', 2500);
            }
        });
    }

    openDialog(id): void {
        const dialogRef = this.dialog.open(ReportComponent, {
            width: '70%',
            height: '303px',
            data: {id: id}
        });

        dialogRef.afterClosed().subscribe(() => {
            console.log('The dialog was closed');
        });
    }

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

    delete(id) {
        let dialogRef = this.dialog.open(DeletedialogComponent, {
            width: '300px',
            height: '180px',
            data: { name:'este servicio' }
        });
        dialogRef.afterClosed().subscribe(result => {
            console.log('The dialog was closed',result);
            if(result) {
                this.apiServices.deleteService(id).subscribe(result => {
                    this.services = this.services.filter(service => service.id !== id);
                    this.openSnackBar('El servicio fue eliminado satisfactoriamente', 2500);
                });
            }
        });
    }

    result_cities(service: any) {
        if (!isNull(service.citiesList)) {
            let result = '';
            for (let city of service.citiesList) {
                result += city.title + ', ';
            }
            return result.substring(0, (result.length - 2));
        }
        return '';
    }

    result_subcategories(service: any) {
        if (!isNull(service.subcategoriesList)) {
            let result = '';
            // if (service.subcategoriesList.length > 1) {
            //     result = service.subcategoriesList[0].title + ', (...)';
            // }
            // else {
            //     result = service.subcategoriesList[0].title;
            // }

            for (let city of service.subcategoriesList) {
                result += city.title + ', ';
            }

            return result.substring(0, (result.length - 2));
        }
        return '';
    }

    markFavorite(id, state, pos) {
        let results: any;
        if (state === 1) {
            this.apiServices.disMarkfavorite(id).subscribe(() => {
                this.services[pos].favorite = 0;
                this.openSnackBar('El servicio fue eliminado de "Mis favoritos" satisfactoriamente', 2500);

                if (this.myfavorites)
                    this.services = this.services.filter(service => service.id !== id);
            });
        } else {
            this.apiServices.markfavorite(id).subscribe(result => results = result);
            this.services[pos].favorite = 1;
            this.openSnackBar('El servicio fue añadido a "Mis favoritos" satisfactoriamente', 2500);
        }
    }

    openSnackBar(message: string, duration: number, action ?: string) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
        });
    }


    //     scripts() {
//         'use strict';
//
//         const $body = $('body');
//         const body = $('body');
// // const $head = $('head');
// // const $mainWrapper = $('#main-wrapper');
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
// //         if ($.fn.flexslider) {
// //             $('.default-slider').flexslider({
// //                 slideshowSpeed: 10000,
// //                 animationSpeed: 1000,
// //                 prevText: '',
// //                 nextText: ''
// //             });
// //         } else {
// //             console.warn('not loaded -> jquery.flexslider-min.js');
// //         }
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

}
