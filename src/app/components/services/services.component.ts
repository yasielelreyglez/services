import {Component, OnInit, Input} from '@angular/core';
import {ApiService} from '../../_services/api.service';
import {ReportComponent} from '../_modals/report/report.component';
import {AuthService} from '../../_services/auth.service';
import {MatDialog} from '@angular/material';

@Component({
    selector: 'app-services',
    templateUrl: './services.component.html',
    styleUrls: ['./services.component.css']
})
export class ServicesComponent implements OnInit {
    @Input() services: any;
    @Input() myfavorites?: boolean;
    @Input() myservices?: boolean;
    valor = 2;
    loggedIn = false;

    constructor(public dialog: MatDialog, private apiServices: ApiService, private authServices: AuthService) {
    }

    ngOnInit() {
        this.authServices.currentUser.subscribe(user => {
            this.loggedIn = !!user;
        });
    }

    openDialog(): void {
        let dialogRef = this.dialog.open(ReportComponent, {
            width: '70%',
        });

        dialogRef.afterClosed().subscribe(() => {
            console.log('The dialog was closed');
        });
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
