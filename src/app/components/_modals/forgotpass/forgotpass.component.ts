import {Component} from '@angular/core';
import {NgbActiveModal} from '@ng-bootstrap/ng-bootstrap';
import {AuthService} from '../../../_services/auth.service';

@Component({
    selector: 'app-forgotpass',
    templateUrl: './forgotpass.component.html',
    styleUrls: ['./forgotpass.component.css']
})
export class ForgotpassComponent {
    model: any;
    loading: boolean;
    error: string;

    constructor(public activeModal: NgbActiveModal, private authService: AuthService) {
        this.model = {};
        this.loading = false;
        this.error = '';
    }

    enviar() {
        this.loading = true;
        this.authService.forgotPassword(this.model.email).subscribe(result => {
            if (result === true) {
                this.activeModal.close();
            }
            else {
                this.error = result.error;
                this.loading = false;
            }
        });
    }
}
