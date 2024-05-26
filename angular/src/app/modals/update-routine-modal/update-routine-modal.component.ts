import { Component, Input } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-update-routine-modal',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './update-routine-modal.component.html',
  styleUrl: './update-routine-modal.component.css'
})
export class UpdateRoutineModalComponent {
  @Input() routineId: number = 0;
  @Input() routineName: string = '';
  @Input() routineType: string = '';

  constructor(public activeModal: NgbActiveModal) { }

  closeModal() {
    this.activeModal.close();
  }

  saveChanges() {
    this.activeModal.close({ name: this.routineName, type: this.routineType, id:this.routineId });
  }
}
