import { Component, Output, EventEmitter} from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-add-exercise-modal',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './add-exercise-modal.component.html',
  styleUrl: './add-exercise-modal.component.css'
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
  extra_info: string = '';
  image: string = '';
  video: string = '';

  constructor(private http: HttpClient) { }

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
      video: this.video,
      suggestion: 'yes'
    };
    console.log(exerciseData)

    this.http.post('http://localhost/api/exercise', exerciseData, { headers })
      .subscribe(
        (response) => {
          console.log('Exercise added successfully:', response);
          this.exerciseAdded.emit();
        },
        (error) => {
          console.error('Error adding exercise:', error);
          // You can handle errors here, like displaying an error message
        }
      );
  }
  closeModal() {
    this.close.emit();
  }

}
