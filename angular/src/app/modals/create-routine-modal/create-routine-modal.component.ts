import { Component, Input } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-create-routine-modal',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './create-routine-modal.component.html',
  styleUrls: ['./create-routine-modal.component.css'] // Cambia a 'styleUrls' en plural
})
export class CreateRoutineModalComponent {
  @Input() routineName: string = '';
  @Input() routineType: string = '';

  constructor(public activeModal: NgbActiveModal) { }

  closeModal() {
    this.activeModal.close();
  }

  saveChanges() {
    this.activeModal.close({ name: this.routineName, type: this.routineType });
  }
}
