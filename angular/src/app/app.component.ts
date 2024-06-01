import { Component, Inject, OnInit, Renderer2, PLATFORM_ID } from '@angular/core';
import { RouterModule } from '@angular/router';
import { DOCUMENT, isPlatformBrowser, CommonModule } from '@angular/common';
import { HomeComponent } from './home/home.component';
import { EditProfileComponent } from './edit-profile/edit-profile.component';
import { NavbarComponent } from './navbar/navbar.component';
import { MatBottomSheetModule } from '@angular/material/bottom-sheet'; // Importar MatBottomSheetModule
import { MatButtonModule } from '@angular/material/button'; // Importar MatButtonModule

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [
    CommonModule,
    RouterModule,
    HomeComponent,
    EditProfileComponent,
    NavbarComponent,
    MatBottomSheetModule, // Asegúrate de importar MatBottomSheetModule aquí
    MatButtonModule // Asegúrate de importar MatButtonModule aquí
  ],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  private isBrowser: boolean;

  constructor(
    @Inject(DOCUMENT) private document: Document,
    @Inject(PLATFORM_ID) private platformId: Object,
    private renderer: Renderer2
  ) {
    this.isBrowser = isPlatformBrowser(platformId);
  }

  ngOnInit(): void {
    if (this.isBrowser) {
      this.checkSize();
      this.renderer.listen('window', 'resize', () => this.checkSize());
    }
  }

  checkSize() {
    const iconApp = this.document.getElementById("divAppNavBar") as HTMLElement;
    const newWorkout = this.document.getElementById("newWorkout") as HTMLElement;
    if (window.innerWidth < 1440) {
      newWorkout.innerHTML = "<i class='fa-solid fa-plus'></i>";
      iconApp.innerHTML = '<img src="../../assets/icons/logoBlancoNavBar.png" alt="Logo" class="d-inline-block align-top imagenAppNavBar" style="width: 45px; height: 35px; margin-left: 144px; margin-top: 5px; margin-bottom: -10px;">';
    } else {
      newWorkout.innerHTML = "Nuevo entrenamiento";
      iconApp.innerHTML = '<h1 style="font-family: Dancing Script; padding-left: 0px; font-size: 42px; margin-bottom: -2px">FitTracker</h1>';
    }
  }
}
