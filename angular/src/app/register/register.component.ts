import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router, RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-register',
  standalone: true,
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
  imports: [RouterModule, FormsModule, CommonModule]
})
export class RegisterComponent {
  name: string = '';
  surname: string = '';
  username: string = '';
  phone_number: string = '';
  gender: string = 'prefer_not_to_say';
  birthdate: string = '';
  email: string = '';
  password: string = '';
  confirmPassword: string = '';
  country: string = 'ES';
  rol: string = 'user';

  countries: string[] = [
    "TV", "BV", "GI", "GO", "JU", "UM-DQ", "UM-FQ", "UM-HQ", "UM-JQ", "UM-MQ", "UM-WQ", "BQ", "NL", "ZW", "ZM", "ZA",
    "YE", "WS", "WF", "PS", "VU", "VN", "VI", "VG", "VE", "VC", "VA", "UZ", "US", "UY", "UA", "UG", "TZ", "TW", "TR",
    "TN", "TT", "TO", "TL", "TM", "TK", "TJ", "TH", "TG", "TD", "TC", "SY", "SC", "SX", "SZ", "SE", "SI", "SK", "SR",
    "ST", "RS", "PM", "SO", "SM", "SV", "SL", "SB", "SH", "GS", "SG", "SN", "SS", "SD", "SA", "EH", "RW", "RU", "RO",
    "RE", "QA", "PF", "PY", "PT", "KP", "PR", "PL", "PG", "PW", "PH", "PE", "PN", "PA", "PK", "OM", "NZ", "SJ", "NR",
    "NP", "NO", "NU", "NI", "NG", "NF", "NE", "NC", "NA", "YT", "MY", "MW", "MU", "MQ", "MS", "MR", "MZ", "MP", "MN",
    "ME", "MM", "MT", "ML", "MK", "MH", "MX", "MV", "MG", "MD", "MC", "MA", "MF", "MO", "LV", "LU", "LT", "LS", "LK",
    "LI", "LC", "LY", "LR", "LB", "LA", "KW", "XK", "KR", "KN", "KI", "KH", "KG", "KE", "KZ", "JP", "JO", "JE", "JM",
    "IT", "IL", "IS", "IQ", "IR", "IE", "IO", "IN", "IM", "ID", "HU", "HT", "HR", "HN", "HM", "HK", "GY", "GU", "GF",
    "GT", "GL", "GD", "GR", "GQ", "GW", "GM", "GP", "GN", "GH", "GG", "GE", "GA", "FR", "FM", "FO", "FK", "FJ", "FI",
    "ET", "EE", "ES", "ER", "GB", "EG", "EC", "DZ", "DO", "DK", "DM", "DJ", "DE", "CZ", "CY", "KY", "CX", "CW", "CU",
    "CR", "CV", "KM", "CO", "CK", "CG", "CD", "CM", "CI", "CN", "CL", "CH", "CC", "CA", "CF", "BE", "BW", "BT", "BN",
    "BB", "BR", "BO", "BM", "BZ", "BY", "BL", "BS", "BH", "BA", "BG", "BD", "BF", "BJ", "BI", "AZ", "AT", "AU", "TF",
    "AQ", "AS", "AM", "AR", "AE", "AD", "AX", "AL", "AI", "AO", "AF", "AG", "AW"
  ];

  errorMessage: string = '';

  constructor(private http: HttpClient, private router: Router) { }

  validateForm(): boolean {
    if (this.password !== this.confirmPassword) {
      this.errorMessage = 'Passwords do not match';
      return false;
    }
    if (!this.phone_number) {
      this.errorMessage = 'Phone number is required';
      return false;
    }
    if (!this.name) {
      this.errorMessage = 'Name is required';
      return false;
    }
    if (!this.email) {
      this.errorMessage = 'Email is required';
      return false;
    }
    return true;
  }

  register(): void {
    this.errorMessage = '';

    if (!this.validateForm()) {
      console.error(this.errorMessage);
      return;
    }

    const user = {
      name: this.name,
      surname: this.surname,
      username: this.username,
      phone: this.phone_number,
      gender: this.gender,
      birthdate: this.birthdate,
      email: this.email,
      password: this.password,
      password_confirmation: this.confirmPassword,
      country: this.country,
      rol: this.rol,
    };
    console.log(JSON.stringify(user))
    const headers = { 'Content-Type': 'application/json' };

    this.http.post('http://localhost/api/register', JSON.stringify(user), { headers })
      .subscribe({
        next: (response) => {
          console.log('Registration successful', response);
          this.router.navigate(['/login']);
        },
        error: (err) => {
          console.error('Registration failed', err);
          this.errorMessage = 'Registration failed: ' + (err.error?.message || 'Unknown error');
        }
      });
  }
}
