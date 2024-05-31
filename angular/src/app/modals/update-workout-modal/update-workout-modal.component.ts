import { Component, Input } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-update-workout-modal',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './update-workout-modal.component.html',
  styleUrl: './update-workout-modal.component.css'
})
export class UpdateWorkoutModalComponent {
  @Input() workoutId: number = 0;
  @Input() workoutName: string = '';
  @Input() workoutDescription: string = '';

  constructor(public activeModal: NgbActiveModal) { }

  closeModal() {
    this.activeModal.close();
  }

  saveChanges() {
    this.activeModal.close({ id: this.workoutId, name: this.workoutName, description: this.workoutDescription });
  }
}
