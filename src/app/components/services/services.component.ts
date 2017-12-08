import {Component, OnInit, Input} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {ReportComponent} from '../_modals/report/report.component';
import {AuthService} from '../../_services/auth.service';
import {MatDialog} from '@angular/material';
import {isNull} from 'util';
import {Data} from '../../_services/data.service';

@Component({
    selector: 'app-services',
    templateUrl: './services.component.html',
    styleUrls: ['./services.component.css']
})
export class ServicesComponent implements OnInit {
    @Input() services: any;
    @Input() myfavorites?: boolean;
    @Input() myservices?: boolean;
    @Input() mysearch?: boolean;

    loggedIn = false;
    citiesList: string;

    constructor(public dialog: MatDialog, private apiServices: ApiService, private authServices: AuthService,
                private data: Data) {

    }

    ngOnInit() {
        this.authServices.currentUser.subscribe(user => {
            this.loggedIn = !!user;
        });
    }

    openDialog(id): void {
        const dialogRef = this.dialog.open(ReportComponent, {
            width: '70%',
            data: {id: id}
        });

        dialogRef.afterClosed().subscribe(() => {
            console.log('The dialog was closed');
        });
    }

    delete(id) {
        this.apiServices.deleteService(id).subscribe(result => {
            this.services = this.services.filter(service => service.id !== id);
        });
    }

    result_cities(service: any) {
        if (!isNull(service.citiesList)) {
            let result = '';
            for (let city of service.citiesList) {
                result += city.title + ', ';
            }
            return result.substring(0, (result.length - 2));
        }
        return '';
    }

    result_subcategories(service: any) {
        if (!isNull(service.subcategoriesList)) {
            let result = '';
            for (let city of service.subcategoriesList) {
                result += city.title + ', ';
            }
            return result.substring(0, (result.length - 2));
        }
        return '';
    }

    markFavorite(id, state, pos) {
        let results: any;
        if (state === 1) {
            this.apiServices.disMarkfavorite(id).subscribe(() => {
                this.services[pos].favorite = 0;
                if (this.myfavorites)
                    this.services = this.services.filter(service => service.id !== id);
            });
        } else {
            this.apiServices.markfavorite(id).subscribe(result => results = result);
            this.services[pos].favorite = 1;
        }
    }

}
