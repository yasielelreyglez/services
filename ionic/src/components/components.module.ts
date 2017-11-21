import { NgModule } from '@angular/core';
import { AppHeaderComponent } from './app-header/app-header';
import { IonRating } from './ion-rating/ion-rating';
@NgModule({
	declarations: [AppHeaderComponent,IonRating],
	imports: [],
	exports: [AppHeaderComponent,IonRating]
})
export class ComponentsModule {}
