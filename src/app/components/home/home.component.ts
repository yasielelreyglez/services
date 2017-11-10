import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Subcategory} from '../../_models/subcategory';

@Component({
    selector: 'app-home',
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
    subcategories: Subcategory[];

    constructor(private apiServices: ApiService) {
        this.subcategories = new Subcategory()[0];
    }

    ngOnInit() {
        return this.apiServices.topSubcategories().subscribe(result => this.subcategories = result);
    }
}
