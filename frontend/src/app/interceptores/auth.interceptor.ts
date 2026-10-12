import { Injectable } from '@angular/core';
import {
  HttpEvent,
  HttpHandler,
  HttpInterceptor,
  HttpRequest
} from '@angular/common/http';
import { Observable } from 'rxjs';

import { SesionService } from '../servicios/sesion.service';

@Injectable()
export class AuthInterceptor implements HttpInterceptor {
  constructor(private sesion: SesionService) {}

  intercept(request: HttpRequest<unknown>, next: HttpHandler): Observable<HttpEvent<unknown>> {
    const token = this.sesion.token;

    if (token && !request.url.includes('/api/token')) {
      const clon = request.clone({
        setHeaders: {
          Authorization: `Token ${token}`
        }
      });
      return next.handle(clon);
    }

    return next.handle(request);
  }
}
