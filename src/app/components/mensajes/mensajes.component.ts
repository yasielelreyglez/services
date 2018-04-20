import {User} from './../../_models/user';
import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {MatDialog, MatSnackBar} from '@angular/material';
import {ApiService} from '../../_services/api.service';
import {Globals} from '../../_models/globals';

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
                private snackBar: MatSnackBar, private apiServices: ApiService, private globals: Globals) {
        this.user = new User();
        this.loading = false;

    }

    ngOnInit() {
        this.apiServices.mensajes().subscribe(result => {
            this.mensajes = result;
        });
    }

    leermensaje(id: number) {
        this.apiServices.leermensaje(id).subscribe(result => {
            if (result['data']) {
                this.mensajes = result['data'];
                this.apiServices.mensajesNoleidos().subscribe(response => {
                    if (response['data']) {
                        if (response['data'].length > 0) {
                            this.globals.mensajes.next(true);
                        }
                        else {
                            this.globals.mensajes.next(false);
                        }
                    }
                    else {
                        this.openSnackBar(response['error'], 2500);
                    }
                });
            }
            else {
                this.openSnackBar(result['error'], 2500);
            }
        });
    }

    borrarmensaje(id: number) {
        this.apiServices.borrarmensaje(id).subscribe(result => {
            if (result['data']) {
                this.mensajes = result['data'];
                this.apiServices.mensajesNoleidos().subscribe(response => {
                    if (response['data']) {
                        if (response['data'].length > 0) {
                            this.globals.mensajes.next(true);
                        }
                        else {
                            this.globals.mensajes.next(false);
                        }
                    }
                    else {
                        this.openSnackBar(response['error'], 2500);
                    }
                });
            }
            else {
                this.openSnackBar(result['error'], 2500);
            }
        });
    }

    openSnackBar(message: string, duration: number, action ?: string) {
        this.snackBar.open(message, action, {
            duration: duration,
            horizontalPosition: 'center',
        });
    }


}
