import { Component ,OnInit,Input} from '@angular/core';
import {PopoverPage} from  '../../pages/pop-over/pop-over'
import { PopoverController, ViewController} from 'ionic-angular';
import  {AuthProvider} from  '../../providers/auth/auth';

/**
 * Generated class for the AppHeaderComponent component.
 *
 * See https://angular.io/api/core/Component for more info on Angular
 * Components.
 */
@Component({
  selector: 'app-header',
  templateUrl: 'app-header.html'
})
export class AppHeaderComponent implements OnInit {
  @Input() show: boolean = true;
  loggedIn: boolean;
  constructor(public popCtrl: PopoverController,public auth: AuthProvider,public viewCtrl: ViewController ) {  }
  ngOnInit() {
    this.auth.currentUser.subscribe(user=>{
      this.loggedIn = !!user;
     });

  }
  presentPopover(ev) {
    let popover = this.popCtrl.create(PopoverPage,{login:this.loggedIn,vista:this.viewCtrl});
    popover.present({
      ev: ev,
    });
  }

}
