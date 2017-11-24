import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Router} from '@angular/router';
import {Data} from '../../_services/data.service';

@Component({
    selector: 'app-home',
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
    subcategories: any;
    query: any;

    constructor(private apiServices: ApiService, private router: Router, private data: Data) {
    }

    ngOnInit() {
        return this.apiServices.topSubcategories().subscribe(result => this.subcategories = result);
    }

    search() {
        this.apiServices.searchService(this.query).subscribe(result => {
            this.data.services.next(result);
            this.router.navigate(['/search']);
        });
    }
}
