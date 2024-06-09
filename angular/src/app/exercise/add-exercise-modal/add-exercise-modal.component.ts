import { ExerciseComponent } from './../exercise.component';
import { Component, Output, EventEmitter } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-add-exercise-modal',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './add-exercise-modal.component.html',
  styleUrls: ['./add-exercise-modal.component.css']
})
export class AddExerciseModalComponent {
  @Output() exerciseAdded = new EventEmitter<void>();
  @Output() close = new EventEmitter<void>();

  name: string = '';
  type: string = '';
  muscle: string = '';
  equipment: string = '';
  difficulty: string = '';
  instructions: string = '';
  extra_info = "Creado desde apartado cliente";
  image: string | ArrayBuffer | null = null;
  video: File | null = null;

  constructor(private http: HttpClient, private exerciseComponent: ExerciseComponent) { }

  onImageSelected(event: Event): void {
    const file = (event.target as HTMLInputElement).files![0];
    const reader = new FileReader();
    reader.onload = () => {
      this.image = reader.result;
    };
    reader.readAsDataURL(file);
  }

  onVideoSelected(event: Event): void {
    const input = event.target as HTMLInputElement;
    if (input.files && input.files.length > 0) {
      this.video = input.files[0];
    }
  }

  addExercise() {
    const token = sessionStorage.getItem("authToken")

    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    });

    const exerciseData = {
      name: this.name,
      type: this.type,
      muscle: this.muscle,
      equipment: this.equipment,
      difficulty: this.difficulty,
      instructions: this.instructions,
      extra_info: this.extra_info,
      image: this.image,
      // video: this.video,
      suggestion: 'yes'
    };

    this.http.post('http://localhost/api/exercise', exerciseData, { headers })
      .subscribe(
        (response) => {
          console.log('Exercise added successfully:', response);
          this.exerciseComponent.onExerciseAdded();
          // this.exerciseAdded.emit();
        },
        (error) => {
          console.error('Error adding exercise:', error);
        }
      );
    this.closeModal();
  }

  closeModal() {
    this.close.emit();
  }
}
