import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { EjemploPage } from './ejemplo';

@NgModule({
  declarations: [
    EjemploPage,
  ],
  imports: [
    IonicPageModule.forChild(EjemploPage),
  ],
})
export class EjemploPageModule {}
