import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';

@Component({
    selector: 'app-showcategories',
    templateUrl: './showcategories.component.html',
    styleUrls: ['./showcategories.component.css']
})
export class ShowcategoriesComponent implements OnInit {
    categories: any;

    constructor(private apiServices: ApiService) {
    }

    ngOnInit() {
        return this.apiServices.categories().subscribe(result => this.categories = result);
    }

    dataTitle(title: string) {
        localStorage.setItem('categoryTitle', title);
    }
}
