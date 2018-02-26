import {Component, OnInit, Input, Output, EventEmitter,AfterContentInit} from '@angular/core';
import {PopoverPage} from '../../pages/pop-over/pop-over'
import {PopoverController, ViewController} from 'ionic-angular';
import {AuthProvider} from '../../providers/auth/auth';

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
export class AppHeaderComponent implements OnInit ,AfterContentInit{


  @Input() show: boolean = true;
  @Input() showSearch: boolean = true;
  @Input() showPopover: boolean = true;
  @Input() showInput: boolean = true;
  @Input('entrada')
  entrada :string ="";
  @Output() searchValue: EventEmitter<string> = new EventEmitter<string>();

  loggedIn: boolean;
  toggled: boolean;
  searchTerm: any;
  items: string[];

  constructor(public popCtrl: PopoverController, public auth: AuthProvider, public viewCtrl: ViewController) {
  }

  ngOnInit() {
    this.toggled = false;
    this.auth.currentUser.subscribe(user => {
      this.loggedIn = user;
    });
  }
  ngAfterContentInit() {
    this.searchTerm = this.entrada;
  }


  presentPopover(ev) {
    let popover = this.popCtrl.create(PopoverPage, {login: this.loggedIn, denuncia: false});
    popover.present({
      ev: ev,
    });
  }

  toggleSearch() {
    this.toggled = !this.toggled;
    if (!this.toggled) {
      this.searchValue.emit(null);
    }
  }

  onCancel(e) {
    this.searchValue.emit(null);
  }

  onInput(e) {
    if (this.searchTerm == "") {
      this.searchValue.emit(this.searchTerm);
    }
  }

  goSearch(keyCode) {
    if (keyCode === 13) {
      this.searchValue.emit(this.searchTerm);
    }
  }

  buscar() {
    this.searchValue.emit(this.searchTerm);
  }

  triggerInput(ev: any) {
    this.searchValue.emit(this.searchTerm);
  }


}
