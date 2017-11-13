import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {ApiService} from '../../_services/api.service';
import {Data} from '../../_services/data.service';

@Component({
    selector: 'app-showservice',
    templateUrl: './showservice.component.html',
    styleUrls: ['./showservice.component.css']
})
export class ShowserviceComponent implements OnInit {
    // service = {
    //     'address': 'calle stret entre left and right numero #',
    //     'email': 'correo@gmail.com',
    //     'subtitle': 'subtitulo servicio1',
    //     'phone': '231450',
    //     'start_time': '08:00',
    //     'end_time': '15:30',
    //     'title': 'Servicio1',
    //     'url': 'http://url.com',
    //     'visits': 1,
    //     'other_phone': '989796'
    // };
    service: any;

    constructor(private route: ActivatedRoute, private apiServices: ApiService, private data: Data) {
    }

    ngOnInit() {
        this.route.params.subscribe(params => {
            const id = params['id'];
            this.apiServices.service(id).subscribe(result => this.service = result);
        });
        // this.data.storage = this.service;
    }
}
