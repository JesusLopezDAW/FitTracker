import { CommonModule } from '@angular/common';
import { Component, ElementRef, Renderer2, ViewChild, HostListener, AfterViewInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavbarComponent } from '../navbar/navbar.component';
import { FormsModule } from '@angular/forms';
import { DragDropModule } from '@angular/cdk/drag-drop';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faEdit, faCheck, faTimes, faBars, faTrash, faPlus } from '@fortawesome/free-solid-svg-icons';
import { moveItemInArray, CdkDragDrop } from '@angular/cdk/drag-drop';

interface Workout {
  id: number;
  name: string;
  isEditing?: boolean;
}

interface Routine {
  name: string;
  workouts: Workout[];
  isEditing?: boolean;
  isCreatingWorkout?: boolean;
}

@Component({
  selector: 'app-routines',
  imports: [CommonModule, NavbarComponent, FormsModule, DragDropModule, FontAwesomeModule],
  templateUrl: './routines.component.html',
  styleUrls: ['./routines.component.css'],
  standalone: true
})
export class RoutinesComponent {

  // Iconos
  faEdit = faEdit;
  faCheck = faCheck;
  faTimes = faTimes;
  faBars = faBars;
  faTrash = faTrash;
  faPlus = faPlus;

  newWorkoutName = '';
  routines: Routine[] = [
    {
      name: 'Push / Pull / Legs', workouts: [
        { id: 1, name: 'Pecho / Hombros / Triceps' },
        { id: 2, name: 'Piernas' },
        { id: 3, name: 'Espalda / Biceps' },
      ]
    },
    {
      name: '5 dias', workouts: [
        { id: 1, name: 'Pecho' },
        { id: 2, name: 'Espalda' },
        { id: 3, name: 'Hombros' },
        { id: 4, name: 'Pierna' },
        { id: 5, name: 'Brazos' },
      ]
    },
    {
      name: 'Frecuencia 2', workouts: [
        { id: 1, name: 'Pecho / Hombros / Triceps' },
        { id: 2, name: 'Espalda / Biceps' },
        { id: 3, name: 'Pierna' }
      ]
    },
    {
      name: 'Diaria', workouts: [
        { id: 1, name: 'Paja al fallo' }
      ]
    }
  ];

  @ViewChild('newWorkoutInput') newWorkoutInput!: ElementRef;
  @ViewChild('editRoutineNameInput') editRoutineNameInput!: ElementRef;
  @ViewChild('editWorkoutNameInput') editWorkoutNameInput!: ElementRef;

  constructor(private router: Router, private renderer: Renderer2) { }

  createNewRoutine() {
    this.routines.push({ name: 'New Routine', workouts: [] });
    const index = this.routines.length - 1;
    this.editRoutineName(index);
  }

  startCreatingWorkout(routineIndex: number) {
    this.cancelNewWorkoutIfCreating();
    this.routines[routineIndex].isCreatingWorkout = true;
    setTimeout(() => {
      if (this.newWorkoutInput && this.newWorkoutInput.nativeElement) {
        // Verifica si newWorkoutInput y su propiedad nativeElement están definidos
        this.renderer.selectRootElement(this.newWorkoutInput.nativeElement)?.focus();
        this.newWorkoutName = "Nuevo entrenamiento";
      }
    }, 0);
  }

  confirmNewWorkout(routineIndex: number) {
    if (this.newWorkoutName.trim()) {
      this.routines[routineIndex].workouts.push({ id: Date.now(), name: this.newWorkoutName });
      this.newWorkoutName = '';
      this.routines[routineIndex].isCreatingWorkout = false;
    }
  }

  cancelNewWorkout(routineIndex: number) {
    this.newWorkoutName = '';
    this.routines[routineIndex].isCreatingWorkout = false;
  }

  editRoutineName(routineIndex: number) {
    this.routines[routineIndex].isEditing = true;
    setTimeout(() => {
      this.renderer.selectRootElement(this.editRoutineNameInput.nativeElement).focus();
    }, 0);
  }

  confirmRoutineName(routineIndex: number) {
    this.routines[routineIndex].isEditing = false;
  }

  editWorkoutName(routineIndex: number, workoutIndex: number) {
    this.routines[routineIndex].workouts[workoutIndex].isEditing = true;
    setTimeout(() => {
      this.renderer.selectRootElement(this.editWorkoutNameInput.nativeElement).focus();
    }, 0);
  }

  confirmWorkoutName(routineIndex: number, workoutIndex: number) {
    this.routines[routineIndex].workouts[workoutIndex].isEditing = false;
  }

  deleteRoutine(routineIndex: number) {
    this.routines.splice(routineIndex, 1);
  }

  deleteWorkout(routineIndex: number, workoutIndex: number) {
    this.routines[routineIndex].workouts.splice(workoutIndex, 1);
  }

  // Si se clicka fuera del input cuando creas un nuevo entrenamiento se cancela
  @HostListener('document:click', ['$event'])
  onClickOutside(event: Event) {
    const clickedElement = event.target as HTMLElement;
    try {
      if (!this.newWorkoutInput.nativeElement.contains(clickedElement)
        && !clickedElement.closest('.fa-check')
        && !clickedElement.closest('.fa-plus')
        && !clickedElement.closest('.fa-times')) {
        this.cancelNewWorkoutIfCreating();
      }
    } catch (error) {

    }
  }

  cancelNewWorkoutIfCreating() {
    this.routines.forEach(routine => {
      if (routine.isCreatingWorkout) {
        routine.isCreatingWorkout = false;
        this.newWorkoutName = '';
      }
    });
  }

  drop(event: CdkDragDrop<Workout[]>, routineIndex: number) {
    console.log("Evento de drop activado");
    moveItemInArray(this.routines[routineIndex].workouts, event.previousIndex, event.currentIndex);
    // Actualizar los índices después de mover el elemento
    this.updateWorkoutIndexes(routineIndex);
  }

  updateWorkoutIndexes(routineIndex: number) {
    console.log(routineIndex);
    const workouts = this.routines[routineIndex].workouts;
    for (let i = 0; i < workouts.length; i++) {
      workouts[i].id = i + 1; // Actualizar el id o el índice del workout
    }
  }
}