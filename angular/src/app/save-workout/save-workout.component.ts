import { CommonModule } from '@angular/common';
import { Component, Inject } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MAT_BOTTOM_SHEET_DATA, MatBottomSheet, MatBottomSheetRef } from '@angular/material/bottom-sheet';
import { WorkoutStateService } from '../workout-state.service';
import { StartWorkoutComponent } from '../start-workout/start-workout.component';
import { WorkoutComponent } from '../workout/workout.component';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-save-workout',
  standalone: true,
  imports: [CommonModule, FormsModule, StartWorkoutComponent, WorkoutComponent],
  templateUrl: './save-workout.component.html',
  styleUrls: ['./save-workout.component.css']
})

export class SaveWorkoutComponent {
  description: string = '';
  imageUrl: string | ArrayBuffer | null = null;

  formatDate(dateString: string): string {
    const dateFormat = dateString.split(",");
    const [day, month, year] = dateFormat[0].split('/').map(Number);
    const date = new Date(year, month - 1, day);
    const yyyy = date.getFullYear();
    const mm = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
    const dd = String(date.getDate()).padStart(2, '0');
    return `${yyyy}-${mm}-${dd}`;
  }

  constructor(private bottomSheetRef: MatBottomSheetRef<SaveWorkoutComponent>,
    public workoutState: WorkoutStateService,
    @Inject(MAT_BOTTOM_SHEET_DATA) public data: any) {
    this.workoutState.exercises = data.exercises;  // Asignar los datos recibidos
  }

  onFileSelected(event: Event): void {
    const file = (event.target as HTMLInputElement).files![0];
    const reader = new FileReader();
    reader.onload = () => {
      this.imageUrl = reader.result;
    };
    reader.readAsDataURL(file);
  }

  close(): void {
    this.bottomSheetRef.dismiss();
  }

  async insertSeries() {
    const headersList = {
      "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    };

    for (const exercise of this.workoutState.exercises) {
      const series: { workout_id: string | null; exercise_id: number; reps: number; kilograms: number; }[] = [];

      exercise.sets.forEach(element => {
        const serie = {
          "workout_id": this.workoutState.id,
          "exercise_id": exercise.id,
          "reps": element.reps,
          "kilograms": element.kg
        };
        series.push(serie);
      });

      if (series.length > 0) {
        const bodyContent = JSON.stringify({
          series: series
        });

        try {
          const response = await fetch("http://localhost/api/exercise-logs", {
            method: "POST",
            body: bodyContent,
            headers: headersList
          });

          const data = await response.json();
          console.log(data);
        } catch (error) {
          console.error('Error:', error);
        }
      } else {
        console.log("El ejercicio " + exercise.id + " no tiene series asignadas por lo que no se ha insertado");
      }
    }
  }

  async insertLog() {
    const headersList = {
      "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    };

    const workout_id = Number(this.workoutState.id)
    const start_date = this.formatDate(this.workoutState.startTime)
    const end_date = this.formatDate(this.workoutState.endTime)
    const duration = String(this.workoutState.duration)
    const volume = String(this.workoutState.totalVolume)

    const bodyContent = JSON.stringify(
      {
        "workout_id": workout_id,
        "start_date": start_date,
        "end_date": end_date,
        "duration": duration,
        "volume": volume
      }
    );

    let response = await fetch("http://localhost/api/log", {
      method: "POST",
      body: bodyContent,
      headers: headersList
    });

    let data = await response.json();
    console.log(data);
  }

  async insertPost() {
    const headersList = {
      "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    };

    const workout_id = Number(this.workoutState.id);
    const title = this.description;
    const image = this.imageUrl;

    const bodyContent = JSON.stringify({
      "workout_id": workout_id,
      "title": title,
      "image": image
    });

    let response = await fetch("http://localhost/api/post", {
      method: "POST",
      body: bodyContent,
      headers: headersList
    });

    let data = await response.text();
    console.log(data);
  }

  async save() {
    Swal.fire({
      text: "¿Estás seguro de que deseas guardar el entrenamiento?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, guardar',
      cancelButtonText: 'Cancelar',
      customClass: {
        popup: 'swal2-popup',
        title: 'swal2-title',
      }
    }).then((result) => {
      if (result.isConfirmed) {
        this.insertSeries();
        this.insertLog();
        this.insertPost();
        this.workoutState.reset();
        this.close();
        Swal.fire(
          'Guardado',
          'El entrenamiento ha sido guardado.',
          'success'
        );
      }
    });
  }

}