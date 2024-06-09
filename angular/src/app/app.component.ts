import { Component, Inject, OnInit, Renderer2, PLATFORM_ID } from '@angular/core';
import { NavigationEnd, RouterModule, Router } from '@angular/router';
import { DOCUMENT, isPlatformBrowser, CommonModule } from '@angular/common';
import { HomeComponent } from './home/home.component';
import { EditProfileComponent } from './edit-profile/edit-profile.component';
import { NavbarComponent } from './navbar/navbar.component';
import { MatBottomSheetModule } from '@angular/material/bottom-sheet';
import { MatButtonModule } from '@angular/material/button';
import { AuthService } from './services/auth.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [
    CommonModule,
    RouterModule,
    HomeComponent,
    EditProfileComponent,
    NavbarComponent,
    MatBottomSheetModule,
    MatButtonModule
  ],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  private isBrowser: boolean;
  isLoggedIn = true;
  public mostrarMenu = false;

  constructor(
    @Inject(DOCUMENT) private document: Document,
    @Inject(PLATFORM_ID) private platformId: Object,
    private renderer: Renderer2,
    private authService: AuthService,
    private router: Router
  ) {
    this.isBrowser = isPlatformBrowser(platformId);
    this.router.events.subscribe(event => {
      if (event instanceof NavigationEnd) {
        this.isLoggedIn = this.authService.isAuthenticated();
        console.log(this.authService.isAuthenticated());
      }

    });
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

  receberMostraMenu(mostraMenuLogin: boolean) {
    console.log('mostraMenuLogin', mostraMenuLogin);
    this.mostrarMenu = mostraMenuLogin;
  }
}
