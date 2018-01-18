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
  @Input() showSearch: boolean = true;
  @Input() showPopover: boolean = true;
  @Input() title: string = '';

  loggedIn: boolean;
  toggled: boolean;
  searchTerm: String = '';
  items: string[];

  constructor(public popCtrl: PopoverController,public auth: AuthProvider,public viewCtrl: ViewController ) {  }
  ngOnInit() {
    this.toggled = false;
    this.initializeItems();

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

  toggleSearch() {
    this.toggled = this.toggled ? false : true;
  }

  initializeItems() {
      this.items = ['Amsterdam','Bogota','Mumbai','San José','Salvador'];
  }

  triggerInput( ev: any ) {
      // Reset items back to all of the items
      this.initializeItems();
      // set val to the value of the searchbar
      let val = ev.target.value;
      // if the value is an empty string don't filter the items
      if (val && val.trim() != '') {
        this.items = this.items.filter((item) => {
          return (item.toLowerCase().indexOf(val.toLowerCase()) > -1);
        })
      }
  }

}
