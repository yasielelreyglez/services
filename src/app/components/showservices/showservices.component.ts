import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Params} from '@angular/router';
import {ApiService} from '../../_services/api.service';

@Component({
    selector: 'app-showservices',
    templateUrl: './showservices.component.html',
    styleUrls: ['./showservices.component.css']
})
export class ShowservicesComponent implements OnInit {
    services: any;

    constructor(private route: ActivatedRoute, private apiServices: ApiService) {
    }

    ngOnInit() {
        this.route.params.subscribe((params: Params) => {
            const id = params['id'];
            this.apiServices.servicesSub(id).subscribe(result => this.services = result);
        });
    }

}
