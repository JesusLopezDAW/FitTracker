import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent {
  darkMode = false;
  isInputFocused = false;
  isSearchActive: boolean = false;

  toggleDarkMode() {
    this.darkMode = !this.darkMode;
    if (this.darkMode) {
      document.body.classList.add('bg-dark', 'text-light');
    } else {
      document.body.classList.remove('bg-dark', 'text-light');
    }
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
}
