import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {RatingComponent} from '../_modals/rating/rating.component';

@Component({
    selector: 'app-showservice',
    templateUrl: './showservice.component.html',
    styleUrls: ['./showservice.component.css']
})
export class ShowserviceComponent implements OnInit {
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
}
