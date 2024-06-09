import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router, RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-forgot-password',
  standalone: true,
  templateUrl: './forgot-password.component.html',
  styleUrls: ['./forgot-password.component.css'],
  imports: [FormsModule, CommonModule, RouterModule]
})
export class ForgotPasswordComponent {
  email: string = '';

  constructor(private http: HttpClient, private router: Router) {}

  sendResetLink(): void {
    const headers = { 'Content-Type': 'application/json' };
    const body = JSON.stringify({ email: this.email });

    this.http.post('http://localhost/api/forgot-password', body, { headers })
      .subscribe({
        next: (response) => {
          console.log('Reset link sent', response);
          this.router.navigate(['/login']);
        },
        error: (err) => {
          console.error('Failed to send reset link', err);
        }
      });
  }
}
