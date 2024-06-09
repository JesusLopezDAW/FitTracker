import { CommonModule } from '@angular/common';
import { Component, Input, OnInit, Output, EventEmitter } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ExerciseService } from '../../exercise.service';

@Component({
  selector: 'app-exercise-modal',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './exercise-modal.component.html',
  styleUrls: ['./exercise-modal.component.css']
})
export class ExerciseModalComponent implements OnInit {
  @Input() workoutId: number = 0; // Proporcionar un valor por defecto
  @Output() exercisesUpdated = new EventEmitter<void>(); // EventEmitter para notificar al componente principal

  query: string = '';
  exercises: any[] = [];
  page: number = 1;
  loading: boolean = false;
  selectedExercises = new Set<number>();
  numberExercises = 0;

  constructor(public activeModal: NgbActiveModal, private exerciseService: ExerciseService) { }

  ngOnInit(): void {
    this.loadExercises();
  }

  async loadExercises() {
    this.loading = true;

    const baseUrl = "http://localhost/api/exercise/all";
    const url = `${baseUrl}?page=${this.page}`;

    const headers = new Headers({
      "Accept": "*/*",
      "User-Agent": "Thunder Client (https://www.thunderclient.com)",
      "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
    });

    try {
      const response = await fetch(url, { method: "GET", headers: headers });
      if (response.ok) {
        const responseData = await response.json();
        console.log(responseData);
        this.exercises = this.exercises.concat(responseData.exercises.data);
        console.log(this.exercises);
        this.page++;
      } else {
        console.error('Error en la respuesta de la petición:', response.statusText);
      }
    } catch (error) {
      console.error('There has been a problem with your fetch operation:', error);
    } finally {
      this.loading = false;
    }
  }

  closeModal() {
    this.activeModal.dismiss();
  }

  async onInputChange(event: Event) {
    const input = event.target as HTMLInputElement;

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
          this.exercises = responseData.data.data;
        } else {
          console.error('Error en la respuesta de la petición:', response.statusText);
        }
      } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
      }
    } else if (input.value.length === 0) {
      this.exercises = [];
      this.page = 1; // Reset pagination
      this.loadExercises();
    }
  }

  onScroll(event: any) {
    if (event.target.offsetHeight + event.target.scrollTop >= event.target.scrollHeight) {
      this.loadExercises();
    }
  }

  toggleSelection(exerciseId: number): void {
    if (this.selectedExercises.has(exerciseId)) {
      this.selectedExercises.delete(exerciseId);
      this.numberExercises--;
    } else {
      this.selectedExercises.add(exerciseId);
      this.numberExercises++;
    }
  }

  isSelected(exerciseId: number): boolean {
    return this.selectedExercises.has(exerciseId);
  }

  async addSelectedExercises() {
    const selectedIds = Array.from(this.selectedExercises);
    this.closeModal();

    for (const element of selectedIds) {
      const headersList = {
        "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
        "Content-Type": "application/json"
      };

      let bodyContent = JSON.stringify({
        "workout_id": this.workoutId,
        "exercise_id": element
      });

      try {
        let response = await fetch("http://localhost/api/logs/exercise", {
          method: "POST",
          body: bodyContent,
          headers: headersList
        });

        let data = await response.json();
        console.log(data);
      } catch (error) {
        console.error('Error:', error);
      }
    }

    // Notificar al WorkoutComponent que los ejercicios se han actualizado
    this.exerciseService.notifyExercisesUpdated();
    this.exercisesUpdated.emit();
  }
}
