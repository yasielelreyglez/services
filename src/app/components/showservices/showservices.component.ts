import {Component, OnDestroy, OnInit} from '@angular/core';
import {ActivatedRoute, Params} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {Data} from '../../_services/data.service';
import {isNull} from 'util';

@Component({
    selector: 'app-showservices',
    templateUrl: './showservices.component.html',
    styleUrls: ['./showservices.component.css']
})
export class ShowservicesComponent implements OnInit {

    services: any;

    constructor(private route: ActivatedRoute, private apiServices: ApiService, private data: Data) {
    }

    ngOnInit() {
        this.route.params.subscribe((params: Params) => {
            const id = params['id'];
            if (id)
                this.apiServices.servicesSub(id).subscribe(resultparams => this.services = resultparams);
            else {
                this.data.services.subscribe(result => {
                    this.services = result;
                });
            }
        });
    }
}
