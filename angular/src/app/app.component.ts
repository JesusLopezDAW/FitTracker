import { Component, Inject, OnInit } from '@angular/core';
import { RouterModule } from '@angular/router';
import { NavbarComponent } from './navbar/navbar.component';
import { DOCUMENT } from '@angular/common';
import { HomeComponent } from './home/home.component';
import { EditProfileComponent } from './edit-profile/edit-profile.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterModule, NavbarComponent, HomeComponent, EditProfileComponent],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  constructor(@Inject(DOCUMENT) private document: Document) { }

  ngOnInit(): void {
    // Adjuntar un controlador de eventos al evento de redimensionamiento de la ventana
    // window.addEventListener('resize', () => {
    //   this.checkSize();
    // });

    // this.checkSize();
  }

  checkSize() {
    const iconApp = this.document.getElementById("divAppNavBar") as HTMLElement;
    if (window.innerWidth < 1440) {
      iconApp.innerHTML = '<img src="../../assets/icons/logoBlancoNavBar.png" alt="Logo" class="d-inline-block align-top imagenAppNavBar" style="width: 45px; height: 35px; margin-left: 144px; margin-top: 10px; margin-bottom: 11px;">';
    } else {
      iconApp.innerHTML = '<h1 style="font-family: Dancing Script; padding-left: 0px;">FitTracker</h1>';
    }
  }
}
