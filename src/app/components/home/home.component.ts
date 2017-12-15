import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Router} from '@angular/router';
import {FormControl} from '@angular/forms';

@Component({
    selector: 'app-home',
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
    subcategories: any;
    query: any;
    search = new FormControl('');

    constructor(private apiServices: ApiService, private router: Router) {
    }

    ngOnInit() {
        return this.apiServices.topSubcategories().subscribe(result => this.subcategories = result);
    }

    searchQuery() {
        if (this.query !== undefined) {
            this.apiServices.searchService(this.query).subscribe(result => {
                localStorage.setItem('searchServices', JSON.stringify(result));
                this.router.navigate(['/search']);
            });
        }
    }

}
