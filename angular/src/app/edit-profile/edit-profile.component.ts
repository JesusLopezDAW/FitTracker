import { Component } from '@angular/core';
import { Router } from '@angular/router';


@Component({
  selector: 'app-edit-profile',
  standalone: true,
  imports: [],
  templateUrl: './edit-profile.component.html',
  styleUrl: './edit-profile.component.css'
})
export class EditProfileComponent {

  constructor(private router: Router) { }

  async logout() {
    const token = sessionStorage.getItem("authToken")

    let headersList = {
      "Accept": "*/*",
      "Content-Type": "application/json",
      "Authorization": `Bearer ${token}`
    }

    let response = await fetch("http://localhost/api/logout", {
      method: "POST",
      headers: headersList,
      credentials: 'include'
    });

    let data = await response.json();
    if (response.ok) {
      const data = await response.json();
      sessionStorage.removeItem("authToken");  // Remover el token después de hacer logout
      this.router.navigate(['/login']);  // Redirigir al usuario a la página de inicio de sesión
    } else {
      console.error('Logout failed', response.statusText);
    }
  }
}
