import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { ModalDenunciaPage } from './modal-denuncia';

@NgModule({
  declarations: [
    ModalDenunciaPage,
  ],
  imports: [
    IonicPageModule.forChild(ModalDenunciaPage),
  ],
})
export class ModalDenunciaPageModule {}
