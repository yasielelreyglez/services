import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { FiltroModalPage } from './filtro-modal';

@NgModule({
  declarations: [
    FiltroModalPage,
  ],
  imports: [
    IonicPageModule.forChild(FiltroModalPage),
  ],
})
export class FiltroModalPageModule {}
