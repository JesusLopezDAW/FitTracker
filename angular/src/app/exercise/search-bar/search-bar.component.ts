import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { AddButtonComponent } from '../add-button/add-button.component';
import { ExerciseService } from '../../services/exercise.service';

@Component({
  selector: 'app-search-bar',
  standalone: true,
  imports: [CommonModule, FormsModule, RouterModule, AddButtonComponent],
  templateUrl: './search-bar.component.html',
  styleUrls: ['./search-bar.component.css']
})
export class SearchBarComponent {
  query: string = '';
  exercises: any[] = [];
  showModal = false;
  globalExercises: any = [];
  userExercises: any = [];

  constructor(private exerciseService: ExerciseService) { }

  onInputChange = async (event: Event) => {
    const input = event.target as HTMLInputElement;
    console.log(input.value);

    if (input.value.length > 1) {
      const baseUrl = "http://localhost/api/search/exercise";
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
          console.log(responseData.data.data);
          this.exercises = responseData.data.data;
        } else {
          console.error('Error en la respuesta de la petición:', response.statusText);
        }
      } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
      }
    } else if (input.value.length === 0) {
      this.exercises = [];
    }
  }
  onExerciseAdded() {
    this.showModal = false;
    this.getExercises();
  }

  getExercises() {
    this.exerciseService.getExercises().subscribe((data) => {
      this.globalExercises = Object.entries(data.data.globals);
      this.userExercises = Object.entries(data.data.user);
    });
  }
}
