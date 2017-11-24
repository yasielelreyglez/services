import {Component, OnInit, Input} from '@angular/core';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {ApiService} from '../../_services/api.service';
import {ReportComponent} from '../_modals/report/report.component';
import {AuthService} from '../../_services/auth.service';

@Component({
    selector: 'app-services',
    templateUrl: './services.component.html',
    styleUrls: ['./services.component.css']
})
export class ServicesComponent implements OnInit {
    @Input() services: any;
    @Input() favorites?: boolean;
    @Input() myservices?: boolean;
    valor = 2;
    loggedIn = false;

    constructor(private modalService: NgbModal, private apiServices: ApiService, private authServices: AuthService) {
    }

    ngOnInit() {
        this.authServices.currentUser.subscribe(user => {
            this.loggedIn = !!user;
        });
    }

    open() {
        const modalRef = this.modalService.open(ReportComponent);
    }

    markFavorite(id, state, pos) {
        console.log(id);
        let results: any;
        if (state === 1) {
            this.apiServices.disMarkfavorite(id).subscribe(result => results = result);
            this.services[pos].favorite = 0;
        } else {
            this.apiServices.markfavorite(id).subscribe(result => results = result);
            this.services[pos].favorite = 1;
        }
    }

}
