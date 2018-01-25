import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { ModalHorarioPage } from './modal-horario';

@NgModule({
  declarations: [
    ModalHorarioPage,
  ],
  imports: [
    IonicPageModule.forChild(ModalHorarioPage),
  ],
})
export class ModalHorarioPageModule {}
