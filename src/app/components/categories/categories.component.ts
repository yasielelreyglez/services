import {Component, OnInit} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {Data} from "../../_services/data.service";

@Component({
    selector: 'app-categories',
    templateUrl: './categories.component.html',
    styleUrls: ['./categories.component.css']
})
export class CategoriesComponent implements OnInit {
    categories = [{id: 1, title: 'cuba'}, {id: 2, title: 'bien'}]

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
