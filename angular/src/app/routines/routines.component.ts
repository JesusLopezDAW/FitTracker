import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { CommonModule } from '@angular/common';
import { Component, ElementRef, Renderer2, ViewChild, HostListener, AfterViewInit, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavbarComponent } from '../navbar/navbar.component';
import { FormsModule } from '@angular/forms';
import { DragDropModule } from '@angular/cdk/drag-drop';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faEdit, faCheck, faTimes, faBars, faTrash, faPlus } from '@fortawesome/free-solid-svg-icons';
import { moveItemInArray, CdkDragDrop } from '@angular/cdk/drag-drop';
import { RoutineEditModalComponent } from '../modals/routine-edit-modal/routine-edit-modal.component';
import { CreateRoutineModalComponent } from '../modals/create-routine-modal/create-routine-modal.component';


interface Workout {
  id: number;
  name: string;
  isEditing?: boolean;
}

interface Routine {
  id?: Number;
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
export class RoutinesComponent implements OnInit {

  async ngOnInit(): Promise<void> {
    await this.userRoutines();
  }

  // Iconos
  faEdit = faEdit;
  faCheck = faCheck;
  faTimes = faTimes;
  faBars = faBars;
  faTrash = faTrash;
  faPlus = faPlus;
  enterKeyPressed = false;
  newWorkoutName = '';
  routineName: string = 'Nombre de la Rutina';

  routines: Routine[] = [
    {
      id: 1,
      name: 'Push / Pull / Legs',
      workouts: [
        { id: 1, name: 'Pecho / Hombros / Triceps' },
        { id: 2, name: 'Piernas' },
        { id: 3, name: 'Espalda / Biceps' },
      ]
    },
    {
      id: 2,
      name: '5 dias',
      workouts: [
        { id: 1, name: 'Pecho' },
        { id: 2, name: 'Espalda' },
        { id: 3, name: 'Hombros' },
        { id: 4, name: 'Pierna' },
        { id: 5, name: 'Brazos' },
      ]
    },
    {
      id: 3,
      name: 'Frecuencia 2',
      workouts: [
        { id: 1, name: 'Pecho / Hombros / Triceps' },
        { id: 2, name: 'Espalda / Biceps' },
        { id: 3, name: 'Pierna' }
      ]
    }
  ];

  @ViewChild('newWorkoutInput') newWorkoutInput!: ElementRef;
  @ViewChild('editRoutineNameInput') editRoutineNameInput!: ElementRef;
  @ViewChild('editWorkoutNameInput') editWorkoutNameInput!: ElementRef;

  constructor(private router: Router, private renderer: Renderer2, private modalService: NgbModal) { }

