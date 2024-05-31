import { CommonModule } from '@angular/common';
import { Component, Input } from '@angular/core';
import { FormControl, FormsModule } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-routine-edit-modal',
  standalone: true,
  templateUrl: './routine-edit-modal.component.html',
  styleUrls: ['./routine-edit-modal.component.css'],
  imports: [FormsModule]
})

export class RoutineEditModalComponent {
  @Input() routineName: string = '';

  constructor(public activeModal: NgbActiveModal) { }

  closeModal() {
    this.activeModal.close();
  }

  saveChanges() {
    this.activeModal.close(this.routineName);
  }
}
