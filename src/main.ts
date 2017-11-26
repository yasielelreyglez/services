import { enableProdMode } from '@angular/core';
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';

import { AppModule } from './app/app.module';
import { environment } from './environments/environment';

import 'hammerjs';

if (environment.production) {
  enableProdMode();
}
var basepath = 'login/';
platformBrowserDynamic().bootstrapModule(AppModule)
  .catch(err => console.log(err));
