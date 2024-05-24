import { Component, Renderer2, Inject, PLATFORM_ID } from '@angular/core';
import { CommonModule, DOCUMENT, isPlatformBrowser } from '@angular/common';
import { NavigationEnd, Router, RouterModule } from '@angular/router';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent {
  users: any[] = []; // Define una matriz para almacenar los usuarios
  showSettingsOptions = false;
  showThemeSettings = false;
  isSearchActive = false;
  currentTheme: string = 'oscuro';
  isInputFocused = false;
  private isBrowser: boolean;
  currentSection: string = '';

  constructor(
    private renderer: Renderer2,
    @Inject(DOCUMENT) private document: Document,
    private router: Router,
    @Inject(PLATFORM_ID) private platformId: Object
  ) {
    this.isBrowser = isPlatformBrowser(platformId);
    this.router.events.subscribe(event => {
      if (event instanceof NavigationEnd) {
        this.updateCurrentSection(event.urlAfterRedirects);
      }
    });
    this.document.addEventListener('click', (event) => {
      const searchComponent = (event.target as HTMLElement).closest('.search-component');
      const iconComponent = (event.target as HTMLElement).closest('.buscador-icon');
      if (searchComponent === null && this.isSearchActive && iconComponent === null) {
        this.toggleSearch();
      }

      const themeComponent = (event.target as HTMLElement).closest('.theme-settings');
      const cambiarAspectoComponent = (event.target as HTMLElement).closest('.cambiarAspecto');
      if (this.showThemeSettings && themeComponent === null && cambiarAspectoComponent === null) {
        this.toggleThemeSettings();
      }

      const settingsComponent = (event.target as HTMLElement).closest('.settings-menu');
      const settingsIconComponent = (event.target as HTMLElement).closest('.settings-icon');
      if (this.showSettingsOptions && settingsComponent === null && settingsIconComponent === null) {
        this.toggleDropdown();
      }
    });
  }

  toggleSearch() {
    this.isSearchActive = !this.isSearchActive;
    const iconApp = this.document.getElementById("divAppNavBar") as HTMLElement;
    const newWorkout = this.document.getElementById("newWorkout") as HTMLElement;
    if (this.isSearchActive) {
      iconApp.innerHTML = '<img src="../../assets/icons/logoBlancoNavBar.png" alt="Logo" class="d-inline-block align-top imagenAppNavBar" style="width: 45px; height: 35px; margin-left: 144px; margin-top: 5px; margin-bottom: -10px;">';
    } else {
      if (window.innerWidth < 1440) {
        newWorkout.innerHTML = "<i class='fa-solid fa-plus'></i>";
        iconApp.innerHTML = '<img src="../../assets/icons/logoBlancoNavBar.png" alt="Logo" class="d-inline-block align-top imagenAppNavBar" style="width: 45px; height: 35px; margin-left: 144px; margin-top: 5px; margin-bottom: -10px;">';
      } else {
        iconApp.innerHTML = '<h1 style="font-family: Dancing Script; padding-left: 0px; font-size: 42px; margin-bottom: -2px">FitTracker</h1>';
      }
    }
    const spans = document.querySelectorAll('.nav-link span') as NodeListOf<HTMLElement>;
    spans.forEach((span) => {
      span.style.display = this.isSearchActive ? 'none' : 'inline';
    });
  }

  clearSearchInput() {
    const searchInput = document.querySelector('.search-input') as HTMLInputElement;
    if (searchInput) {
      searchInput.value = '';
    }
  }

  onInputFocus() {
    this.isInputFocused = true;
  }

  onInputBlur() {
    this.isInputFocused = false;
  }

  onInputChange = async (event: Event) => {
    const input = event.target as HTMLInputElement;
    console.log(input.value);

    if (input.value.length > 2) {
      // Construir la URL con los parámetros de consulta
      const baseUrl = "http://localhost/api/search/user";
      const queryParam = encodeURIComponent(input.value);
      const url = `${baseUrl}?query=${queryParam}`;

      // Realizar la solicitud GET sin cuerpo
      try {
        const response = await fetch(url, {
          method: "GET",
          headers: {
            "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTcxNjU2OTM4NCwiZXhwIjoxNzE2NjU0NTg0LCJuYmYiOjE3MTY1NjkzODQsImp0aSI6IjF3QUhHWERiTkpBZ2o0eEYiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.4CLV1KUmXYzwErhrdUUCt9xSu2Qyu3lthO2cnWB2knc",
            "Content-Type": "application/json"
          }
        });

        if (response.ok) {
          const responseData = await response.json();
          this.users = responseData.data; // Asigna los usuarios a la matriz
        } else {
          console.error('Error en la respuesta de la petición:', response.statusText);
        }
      } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
      }
    }
  }




  toggleDropdown() {
    this.showSettingsOptions = !this.showSettingsOptions;
    this.showThemeSettings = false;
  }

  toggleThemeSettings() {
    this.showThemeSettings = !this.showThemeSettings;
    this.showSettingsOptions = false;
  }

  changeTheme(theme: string) {
    this.currentTheme = theme;
    const root = this.document.documentElement;
    const icon = this.document.getElementById("icon-theme") as HTMLElement;

    switch (theme) {
      case 'oscuro':
        icon.innerHTML = '<i class="fa-solid fa-moon"></i>';
        root.style.setProperty('--background-color', '#000000');
        root.style.setProperty('--background-input', '#262626');
        root.style.setProperty('--text-color', '#FFFFFF');
        root.style.setProperty('--border-color', '#2F3336');
        break;
      case 'media_noche':
        icon.innerHTML = '<i class="fa-solid fa-cloud-moon"></i>';
        root.style.setProperty('--background-color', '#15202B');
        root.style.setProperty('--background-input', '#273340');
        root.style.setProperty('--text-color', '#FFFFFF');
        root.style.setProperty('--border-color', '#38444D');
        break;
      case 'blanco':
        icon.innerHTML = '<i class="fa-solid fa-sun"></i>';
        root.style.setProperty('--background-color', '#FFFFFF');
        root.style.setProperty('--background-input', '#EFEFEF');
        root.style.setProperty('--text-color', '#000000');
        root.style.setProperty('--border-color', '#DBDBDB');
        break;
    }
  }

  updateCurrentSection(url: string) {
    switch (url) {
      case '/':
        this.currentSection = 'Inicio';
        break;
      case '/routines':
        this.currentSection = 'Rutinas';
        break;
      case '/notifications':
        this.currentSection = 'Ejercicios';
        break;
      case '/messages':
        this.currentSection = 'Mensajes';
        break;
      case '/communities':
        this.currentSection = 'Comunidades';
        break;
      case '/premium':
        this.currentSection = 'Premium';
        break;
      case '/profile':
        this.currentSection = 'Perfil';
        break;
      default:
        this.currentSection = 'FitTracker';
    }
  }
}
