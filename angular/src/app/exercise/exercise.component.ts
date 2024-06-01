import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { ExerciseService } from '../services/exercise.service';
import { NgFor, NgIf } from '@angular/common';
import { NgbCollapseModule } from '@ng-bootstrap/ng-bootstrap';
import { FormsModule } from '@angular/forms'

import { SearchBarComponent } from './search-bar/search-bar.component';
import { AddButtonComponent } from './add-button/add-button.component';

@Component({
  selector: 'app-exercise',
  standalone: true,
  imports: [CommonModule, NgFor, NgIf, NgbCollapseModule, FormsModule, SearchBarComponent, AddButtonComponent],
  templateUrl: './exercise.component.html',
  styleUrls: ['./exercise.component.css'],
})
export class ExerciseComponent implements OnInit {
  globalExercises: any = [];
  userExercises: any = [];
  searchQuery: string = ''; // Variable para almacenar la consulta de búsqueda
  isSearchBarVisible: boolean = false;

  constructor(private exerciseService: ExerciseService) {
  }

  ngOnInit(): void {
    this.exerciseService.getExercises().subscribe((data) => {
      this.globalExercises = Object.entries(data.data.globals);
      this.userExercises = Object.entries(data.data.user);
      console.log(this.globalExercises)
    });
  }
  
  isCollapsed: number | null = null;

  toggleCollapse(index: number) {
    this.isCollapsed = this.isCollapsed === index ? null : index;
  }
  isUserExercisesDefined(): boolean {
    return typeof this.userExercises === 'object' && this.userExercises !== null;
  }

  toggleSearchBar() {
    this.isSearchBarVisible = !this.isSearchBarVisible;
  }
}
