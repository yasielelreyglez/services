import {Component, OnInit,ViewChild, ElementRef} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {RatingComponent} from '../_modals/rating/rating.component';
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
    days: string[] = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    week_days: any = '';

    constructor(private route: ActivatedRoute, private apiServices: ApiService, private modalService: NgbModal ) {
    }

    ngOnInit() {
        this.route.params.subscribe(params => {
            const id = params['id'];
            this.apiServices.service(id).subscribe(result => {
                this.service = result;
                this.result_week_days();
            });
        });
        // var mapProp = {
        //     center: new google.maps.LatLng(51.508742, -0.120850),
        //     zoom: 5,
        //     mapTypeId: google.maps.MapTypeId.ROADMAP
        // };
        // var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        // this.initMap()
    }
    initMap() {
        console.log("CUALQUIER TEXTO");
        console.log(this.mapElement)

        let cuba = new google.maps.LatLng(23.11941, -82.32134);
        this.map = new google.maps.Map(document.getElementById("map2"), {
            zoom: 7,
            center: cuba
        });

        // this.directionsDisplay.setMap(this.map);
    }
    result_week_days() {
        const days = this.service.week_days.split(',');
        let result = '';
        for (let day in days) {
            result += this.days[day] + ', ';
        }
        console.log(this.week_days.length - 1);
        this.week_days = result.substring(0, (result.length - 2));
    }

    evaluar() {
        this.modalService.open(RatingComponent);
    }
     tabChange(){
        console.log("TAB CHANGED");
    }
}
