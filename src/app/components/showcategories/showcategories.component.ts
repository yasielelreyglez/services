import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Data} from '../../_services/data.service';

@Component({
    selector: 'app-showcategories',
    templateUrl: './showcategories.component.html',
    styleUrls: ['./showcategories.component.css']
})
export class ShowcategoriesComponent implements OnInit {
    categories: any;

    constructor(private apiServices: ApiService, private data: Data) {
    }

    ngOnInit() {
        this.allCategories();
    }

    allCategories() {
        return this.apiServices.categories().subscribe(result => this.categories = result);
    }

    dataTitle(title: string) {
        this.data.storage = {title};
    }
}
