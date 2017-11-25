import {Routes, RouterModule} from '@angular/router';
import {AuthGuard} from './_guards/auth.guard';
import {LoginComponent} from './components/login/login.component';
import {HomeComponent} from './components/home/home.component';
import {RegisterComponent} from './components/register/register.component';
import {ShowcategoriesComponent} from './components/showcategories/showcategories.component';
import {ShowsubcateroriesComponent} from './components/showsubcaterories/showsubcaterories.component';
import {ShowservicesComponent} from './components/showservices/showservices.component';
import {ShowfavoritesComponent} from './components/showfavorites/showfavorites.component';
import {ShowmyservicesComponent} from './components/showmyservices/showmyservices.component';
import {ShowserviceComponent} from './components/showservice/showservice.component';
import {WizardserviceComponent} from './components/wizardservice/wizardservice.component';

const routes: Routes = [
    {path: '', component: HomeComponent, pathMatch: 'full'},
    {path: 'login', component: LoginComponent},
    {path: 'register', component: RegisterComponent},
    {path: 'categories', component: ShowcategoriesComponent},
    {path: 'categories/:id', component: ShowsubcateroriesComponent},
    {path: 'categories/:id/subcategories/:id', component: ShowservicesComponent},
    {path: 'search', component: ShowservicesComponent},
    {path: 'search/service/:id', component: ShowserviceComponent},
    {path: 'categories/:id/subcategories/:id/service/:id', component: ShowserviceComponent},
    {path: 'subcategories/:id', component: ShowservicesComponent},
    {path: 'subcategories/:id/service/:id', component: ShowserviceComponent},
    {path: 'myfavorites/service/:id', component: ShowserviceComponent},
    {path: 'myfavorites', component: ShowfavoritesComponent, canActivate: [AuthGuard]},
    {path: 'myservices', component: ShowmyservicesComponent, canActivate: [AuthGuard]},
    {path: 'createservice', component: WizardserviceComponent, canActivate: [AuthGuard]},


    // otherwise redirect to home
    {path: '**', redirectTo: ''}
];

export const AppRoutes = RouterModule.forRoot(routes);
