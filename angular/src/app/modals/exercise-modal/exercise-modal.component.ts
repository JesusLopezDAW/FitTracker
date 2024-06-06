import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-exercise-modal',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './exercise-modal.component.html',
  styleUrls: ['./exercise-modal.component.css']
})
export class ExerciseModalComponent implements OnInit {
  query: string = '';
  exercises: any[] = [];
  page: number = 1;
  loading: boolean = false;
  selectedExercises = new Set<number>();

  constructor(public activeModal: NgbActiveModal) { }

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
    } else {
      this.selectedExercises.add(exerciseId);
    }
  }

  isSelected(exerciseId: number): boolean {
    return this.selectedExercises.has(exerciseId);
  }

  addSelectedExercises(): void {
    const selectedIds = Array.from(this.selectedExercises);
    this.closeModal();
    console.log(selectedIds);
  }
}
