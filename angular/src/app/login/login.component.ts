// src/app/login/login.component.ts
import { Component } from '@angular/core';
import { Router, RouterModule } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { HttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-login',
  standalone: true,
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
  imports: [RouterModule, CommonModule, FormsModule]
})
export class LoginComponent {
  email: string = '';
  password: string = '';

  constructor(private authService: AuthService, private router: Router, private http: HttpClient) { }

  acceder(): void {
    const headers = { 'Content-Type': 'application/json' };
    const body = JSON.stringify({ email: this.email, password: this.password });

    this.http.post<{ access_token: string }>('http://localhost/api/login', body, { headers })
      .subscribe({
        next: (response) => {
          if (response.access_token) {
            this.authService.login(response.access_token);
            this.router.navigate(['/']);
          }
        },
        error: (err) => {
          console.error('Login failed', err);
        }
      });
  }
}
