import { Component, OnInit } from '@angular/core';
import { ExerciseService } from '../services/exercise.service';
import { CommonModule, NgFor, NgIf } from '@angular/common';
import { NgbCollapseModule } from '@ng-bootstrap/ng-bootstrap';
import { FormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';

import { SearchBarComponent } from './search-bar/search-bar.component';
import { AddButtonComponent } from './add-button/add-button.component';
import { AddExerciseModalComponent } from './add-exercise-modal/add-exercise-modal.component';

@Component({
  selector: 'app-exercise',
  standalone: true,
  imports: [CommonModule, NgFor, NgIf, NgbCollapseModule, FormsModule, SearchBarComponent, AddButtonComponent, AddExerciseModalComponent, RouterModule],
  templateUrl: './exercise.component.html',
  styleUrls: ['./exercise.component.css'],
})
export class ExerciseComponent implements OnInit {
  globalExercises: any = [];
  userExercises: any = [];
  searchQuery: string = ''; // Variable para almacenar la consulta de búsqueda
  isSearchBarVisible: boolean = false;
  showModal = false;
  activeTab: string = 'global'; // Tab activa por defecto

  constructor(private exerciseService: ExerciseService) { }

  ngOnInit(): void {
    this.getExercises();
  }

  isCollapsed: number | null = null;

  getExercises() {
    this.exerciseService.getExercises().subscribe((data) => {
      this.globalExercises = Object.entries(data.data.globals);
      this.userExercises = Object.entries(data.data.user);
    });
  }

  toggleCollapse(index: number) {
    this.isCollapsed = this.isCollapsed === index ? null : index;
  }

  isUserExercisesDefined(): boolean {
    return typeof this.userExercises === 'object' && this.userExercises !== null;
  }

  toggleSearchBar() {
    this.isSearchBarVisible = !this.isSearchBarVisible;
  }

  toggleModal() {
    this.showModal = !this.showModal;
  }

  onExerciseAdded() {
    this.showModal = false;
    this.getExercises();
  }

  setActiveTab(tab: string): void {
    this.activeTab = tab;
  }
}
