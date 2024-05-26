// src/app/services/auth.service.ts
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private tokenKey = 'authToken';

  constructor(private router: Router) { }

  login(token: string): void {
    sessionStorage.setItem(this.tokenKey, token);
  }

  logout(): void {
    sessionStorage.removeItem(this.tokenKey);
    this.router.navigate(['/login']);
  }

  getToken(): string | null {
    return sessionStorage.getItem(this.tokenKey);
  }

  isAuthenticated(): boolean {
    return this.getToken() !== null;
  }
}
