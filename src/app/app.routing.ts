import {Routes, RouterModule} from '@angular/router';
import {AuthGuard} from './_guards/auth.guard';
import {LoginComponent} from './components/login/login.component';
import {HomeComponent} from './components/home/home.component';
import {RegisterComponent} from './components/register/register.component';
import {CategoriesComponent} from './components/categories/categories.component';
import {ShowsubcateroriesComponent} from './components/showsubcaterories/showsubcaterories.component';
import {ShowservicesComponent} from './components/showservices/showservices.component';

const routes: Routes = [
    {path: '', component: HomeComponent, pathMatch: 'full'},
    {path: 'login', component: LoginComponent},
    {path: 'register', component: RegisterComponent},
    {path: 'categories', component: CategoriesComponent},
    {path: 'categories/:id', component: ShowsubcateroriesComponent},
    {path: 'categories/:id/subcategories/:id', component: ShowservicesComponent},

    // otherwise redirect to home
    {path: '**', redirectTo: ''}
];

export const AppRoutes = RouterModule.forRoot(routes);
