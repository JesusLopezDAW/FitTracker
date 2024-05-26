import { Component, Input } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-create-workout-modal',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './create-workout-modal.component.html',
  styleUrl: './create-workout-modal.component.css'
})
export class CreateWorkoutModalComponent {
  @Input() workoutName: string = '';
  @Input() workoutDescription: string = '';

  constructor(public activeModal: NgbActiveModal) { }

  closeModal() {
    this.activeModal.close();
  }

  saveChanges() {
    this.activeModal.close({ name: this.workoutName, description: this.workoutDescription });
  }
}
