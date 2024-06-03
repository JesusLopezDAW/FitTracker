import { Component, Output, EventEmitter } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AddExerciseModalComponent } from '../add-exercise-modal/add-exercise-modal.component';

@Component({
  selector: 'app-add-button',
  standalone: true,
  imports: [CommonModule, AddExerciseModalComponent],
  templateUrl: './add-button.component.html',
  styleUrls: ['./add-button.component.css']
})
export class AddButtonComponent {
  showModal = false;
  @Output() exerciseAdded = new EventEmitter<void>();

  toggleModal() {
    this.showModal = !this.showModal;
  }

  onExerciseAdded() {
    this.exerciseAdded.emit();
    this.showModal = false; // Close the modal
  }
}
