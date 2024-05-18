import { Component, Renderer2, OnDestroy } from '@angular/core';
import { CommonModule, DOCUMENT, isPlatformBrowser } from '@angular/common';
import { RouterModule } from '@angular/router';
import { PLATFORM_ID, Inject } from '@angular/core';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent {
  showDropdown = false;
  showTooltip = false;
  isInputFocused = false;
  isSearchActive: boolean = false;
  currentTheme: string = 'oscuro'; // Tema inicial

  constructor(private renderer: Renderer2, @Inject(DOCUMENT) private document: Document, @Inject(PLATFORM_ID) private platformId: Object) {
    // Definir closeDropdownOutside en el constructor
    this.closeDropdownOutside = this.closeDropdownOutside.bind(this);
  }
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

  setTheme(theme: string) {
    this.currentTheme = theme;
    switch (theme) {
      case 'oscuro':
        this.setThemeVariables('#000000', '#000000', '#FFFFFF');
        break;
      case 'noche-clara':
        this.setThemeVariables('#15202B', '#15202B', '#FFFFFF');
        break;
      case 'blanco':
        this.setThemeVariables('#FFFFFF', '#FFFFFF', '#000000');
        break;
    }
  }

  setThemeVariables(bgColor: string, navBgColor: string, textColor: string) {
    if (isPlatformBrowser(this.platformId)) {
      this.renderer.setStyle(document.documentElement, '--oscuro', bgColor);
      this.renderer.setStyle(document.documentElement, '--noche-clara', navBgColor);
      this.renderer.setStyle(document.documentElement, '--blanco', textColor);
    }
  }
  toggleDropdown() {
    this.showDropdown = !this.showDropdown;
    if (this.showDropdown) {
      // Agregar evento de clic para cerrar el menú si se hace clic fuera de él
      this.document.addEventListener('click', this.closeDropdownOutside);
    } else {
      // Eliminar el evento de clic cuando el menú se cierra
      this.document.removeEventListener('click', this.closeDropdownOutside);
    }
  }

  closeDropdownOutside(event: MouseEvent) {
    const targetElement = event.target as HTMLElement;
    const dropdownElement = document.querySelector('.dropdown') as HTMLElement;
    // Verificar si se hizo clic fuera del menú
    if (!dropdownElement.contains(targetElement)) {
      this.showDropdown = false;
      // Eliminar el evento de clic después de cerrar el menú
      this.document.removeEventListener('click', this.closeDropdownOutside);
    }
  }

  ngOnDestroy() {
    // Limpiar el evento de clic al destruir el componente
    this.document.removeEventListener('click', this.closeDropdownOutside);
  }

}
