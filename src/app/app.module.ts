import {AppRoutes} from './app.routing';
import {AuthService} from './_services/auth.service';
import {AuthGuard} from './_guards/auth.guard';
import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {FormsModule} from '@angular/forms';
import {HttpModule, JsonpModule} from '@angular/http';

import {AppComponent} from './app.component';
import {LoginComponent} from './components/login/login.component';
import {HomeComponent} from './components/home/home.component';
import {UserService} from './_services/user.service';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import {MenuComponent} from './components/menu/menu.component';
import {RegisterComponent} from './components/register/register.component';
import {EqualValidator} from './_directives/validate-password.directive';
import {ForgotpassComponent} from './components/_modals/forgotpass/forgotpass.component';
import {ApiService} from './_services/api.service';
import {ShowcategoriesComponent} from './components/showcategories/showcategories.component';
import {SubcategoriesComponent} from './components/subcategories/subcategories.component';
import {ShowsubcateroriesComponent} from './components/showsubcaterories/showsubcaterories.component';
import {Data} from './_services/data.service';
import {ShowservicesComponent} from './components/showservices/showservices.component';
import {ServicesComponent} from './components/services/services.component';
import {ReportComponent} from './components/_modals/report/report.component';
import {ShowfavoritesComponent} from './components/showfavorites/showfavorites.component';
import {ShowmyservicesComponent} from './components/showmyservices/showmyservices.component';
import {ShowserviceComponent} from './components/showservice/showservice.component';
import {RatingComponent} from './components/_modals/rating/rating.component';
import {ArchwizardModule} from 'ng2-archwizard';
import {WizardserviceComponent} from './components/wizardservice/wizardservice.component';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {
    MatSelectModule, MatCheckboxModule, MatToolbarModule, MatMenuModule, MatIconModule, MatButtonModule,
    MatFormFieldModule, MatInputModule, MatGridListModule, MatCardModule
} from '@angular/material';

@NgModule({
    declarations: [
        AppComponent,
        HomeComponent,
        LoginComponent,
        MenuComponent,
        RegisterComponent,
        EqualValidator,
        ForgotpassComponent,
        ShowcategoriesComponent,
        SubcategoriesComponent,
        ShowsubcateroriesComponent,
        ShowservicesComponent,
        ServicesComponent,
        ReportComponent,
        ShowfavoritesComponent,
        ShowmyservicesComponent,
        ShowserviceComponent,
        RatingComponent,
        WizardserviceComponent
    ],
    entryComponents: [
        ForgotpassComponent,
        ReportComponent,
        RatingComponent
    ],
    imports: [
        BrowserAnimationsModule,
        BrowserModule,
        FormsModule,
        HttpModule,
        JsonpModule,
        ArchwizardModule,
        AppRoutes,
        MatSelectModule,
        MatCheckboxModule,
        MatToolbarModule,
        MatMenuModule,
        MatIconModule,
        MatButtonModule,
        MatFormFieldModule,
        MatInputModule,
        MatGridListModule,
        MatCardModule,
        NgbModule.forRoot()

    ],
    providers: [
        AuthGuard,
        AuthService,
        UserService,
        ApiService,
        Data
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
    basepath = "login"
}
