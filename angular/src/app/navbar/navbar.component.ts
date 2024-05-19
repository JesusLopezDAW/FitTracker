import { Component, Renderer2, HostListener } from '@angular/core';
import { CommonModule, DOCUMENT } from '@angular/common';
import { RouterModule } from '@angular/router';
import { Inject } from '@angular/core';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent {
  showSettingsOptions = false;
  showThemeSettings = false;
  isSearchActive = false; // Inicializado como un booleano
  currentTheme: string = 'oscuro'; // Tema inicial
  isInputFocused = false;

  constructor(private renderer: Renderer2, @Inject(DOCUMENT) private document: Document) {
    this.document.addEventListener('click', (event) => {
      // Si se hace click fuera del div del buscador se cierra el buscador
      const searchComponent = (event.target as HTMLElement).closest('.search-component');
      const iconComponent = (event.target as HTMLElement).closest('.buscador-icon');
      if (searchComponent === null && this.isSearchActive && iconComponent === null) {
        this.toggleSearch();
      }
      
      // Si se hace click fuera del div de opciones se cierra
      const themeComponent = (event.target as HTMLElement).closest('.theme-settings');
      const cambiarAspectoComponent = (event.target as HTMLElement).closest('.cambiarAspecto');
      if(this.showThemeSettings && themeComponent === null && cambiarAspectoComponent === null){
        this.toggleThemeSettings();
      }
      // Si se hace click fuera del div de cambiar tema se cierra
      const settingsComponent = (event.target as HTMLElement).closest('.settings-menu');
      const settingsIconComponent = (event.target as HTMLElement).closest('.settings-icon');
      if(this.showSettingsOptions && settingsComponent === null && settingsIconComponent === null){
        this.toggleDropdown();
      }
    });
  }

  toggleSearch() {
    this.isSearchActive = !this.isSearchActive;
    const iconApp = this.document.getElementById("divAppNavBar") as HTMLElement;
    if(this.isSearchActive){
      iconApp.innerHTML = '<img src="../../assets/icons/logoBlancoNavBar.png" alt="Logo" class="d-inline-block align-top imagenAppNavBar" style="width: 45px; height: 35px; margin-left: 144px; margin-top: 10px; margin-bottom: 11px;">';
    }else{
      if (window.innerWidth < 1440) {
        iconApp.innerHTML = '<img src="../../assets/icons/logoBlancoNavBar.png" alt="Logo" class="d-inline-block align-top imagenAppNavBar" style="width: 45px; height: 35px; margin-left: 144px; margin-top: 10px; margin-bottom: 11px;">';
      }else{
        iconApp.innerHTML = '<h1 style="font-family: Dancing Script; padding-left: 0px;">FitTracker</h1>';
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

  toggleDropdown() {
    console.log(this.showSettingsOptions);
    this.showSettingsOptions = !this.showSettingsOptions;
    this.showThemeSettings = false; // Oculta los ajustes de tema si se muestra el dropdown
  }

  toggleThemeSettings() {
    this.showThemeSettings = !this.showThemeSettings;
    this.showSettingsOptions = false; // Oculta el dropdown si se muestran los ajustes de tema
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
}
