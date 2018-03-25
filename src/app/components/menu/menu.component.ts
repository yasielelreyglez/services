import {Component, EventEmitter, NgZone, OnInit, Output, ViewChild} from '@angular/core';
import {AuthService} from '../../_services/auth.service';
import {Router} from '@angular/router';
import {MatDialog, MatMenuTrigger, MatSnackBar} from '@angular/material';
import {ChangepasswordComponent} from '../_modals/changepassword/changepassword.component';
import {ApiService} from '../../_services/api.service';


@Component({
    selector: 'app-menu',
    templateUrl: './menu.component.html',
    styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {
    loggedIn = false;
    query: any;
    @ViewChild(MatMenuTrigger) trigger: MatMenuTrigger;


    constructor(public dialog: MatDialog, public zone: NgZone, private apiServices: ApiService, public authServices: AuthService, private router: Router, private snackBar: MatSnackBar) {
    }

    ngOnInit() {
        this.authServices.currentUser.subscribe(user => {
            this.loggedIn = !!user;
        });
    }

    logout(): void {
        this.authServices.logout();
        this.router.navigate(['']);
        this.openSnackBar('Ha cerrado la session correctamente.', 2500);
    }

    menu() {
        this.trigger.openMenu();
    }

    openDialog(): void {
        const dialogRef = this.dialog.open(ChangepasswordComponent, {
            width: '70%',
            height: '500px'
        });

        dialogRef.afterClosed().subscribe(() => {
        });
    }

    searchQuery() {
        this.apiServices.searchService(this.query).subscribe(result => {
            localStorage.setItem('searchServices', JSON.stringify(result));
            console.log('al guardar', JSON.parse(localStorage.getItem('searchServices')));
            this.zone.run(() => {
            });
            this.router.navigate(['/search']);
        });
    }

    openSnackBar(message: string, duration: number, action?: string) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
        });
    }

}
