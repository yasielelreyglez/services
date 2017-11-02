import {AppRoutes} from './app.routing';
import {AuthService} from './_services/auth.service';
import {AuthGuard} from './_guards/auth.guard';
import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {FormsModule, NgModel} from '@angular/forms';
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



@NgModule({
    declarations: [
        AppComponent,
        HomeComponent,
        LoginComponent,
        MenuComponent,
        RegisterComponent,
        EqualValidator,
        ForgotpassComponent,
    ],
    entryComponents: [
        ForgotpassComponent
    ],
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        JsonpModule,
        AppRoutes,
        NgbModule.forRoot()
    ],
    providers: [
        AuthGuard,
        AuthService,
        UserService
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}
