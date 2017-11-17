import {Component, OnInit} from '@angular/core';
import {User } from '../../_models/user';


@Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.css'],
})
export class RegisterComponent implements OnInit {
    user: User;
    loading: boolean;
    error: string;

    constructor() {
        this.user = new User();
        this.loading = false;
        this.error = '';
    }

    ngOnInit() {
    }

    register() {
        return true;
    }
}
