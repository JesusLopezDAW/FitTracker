import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { DragDropModule, CdkDragDrop, moveItemInArray, transferArrayItem } from '@angular/cdk/drag-drop';

interface Routine {
  id: number;
  name: string;
}

interface Folder {
  name: string;
  routines: Routine[];
  isCreatingRoutine?: boolean;
}

@Component({
  selector: 'app-routines',
  standalone: true,
  imports: [CommonModule, FormsModule, DragDropModule],
  templateUrl: './routines.component.html',
  styleUrls: ['./routines.component.css']
})
export class RoutinesComponent {
  folders: Folder[] = [
    { name: 'Folder 1', routines: [] }
  ];

  newRoutineName: string = '';
  routineIdCounter: number = 1;

  constructor(private router: Router) { }

  createNewFolder() {
    this.folders.push({ name: `Folder ${this.folders.length + 1}`, routines: [] });
  }

  startCreatingRoutine(folderIndex: number) {
    this.folders[folderIndex].isCreatingRoutine = true;
  }

  confirmNewRoutine(folderIndex: number) {
    if (this.newRoutineName.trim()) {
      const newRoutine: Routine = { id: this.routineIdCounter++, name: this.newRoutineName };
      this.folders[folderIndex].routines.push(newRoutine);
      this.newRoutineName = '';
      this.folders[folderIndex].isCreatingRoutine = false;
    } else {
      alert('Routine name cannot be empty');
    }
  }

  cancelNewRoutine(folderIndex: number) {
    this.folders[folderIndex].isCreatingRoutine = false;
    this.newRoutineName = '';
  }

  drop(event: CdkDragDrop<Routine[]>, folderIndex: number) {
    if (event.previousContainer === event.container) {
      moveItemInArray(event.container.data, event.previousIndex, event.currentIndex);
    } else {
      transferArrayItem(
        event.previousContainer.data,
        event.container.data,
        event.previousIndex,
        event.currentIndex
      );
    }
  }
}
