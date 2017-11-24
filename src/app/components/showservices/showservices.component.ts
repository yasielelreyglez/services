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
export class ShowservicesComponent implements OnInit, OnDestroy {

    services: any;

    constructor(private route: ActivatedRoute, private apiServices: ApiService, private data: Data) {
    }

    ngOnInit() {
        this.data.services.subscribe(result => {
            if (!isNull(result))
                this.services = result;
            else {
                this.route.params.subscribe((params: Params) => {
                    const id = params['id'];
                    this.apiServices.servicesSub(id).subscribe(resultparams => this.services = resultparams);
                });
            }
        });
    }

    ngOnDestroy() {
        this.data.services.next(null);
    }
}
