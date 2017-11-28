import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Params} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {Data} from '../../_services/data.service';
import {City} from '../../_models/city';
import {FormControl, FormGroup, Validators} from '@angular/forms';

@Component({
    selector: 'app-showservices',
    templateUrl: './showservices.component.html',
    styleUrls: ['./showservices.component.css']
})
export class ShowservicesComponent implements OnInit {
    services: any;
    cities: City[];
    subcategories: any;
    model: any;
    filterForm: FormGroup;

    constructor(private route: ActivatedRoute, private apiServices: ApiService, private data: Data) {
        this.model = {};
    }

    ngOnInit() {
        this.route.params.subscribe((params: Params) => {
            const id = params['id'];
            if (id)
                this.apiServices.servicesSub(id).subscribe(resultparams => this.services = resultparams);
            else {
                this.data.services.subscribe(result => {
                    this.services = result;
                });
            }
        });

        this.apiServices.cities().subscribe(result => this.cities = result);
        this.apiServices.allSubCategories().subscribe(result => this.subcategories = result);

        this.createForm();
    }

    createForm() {
        this.filterForm = new FormGroup({
            cities: new FormControl(''),
            subcategory: new FormControl(''),
            distance: new FormControl('', [Validators.min(1)])
        });
    }

    getErrorMessage() {
        return this.filterForm.controls['distance'].hasError('min') ? 'Not a valid number' :
            '';
    }

    filter() {
    }
}
