import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { GaleriaPage } from './galeria';

@NgModule({
  declarations: [
    GaleriaPage,
  ],
  imports: [
    IonicPageModule.forChild(GaleriaPage),
  ],
})
export class GaleriaPageModule {}
