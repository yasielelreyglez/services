import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {ApiService} from '../../_services/api.service';

@Component({
    selector: 'app-showservice',
    templateUrl: './showservice.component.html',
    styleUrls: ['./showservice.component.css']
})
export class ShowserviceComponent implements OnInit {
    service: any = {};

    constructor(private route: ActivatedRoute, private apiServices: ApiService) {
    }

    ngOnInit() {
        this.route.params.subscribe(params => {
            const id = params['id'];
            this.apiServices.service(id).subscribe(result => this.service = result );
        });
    }
}
