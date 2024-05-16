import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  constructor(private http: HttpClient) {}

  login(username: string, password: string) {
    // Lógica para enviar la solicitud de inicio de sesión al servidor
  }

  logout() {
    // Lógica para cerrar la sesión del usuario
  }

  register(user: any) {
    // Lógica para registrar un nuevo usuario
  }

  isLoggedIn() {
    // Lógica para verificar si el usuario está autenticado
  }
}
