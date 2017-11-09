import {Component, OnInit, Input} from '@angular/core';
import {Subcategory} from '../../_models/subcategory';

@Component({
    selector: 'app-subcategories',
    templateUrl: './subcategories.component.html',
    styleUrls: ['./subcategories.component.css']
})
export class SubcategoriesComponent implements OnInit {
    @Input() subcategories: Subcategory[];

    constructor() {
    }

    ngOnInit() {
    }
}
