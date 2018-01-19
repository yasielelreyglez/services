import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from "ionic-angular";
import { SplashScreen } from '@ionic-native/splash-screen';
import { StatusBar } from '@ionic-native/status-bar';
import { HttpModule } from '@angular/http';
import {HttpClientModule} from '@angular/common/http';

import { MyApp } from './app.component';
//paginas
import { HomePage } from '../pages/home/home';
import { PopoverPage } from '../pages/pop-over/pop-over';
import { CategoriesPage } from '../pages/categories/categories';
import { SubcategoriesPage } from '../pages/subcategories/subcategories';
import { ServicesPage } from '../pages/services/services';
// import { LoginPage  } from '../pages/login/login';
// import { SignupPage  } from '../pages/signup/signup';
import { FavoritesPage  } from '../pages/favorites/favorites';
import { BusquedaPage  } from '../pages/busqueda/busqueda';
import { MyservicesPage  } from '../pages/myservices/myservices';
import { ServicePage  } from '../pages/service/service';
import { RatePage } from "../pages/rate/rate";
import { InfoPage } from "../pages/info/info";
import { MapaPage } from "../pages/mapa/mapa";
import { GaleriaPage } from "../pages/galeria/galeria";
import { ComentariosPage } from "../pages/comentarios/comentarios";
import { Create1Page } from "../pages/create1/create1";
import { Create2Page } from "../pages/create2/create2";
import {  TabPage} from "../pages/tab/tab";
import {  TabMapaPage} from "../pages/tab-mapa/tab-mapa";


// Componentes
import {AppHeaderComponent} from '../components/app-header/app-header';
import { IonRating } from '../components/ion-rating/ion-rating';
import { ServUpInfoComponent } from '../components/serv-up-info/serv-up-info';

//Servicios
import { SubCategoryProvider } from '../providers/sub-category/sub-category';
import { CategoryProvider } from '../providers/category/category.service';
import { ServiceProvider } from '../providers/service/service.service';
import { AuthProvider } from '../providers/auth/auth';
import { ApiProvider } from '../providers/api/api';

// native
import { Keyboard } from '@ionic-native/keyboard';
import { File } from '@ionic-native/file';
import { Camera } from '@ionic-native/camera';
import { CallNumber } from "@ionic-native/call-number";
import { Geolocation } from '@ionic-native/geolocation';
import { PhotoViewer } from '@ionic-native/photo-viewer';
import { Create3Page } from '../pages/create3/create3';
import { Create4Page } from '../pages/create4/create4';
import { PagarPage } from '../pages/pagar/pagar';
import { FiltroModalPage } from '../pages/filtro-modal/filtro-modal';
import { ModalDenunciaPage } from '../pages/modal-denuncia/modal-denuncia';
import { ChangePassPage } from '../pages/change-pass/change-pass';


@NgModule({
  declarations: [
    MyApp,
    TabPage,
    HomePage,
    PopoverPage,
    CategoriesPage,
    SubcategoriesPage,
    AppHeaderComponent,
    IonRating,
    ServUpInfoComponent,
    ServicesPage,
    // LoginPage,
    // SignupPage,
    FiltroModalPage,
    FavoritesPage,
    BusquedaPage,
    MyservicesPage,
    ServicePage,
    RatePage,
    InfoPage,
    MapaPage,
    GaleriaPage,
    ComentariosPage,
    Create1Page,
    Create2Page,
    Create3Page,
    Create4Page,
    PagarPage,
    TabMapaPage,
    ModalDenunciaPage,
    ChangePassPage

  ],
  imports: [
    BrowserModule,
    HttpModule,
    HttpClientModule,
    IonicModule.forRoot(MyApp,{
      scrollPadding: false,
      scrollAssist: true, //estaba true
      // autoFocusAssist: false
      // Tabs config
      tabsHideOnSubPages: true,
    })
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    TabPage,
    HomePage,
    PopoverPage,
    CategoriesPage,
    SubcategoriesPage,
    AppHeaderComponent,
    IonRating,
    ServUpInfoComponent,
    ServicesPage,
    FiltroModalPage,
    // LoginPage,
    // SignupPage,
    FavoritesPage,
    BusquedaPage,
    MyservicesPage,
     ServicePage,
    RatePage,
    InfoPage,
    MapaPage,
    GaleriaPage,
    ComentariosPage,
    Create1Page,
    Create2Page,
    Create3Page,
    Create4Page,
    PagarPage,
    TabMapaPage,
    ModalDenunciaPage,
    ChangePassPage

  ],
  providers: [
    StatusBar,
    SplashScreen,

    File,
    Camera,
    CallNumber,
    Keyboard,
    Geolocation,
    PhotoViewer,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    SubCategoryProvider,
    CategoryProvider,
    ServiceProvider,
    AuthProvider,
    ApiProvider

    ]
})
export class AppModule {}
