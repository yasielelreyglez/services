import {User} from './../../_models/user';
import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {MatDialog, MatSnackBar} from '@angular/material';
import {ApiService} from '../../_services/api.service';

@Component({
    selector: 'app-mensajes',
    templateUrl: './mensajes.component.html',
    styleUrls: ['./mensajes.component.css']
})
export class MensajesComponent implements OnInit {
    user: User;
    loading: boolean;
    hide = true;
    mensajes: any;

    constructor(public dialog: MatDialog, private router: Router,
                private snackBar: MatSnackBar, private apiServices: ApiService ) {
        this.user = new User();
        this.loading = false;

    }

    ngOnInit() {
        this.apiServices.mensajes().subscribe(result=>{
            this.mensajes = result;
        });
    }





}
