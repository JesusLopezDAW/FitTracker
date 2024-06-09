import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { CommonModule } from '@angular/common';


@Component({
  selector: 'app-edit-profile',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './edit-profile.component.html',
  styleUrl: './edit-profile.component.css'
})
export class EditProfileComponent {

  name: string = '';
  surname: string = '';
  username: string = '';
  email: string = '';
  password: string = '';
  profile_photo_path?: string = '';

  constructor(private router: Router, private authService: AuthService) { }

  ngOnInit(): void {
    this.me();

  }

  async logout() {
    this.authService.logout();
  }

  async me() {
    let headersList = {
      "Accept": "*/*",
      "Content-Type": "application/json",
      "Authorization": "Bearer" + sessionStorage.getItem("authToken")
    }

    let response = await fetch("http://localhost/api/me", {
      method: "GET",
      headers: headersList
    });

    let data = await response.json();
    console.log(data);
    this.profile_photo_path = data.profile_photo_path;

  }
}
