import { CommonModule } from '@angular/common';
import { Component, Inject } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MAT_BOTTOM_SHEET_DATA, MatBottomSheet, MatBottomSheetRef } from '@angular/material/bottom-sheet';
import { WorkoutStateService } from '../workout-state.service';
import { StartWorkoutComponent } from '../start-workout/start-workout.component';
import { WorkoutComponent } from '../workout/workout.component';

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

  convertDateFormat(dateString: string): string {
    const date = new Date(dateString);
    const year = date.getFullYear();
    const month = date.getMonth() + 1; // Los meses en JavaScript son 0-11, por lo que añadimos 1
    const day = date.getDate();
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const seconds = date.getSeconds();
  
    // Asegurarse de que el mes, día, horas, minutos y segundos tengan dos dígitos
    const formattedMonth = month < 10 ? `0${month}` : month;
    const formattedDay = day < 10 ? `0${day}` : day;
    const formattedHours = hours < 10 ? `0${hours}` : hours;
    const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;
    const formattedSeconds = seconds < 10 ? `0${seconds}` : seconds;
  
    return `${year}/${formattedMonth}/${formattedDay}, ${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
  }

  
  async save() {
    if (confirm('¿Estás seguro de que deseas guardar el entrenamiento?')) {
      console.log("duration: " + this.workoutState.duration); // Duracion del entrenamiento
      console.log("endTime: " + this.workoutState.endTime); // Hora de finalizacion
      console.log("totalVolume: " + this.workoutState.totalVolume); // Volumen total

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

          console.log('Body Content to be sent:', bodyContent);

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
      
      
      this.workoutState.reset();
      this.close();
    }
  }
}
