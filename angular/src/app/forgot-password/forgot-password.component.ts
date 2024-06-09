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

  constructor(private http: HttpClient, private router: Router) { }

  async sendResetLink(): Promise<void> {

    let headersList = {
      "Accept": "*/*",
      "Content-Type": "application/json"
    }

    let bodyContent = JSON.stringify({
      "email": this.email
    });

    let response = await fetch("http://localhost/api/send-password-reset-email", {
      method: "POST",
      body: bodyContent,
      headers: headersList
    });

    let data = await response.json();
    console.log(data);
    console.log('Reset link sent', response);
    this.router.navigate(['/login']);
  }
}
