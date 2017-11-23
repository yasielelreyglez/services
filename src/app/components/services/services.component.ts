import {Component, OnInit, Input} from '@angular/core';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {ApiService} from '../../_services/api.service';
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
    constructor(private modalService: NgbModal,private apiServices: ApiService) {
    }

    ngOnInit() {
    }

    open() {
        const modalRef = this.modalService.open(ReportComponent);
    }

    markFavorite(id,state,pos){
        console.log(id);
        var results:any;
        if(state==1) {
            this.apiServices.disMarkfavorite(id).subscribe(result => results = result);
            this.services[pos].favorite = 0;
        }else{
            this.apiServices.markfavorite(id).subscribe(result =>  results =  result);
            this.services[pos].favorite = 1;
        }

        console.log(results);
    }

}
