import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Router} from '@angular/router';
import {Data} from '../../_services/data.service';
import {FormControl, Validators} from '@angular/forms';

@Component({
    selector: 'app-home',
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
    subcategories: any;
    query: any;
    search = new FormControl('', [Validators.required]);

    constructor(private apiServices: ApiService, private router: Router, private data: Data) {
    }

    ngOnInit() {
        return this.apiServices.topSubcategories().subscribe(result => this.subcategories = result);
    }

    getErrorMessage() {
        return this.search.hasError('required') ? 'You must enter a value' :
            '';
    }

    searchQuery() {
        this.apiServices.searchService(this.query).subscribe(result => {
            this.data.services.next(result);
            this.router.navigate(['/search']);
        });
    }

}
