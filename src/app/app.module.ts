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


@NgModule({
    declarations: [
        AppComponent,
        HomeComponent,
        LoginComponent
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
