import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';

@Component({
    selector: 'app-showmyservices',
    templateUrl: './showmysearchs.component.html',
    styleUrls: ['./showmysearchs.component.css']
})
export class ShowmysearchsComponent implements OnInit {
    services: any;

    constructor(private apiServices: ApiService) {
    }

    ngOnInit() {
        window.scrollTo(0, 0);
        this.apiServices.mySearchs().subscribe(result => this.services = result);
    }

}
