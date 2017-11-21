import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { MyservicesPage } from './myservices';

@NgModule({
  declarations: [
    MyservicesPage,
  ],
  imports: [
    IonicPageModule.forChild(MyservicesPage),
  ],
})
export class MyservicesPageModule {}
