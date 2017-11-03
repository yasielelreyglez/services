import {Component, OnInit} from '@angular/core';
import {AuthService} from '../../_services/auth.service';
import {Router} from '@angular/router';


@Component({
    selector: 'app-menu',
    templateUrl: './menu.component.html',
    styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

    constructor(public authServices: AuthService, private router: Router) {

    }

    ngOnInit() {

    }

    isAuntenticate() {
        return this.authServices.isAutenticate();
    }

    logout(): void {
        this.authServices.logout();
        this.router.navigate(['']);
    }

}
