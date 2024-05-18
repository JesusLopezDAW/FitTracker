import { Component } from '@angular/core';
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
  showDropdown = false;
  showThemeSettings = false;
  isSearchActive: boolean = false;
  currentTheme: string = 'oscuro'; // Tema inicial
  isInputFocused = false;

  constructor(@Inject(DOCUMENT) private document: Document) { }

  toggleSearch() {
    this.isSearchActive = !this.isSearchActive;
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
    this.showDropdown = !this.showDropdown;
    this.showThemeSettings = false; // Oculta los ajustes de tema si se muestra el dropdown
    console.log(this.showDropdown);
  }

  toggleThemeSettings() {
    this.showThemeSettings = !this.showThemeSettings;
    this.showDropdown = false; // Oculta el dropdown si se muestran los ajustes de tema
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
