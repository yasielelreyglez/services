import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';

@Component({
    selector: 'app-showfavorites',
    templateUrl: './showfavorites.component.html',
    styleUrls: ['./showfavorites.component.css']
})
export class ShowfavoritesComponent implements OnInit {
    services: any;

    constructor(private apiServices: ApiService) {
    }

    ngOnInit() {
        this.apiServices.myfavorites().subscribe(result => this.services = result);
    }

}
