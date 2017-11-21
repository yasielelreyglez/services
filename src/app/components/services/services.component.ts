import {Component, OnInit, Input} from '@angular/core';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {ReportComponent} from '../_modals/report/report.component';

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
    constructor(private modalService: NgbModal) {
    }

    ngOnInit() {
    }

    open() {
        const modalRef = this.modalService.open(ReportComponent);
    }

    markFavorite(id){

    }

}
