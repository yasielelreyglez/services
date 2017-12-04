import { NgModule } from '@angular/core';
import { AppHeaderComponent } from './app-header/app-header';
import { IonRating } from './ion-rating/ion-rating';
import { ServUpInfoComponent } from './serv-up-info/serv-up-info';
@NgModule({
	declarations: [AppHeaderComponent,IonRating,
    ServUpInfoComponent],
	imports: [],
	exports: [AppHeaderComponent,IonRating,
    ServUpInfoComponent]
})
export class ComponentsModule {}
