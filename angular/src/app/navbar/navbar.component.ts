import { Component, Renderer2, Inject, PLATFORM_ID } from '@angular/core';
import { CommonModule, DOCUMENT, isPlatformBrowser } from '@angular/common';
import { NavigationEnd, Router, RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [CommonModule, RouterModule, FormsModule],
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
  inputSearch: string = "";

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
    const searchinput = this.document.getElementById("search-input") as HTMLElement;
    searchinput.focus();
    if (this.isSearchActive) {
      iconApp.innerHTML = '<img src="../../assets/icons/logoBlancoNavBar.png" alt="Logo" class="d-inline-block align-top imagenAppNavBar" style="width: 45px; height: 35px; margin-left: 144px; margin-top: 5px; margin-bottom: -10px;">';
      newWorkout.innerHTML = "<i class='fa-solid fa-plus'></i>";
    } else {
      if (window.innerWidth < 1440) {
        newWorkout.innerHTML = "<i class='fa-solid fa-plus'></i>";
        iconApp.innerHTML = '<img src="../../assets/icons/logoBlancoNavBar.png" alt="Logo" class="d-inline-block align-top imagenAppNavBar" style="width: 45px; height: 35px; margin-left: 144px; margin-top: 5px; margin-bottom: -10px;">';
      } else {
        newWorkout.innerHTML = "<span>Nuevo entrenamiento</span>";
        iconApp.innerHTML = '<h1 style="font-family: Dancing Script; padding-left: 0px; font-size: 42px; margin-bottom: -2px; color: var(--text-color)">FitTracker</h1>';
      }
    }
    const spans = document.querySelectorAll('.nav-link span') as NodeListOf<HTMLElement>;
    spans.forEach((span) => {
      span.style.display = this.isSearchActive ? 'none' : 'inline';
    });
  }

  clearSearchInput() {
    console.log("asdasdasdasd");
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

    if (input.value.length > 1) {
      const baseUrl = "http://localhost/api/search/user";
      const queryParam = encodeURIComponent(input.value);
      const url = `${baseUrl}?query=${queryParam}`;

      try {
        const response = await fetch(url, {
          method: "GET",
          headers: {
            "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
            "Content-Type": "application/json"
          }
        });

        if (response.ok) {
          const responseData = await response.json();
          console.log(responseData.data);
          this.users = responseData.data;
        } else {
          console.error('Error en la respuesta de la petición:', response.statusText);
        }
      } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
      }
    }else if(input.value.length == 0){
      this.users = [];
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
