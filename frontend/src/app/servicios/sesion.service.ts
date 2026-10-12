import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable, map, tap } from 'rxjs';

export interface Sesion {
  token: string;
  usuario: string;
  rol: string;
}

const CLAVE = 'sesion';

@Injectable({
  providedIn: 'root'
})
export class SesionService {
  private sesionSubject = new BehaviorSubject<Sesion | null>(this.leerGuardada());
  readonly sesion$ = this.sesionSubject.asObservable();

  constructor(private http: HttpClient) {}

  get token(): string | null {
    return this.sesionSubject.value?.token ?? null;
  }

  entrar(email: string, password: string): Observable<Sesion> {
    return this.http.post<{ token: string }>('/api/token/', { username: email, password }).pipe(
      map(respuesta => ({ token: respuesta.token, usuario: email, rol: 'autor' })),
      tap(sesion => {
        sessionStorage.setItem(CLAVE, JSON.stringify(sesion));
        this.sesionSubject.next(sesion);
      })
    );
  }

  yo(): Observable<{ id: number; nombre: string; rol: string }> {
    return this.http.get<{ id: number; nombre: string; rol: string }>('/api/yo/');
  }

  salir(): void {
    sessionStorage.removeItem(CLAVE);
    this.sesionSubject.next(null);
  }

  private leerGuardada(): Sesion | null {
    const guardada = sessionStorage.getItem(CLAVE);
    return guardada ? JSON.parse(guardada) : null;
  }
}
