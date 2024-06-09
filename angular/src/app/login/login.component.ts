// src/app/login/login.component.ts
import { Component, Output, EventEmitter } from '@angular/core';
import { Router, RouterModule } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { HttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';
import { FormGroup, FormsModule } from '@angular/forms';
import { RecaptchaModule } from "ng-recaptcha";

@Component({
  selector: 'app-login',
  standalone: true,
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
  imports: [RouterModule, CommonModule, FormsModule, RecaptchaModule]
})
export class LoginComponent {

  email: string = '';
  password: string = '';
  loginError: boolean = false;
  siteKey = "6Le6kvQpAAAAABqF0Iofus06YKnwetqlqKjB82Lk";
  captchaCompleted = false;
  errorLog = '';


  constructor(private authService: AuthService, private router: Router, private http: HttpClient) { }

  resolved(captchaResponse: string | null) {
    this.captchaCompleted = true;
  }

  acceder(): void {
    const headers = { 'Content-Type': 'application/json' };
    const body = JSON.stringify({ email: this.email, password: this.password });
    if (this.captchaCompleted) {
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
            this.loginError = true;
            this.errorLog = 'El email o la contraseña no son correctos'
          }
        });
    }else{
      this.loginError = true;
      this.errorLog = 'COMPLETA EL CAPTCHA'
    }

  }
}