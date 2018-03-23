import {AppRoutes} from './app.routing';
import {AuthService} from './_services/auth.service';
import {AuthGuard} from './_guards/auth.guard';
import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {JsonpModule} from '@angular/http';
import {HttpClientModule} from '@angular/common/http';

import {AppComponent} from './app.component';
import {LoginComponent} from './components/login/login.component';
import {HomeComponent} from './components/home/home.component';
import {MenuComponent} from './components/menu/menu.component';
import {RegisterComponent} from './components/register/register.component';
import {EqualValidator} from './_directives/validate-password.directive';
import {ForgotpassComponent} from './components/_modals/forgotpass/forgotpass.component';
import {ApiService} from './_services/api.service';
import {ShowcategoriesComponent} from './components/showcategories/showcategories.component';
import {SubcategoriesComponent} from './components/subcategories/subcategories.component';
import {ShowsubcateroriesComponent} from './components/showsubcaterories/showsubcaterories.component';
import {ShowservicesComponent} from './components/showservices/showservices.component';
import {ServicesComponent} from './components/services/services.component';
import {ReportComponent} from './components/_modals/report/report.component';
import {ShowfavoritesComponent} from './components/showfavorites/showfavorites.component';
import {ShowmyservicesComponent} from './components/showmyservices/showmyservices.component';
import {ShowmysearchsComponent} from './components/showmysearchs/showmysearchs.component';
import {ShowserviceComponent} from './components/showservice/showservice.component';
import {RatingComponent} from './components/_modals/rating/rating.component';
import {WizardserviceComponent} from './components/wizardservice/wizardservice.component';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {
    MatSelectModule, MatCheckboxModule, MatToolbarModule, MatMenuModule, MatIconModule, MatButtonModule,
    MatFormFieldModule, MatInputModule, MatGridListModule, MatCardModule, MatDialogModule, MatTabsModule,
    MatStepperModule, MatSnackBarModule, MatProgressSpinnerModule
} from '@angular/material';
import {ImageComponent} from './components/_modals/image/image.component';
import { ImageZoomDirective } from './_directives/image-zoom.directive';
import { PayserviceComponent } from './components/payservice/payservice.component';
import { TimesComponent } from './components/_modals/times/times.component';
import {ReportServiceComponent} from './components/_modals/reportservice/reportservice.component';
import {ChangepasswordComponent} from './components/_modals/changepassword/changepassword.component';

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
        ShowmysearchsComponent,
        ShowserviceComponent,
        RatingComponent,
        WizardserviceComponent,
        ImageComponent,
        ImageZoomDirective,
        PayserviceComponent,
        TimesComponent,
        ReportServiceComponent,
        ChangepasswordComponent
    ],
    entryComponents: [
        ForgotpassComponent,
        ReportComponent,
        RatingComponent,
        ImageComponent,
        TimesComponent,
        ReportServiceComponent,
        ChangepasswordComponent
    ],
    imports: [
        BrowserAnimationsModule,
        BrowserModule,
        FormsModule,
        ReactiveFormsModule,
        HttpClientModule,
        JsonpModule,
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
        MatDialogModule,
        MatTabsModule,
        MatStepperModule,
        MatSnackBarModule,
        MatProgressSpinnerModule
    ],
    providers: [
        AuthGuard,
        AuthService,
        ApiService,
    ],
    bootstrap: [AppComponent]
})
export class AppModule {}
