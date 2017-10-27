import { Component, OnInit } from '@angular/core';
import { UserService } from "../../_services/user.service";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
    result_test:string = "primerdato";
  constructor(private user:UserService) {

  }

  ngOnInit() {
  }

  clickTest(){
   let test =  this.user.getTest().subscribe(dato => {
      console.log(dato);
       this.result_test = dato.username;
       return dato;
      });
   console.log(test)

  }

}