  async userRoutines(): Promise<void> {
    const headersList = {
      "Accept": "*/*",
      "User-Agent": "Thunder Client (https://www.thunderclient.com/)",
      "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    };

    try {
      let response = await fetch("http://localhost/api/routines", {
        method: "GET",
        headers: headersList,
      });
      let data = await response.json();
      console.log(data.data);
      const routines = data.data;
      this.routines = routines.map((routine: any) => ({
        id: routine.id,
        name: routine.name,
        workouts: routine.workouts.map((workout: any) => ({
          id: workout.id,
          name: workout.name
        }))
      }));
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

  openEditModal() {
    const modalRef = this.modalService.open(RoutineEditModalComponent, { centered: true });
    modalRef.componentInstance.routineName = this.routineName;

    modalRef.result.then((result) => {
      if (result) {
        console.log(result);
        this.routineName = result;
        // Aquí puedes manejar la lógica para guardar el nombre actualizado de la rutina
      }
    }).catch((error) => {
      console.error('Error:', error);
    });
  }

  mdlCreateRoutine(){
    const modalRef = this.modalService.open(CreateRoutineModalComponent, { centered: true });
  }
  createNewRoutine() {
    this.routines.push({ name: 'New Routine ' + this.routines.length, workouts: [] });
    const index = this.routines.length - 1;
    this.editRoutineName(index);
    // console.log("rutina creada");
    this.addRoutine("New Routine " + this.routines.length + 1);
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
    // FETCH CREAR NUEVO ENTRENAMIENTO
    console.log("nuevo entrenamiento creado");
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
    // console.log(this.enterKeyPressed);
    if (!this.enterKeyPressed) {
      this.routines[routineIndex].isEditing = false;
      // FETCH EDITAR NOMBRE RUTINA
      // console.log("nombre de la rutina cambiado "+this.routines[routineIndex].name);
      const routineId = this.routines[routineIndex].id;
      if (routineId && typeof routineId === 'number') {
        this.updateRoutine(this.routines[routineIndex].name, routineId);
      }
    }
    this.enterKeyPressed = false;
  }

  onEnterKey(routineIndex: number) {
    // Establece enterKeyPressed en true cuando se presiona Enter
    this.enterKeyPressed = true;
    // Llama a confirmRoutineName
    this.confirmRoutineName(routineIndex);
  }

  editWorkoutName(routineIndex: number, workoutIndex: number) {
    this.routines[routineIndex].workouts[workoutIndex].isEditing = true;
    setTimeout(() => {
      this.renderer.selectRootElement(this.editWorkoutNameInput.nativeElement).focus();
    }, 0);
  }

  confirmWorkoutName(routineIndex: number, workoutIndex: number) {
    this.routines[routineIndex].workouts[workoutIndex].isEditing = false;
    // FETCH EDITAR NOMBRE ENTRENAMIENTO
    console.log("nombre del entrenamiento cambiado");
  }

  deleteRoutine(routineIndex: number) {
    const routineId = this.routines[routineIndex].id;
    this.routines.splice(routineIndex, 1);
    console.log("Rutina eliminada");

    if (routineId && typeof routineId === 'number') {
      this.removeRoutine(routineId);
    }
  }

  deleteWorkout(routineIndex: number, workoutIndex: number) {
    this.routines[routineIndex].workouts.splice(workoutIndex, 1);
    const workoutId = this.routines[routineIndex].workouts[0].id;
    console.log(workoutId);
    if (workoutId && typeof workoutId === 'number') {
      this.removeWorkout(workoutId);
    }
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

  // PETICIONES FETCH
  async removeRoutine(routineId: number): Promise<any> {
    try {
      const headersList = {
        "Accept": "*/*",
        "User-Agent": "Thunder Client (https://www.thunderclient.com)",
        "Authorization": "bearer " + sessionStorage.getItem("authToken"),
        "Content-Type": "application/json"
      };

      const response = await fetch("http://localhost/api/routines/" + routineId, {
        method: "DELETE",
        headers: headersList
      });

      const data = await response.json();
      console.log("Respuesta de eliminación de rutina:", data);
      return data;
    } catch (error) {
      console.error("Error al eliminar la rutina:", error);
      throw error; // Relanzar el error para que pueda ser manejado por la función deleteRoutine
    }
  }
  async removeWorkout(workoutId: number): Promise<any> {
    try {
      const headersList = {
        "Accept": "*/*",
        "User-Agent": "Thunder Client (https://www.thunderclient.com)",
        "Authorization": "bearer " + sessionStorage.getItem("authToken"),
        "Content-Type": "application/json"
      };

      const response = await fetch("http://localhost/api/workout/" + workoutId, {
        method: "DELETE",
        headers: headersList
      });

      const data = await response.json();
      console.log("Respuesta de eliminación del entrenamiento:", data);
      return data;
    } catch (error) {
      console.error("Error al eliminar el entrenamiento:", error);
      throw error;
    }
  }
  async addRoutine(routineName: string): Promise<any> {
    try {
      let headersList = {
        "Authorization": "bearer " + sessionStorage.getItem("authToken"),
        "Content-Type": "application/json"
      }

      let bodyContent = JSON.stringify({
        "name": routineName
      });

      let response = await fetch("http://localhost/api/routines", {
        method: "POST",
        body: bodyContent,
        headers: headersList
      });

      let data = await response.json();
      console.log(data);
    } catch (error) {
      console.error("Error al eliminar el entrenamiento:", error);
      throw error;
    }
  }
  async updateRoutine(routineName: string, routineId: number): Promise<any> {
    console.log(routineId);
    console.log(routineName);
    try {
      let headersList = {
        "Authorization": "bearer " + sessionStorage.getItem("authToken"),
        "Content-Type": "application/json"
      }

      let bodyContent = JSON.stringify({
        "id": routineId,
        "name": routineName
      });

      let response = await fetch("http://localhost/api/routines", {
        method: "UPDATE",
        body: bodyContent,
        headers: headersList
      });

      let data = await response.json();
      console.log(data);
    } catch (error) {
      console.error("Error al actualizar la rutina:", error);
      throw error;
    }
  }
}