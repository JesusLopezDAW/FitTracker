import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MatBottomSheet, MatBottomSheetRef } from '@angular/material/bottom-sheet';
import { WorkoutStateService } from '../workout-state.service';
import { StartWorkoutComponent } from '../start-workout/start-workout.component';

@Component({
  selector: 'app-save-workout',
  standalone: true,
  imports: [CommonModule, FormsModule, StartWorkoutComponent],
  templateUrl: './save-workout.component.html',
  styleUrls: ['./save-workout.component.css']
})
export class SaveWorkoutComponent {
  description: string = '';
  imageUrl: string | ArrayBuffer | null = null;


  constructor(private bottomSheetRef: MatBottomSheetRef<SaveWorkoutComponent>,
    public workoutState: WorkoutStateService,
    private bottomSheet: MatBottomSheet) { }

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
    this.bottomSheet.open(StartWorkoutComponent, {
      hasBackdrop: true,
      panelClass: 'fullscreen-bottom-sheet'
    });
  }

  // discard(): void {
  //   if (confirm('¿Estás seguro de que deseas descartar el entrenamiento?')) {
  //     this.workoutState.stopTimer();
  //     this.workoutState.reset();
  //     this.bottomSheetRef.dismiss();
  //   }
  // }

  save(): void {
    if (confirm('¿Estás seguro de que deseas guardar el entrenamiento?')) {
      // Aquí puedes agregar la lógica para guardar los datos en la base de datos
      // Por ejemplo, podrías llamar a un servicio que se encargue de enviar los datos
      this.workoutState.reset();
      this.close();
    }
  }
}
