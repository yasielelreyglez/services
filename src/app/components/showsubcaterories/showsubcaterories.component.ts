import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Params} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {Subcategory} from '../../_models/subcategory';

@Component({
    selector: 'app-showsubcaterories',
    templateUrl: './showsubcaterories.component.html',
    styleUrls: ['./showsubcaterories.component.css']
})
export class ShowsubcateroriesComponent implements OnInit {
    subcategories: any;
    name: string;

    constructor(private route: ActivatedRoute, private apiServices: ApiService) {
        this.subcategories = new Subcategory()[0];
        const name = localStorage.getItem('categoryTitle');
        if (name)
            this.name = name;
    }

    ngOnInit() {
        this.route.params.subscribe((params: Params) => {
            const id = params['id'];
            this.apiServices.subCategories(id).subscribe(result => this.subcategories = result);
        });

    }

}



