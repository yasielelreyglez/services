import {Component, NgZone, OnInit, ViewChild} from '@angular/core';
import {AuthService} from '../../_services/auth.service';
import {Router} from '@angular/router';
import {MatDialog, MatSnackBar} from '@angular/material';
import {ChangepasswordComponent} from '../_modals/changepassword/changepassword.component';
import {ApiService} from '../../_services/api.service';
import {Globals} from '../../_models/globals';


@Component({
    selector: 'app-menu',
    templateUrl: './menu.component.html',
    styleUrls: ['./menu.component.css']
})

export class MenuComponent implements OnInit {
    loggedIn = false;
    query: any;

    constructor(public dialog: MatDialog, private globals: Globals, private apiServices: ApiService, public authServices: AuthService, private router: Router, private snackBar: MatSnackBar) {
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
            this.globals.search.next(true);
            localStorage.setItem('searchParams', JSON.stringify({selectCit: [], selectSub: [], selectDis: []}));
            // this.zone.run(() => {
            // });
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
