// src/main.ts
import { bootstrapApplication } from '@angular/platform-browser';
import { AppComponent } from './app/app.component';
import { importProvidersFrom } from '@angular/core';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { authInterceptorProvider } from './app/interceptors/auth-interceptor.service';
import { RouterModule } from '@angular/router';
import { routes } from './app/app.routes';
import { FormsModule } from '@angular/forms';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { provideAnimationsAsync } from '@angular/platform-browser/animations/async';

bootstrapApplication(AppComponent, {
  providers: [
    importProvidersFrom(RouterModule.forRoot(routes)),
    importProvidersFrom(HttpClientModule),
    importProvidersFrom(FormsModule),
    importProvidersFrom(NgbModule),
    authInterceptorProvider, provideAnimationsAsync()
  ]
}).catch(err => console.error(err));