import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { CommonModule } from '@angular/common';
import { Component, ElementRef, Renderer2, ViewChild, HostListener, AfterViewInit, OnInit } from '@angular/core';
import { Router, RouterModule } from '@angular/router';
import { NavbarComponent } from '../navbar/navbar.component';
import { FormsModule } from '@angular/forms';
import { DragDropModule } from '@angular/cdk/drag-drop';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faEdit, faCheck, faTimes, faBars, faTrash, faPlus } from '@fortawesome/free-solid-svg-icons';
import { moveItemInArray, CdkDragDrop } from '@angular/cdk/drag-drop';
import { RoutineEditModalComponent } from '../modals/routine-edit-modal/routine-edit-modal.component';
import { CreateRoutineModalComponent } from '../modals/create-routine-modal/create-routine-modal.component';
import { UpdateRoutineModalComponent } from '../modals/update-routine-modal/update-routine-modal.component';
import { CreateWorkoutModalComponent } from '../modals/create-workout-modal/create-workout-modal.component';
import { UpdateWorkoutModalComponent } from '../modals/update-workout-modal/update-workout-modal.component';


interface Workout {
  id?: number;
  name: string;
  description?: string
}

interface Routine {
  id?: Number;
  name: string;
  type: string;
  workouts: Workout[];
}

@Component({
  selector: 'app-routines',
  imports: [CommonModule, NavbarComponent, FormsModule, DragDropModule, FontAwesomeModule, RouterModule],
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
      type: "otros",
      workouts: [
        { id: 1, name: 'Pecho / Hombros / Triceps', description: "asd" },
        { id: 2, name: 'Piernas' },
        { id: 3, name: 'Espalda / Biceps' },
      ]
    },
    {
      id: 2,
      name: '5 dias',
      type: "otros",
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
      type: "otros",
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

  // Listar datos
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
      const routines = data.data;
      this.routines = routines.map((routine: any) => ({
        id: routine.id,
        name: routine.name,
        type: routine.type,
        workouts: routine.workouts.map((workout: any) => ({
          id: workout.id,
          name: workout.name,
          description: workout.description
        }))
      }));
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

  // Crear rutina
  createRoutineModal() {
    const modalRef = this.modalService.open(CreateRoutineModalComponent, { centered: true });
    modalRef.result.then((result) => {
      if (result) {
        this.routines.push({ name: result.name, type: result.type, workouts: [] });
        this.addRoutine(result.name, result.type);
      }
    }).catch((error) => {
      console.log('Modal dismissed with error:', error);
    });
  }

  // Update rutina
  updateRoutineModal(routineIndex: number) {
    const routineId = this.routines[routineIndex].id;
    const routineName = this.routines[routineIndex].name;
    const routineType = this.routines[routineIndex].type;

    const modalRef = this.modalService.open(UpdateRoutineModalComponent, { centered: true });
    modalRef.componentInstance.routineId = routineId;
    modalRef.componentInstance.routineName = routineName;
    modalRef.componentInstance.routineType = routineType;

    modalRef.result.then((result) => {
      if (result) {
        this.routines[routineIndex].name = result.name;
        this.routines[routineIndex].type = result.type;
        this.updateRoutine(result.name, result.id, result.type);
      }
    }).catch((error) => {
      console.error('Error:', error);
    });
  }

  // Eliminar rutina
  deleteRoutine(routineIndex: number) {
    const routineId = this.routines[routineIndex].id;
    this.routines.splice(routineIndex, 1);
    if (routineId && typeof routineId === 'number') {
      this.removeRoutine(routineId);
    }
  }

  // Crear entrenamiento
  createWorkoutModal(routineIndex: number) {
    const modalRef = this.modalService.open(CreateWorkoutModalComponent, { centered: true });
    const routineId = this.routines[routineIndex].id;
    modalRef.result.then((result) => {
      if (result) {
        this.routines[routineIndex].workouts.push({ name: result.name, description: result.description });
        if (routineId && typeof routineId === 'number') {
          this.addWorkout(routineId, result.name, result.description, routineIndex);
        }
      }
    }).catch((error) => {
      console.log('Modal dismissed with error:', error);
    });
  }

  // Update entrenamiento
  updateWorkoutModal(routineIndex: number, workoutIndex: number) {
    const routineId = this.routines[routineIndex].id;
    const workoutId = this.routines[routineIndex].workouts[workoutIndex].id;
    const workoutName = this.routines[routineIndex].workouts[workoutIndex].name;
    const workoutDescription = this.routines[routineIndex].workouts[workoutIndex].description;
    const modalRef = this.modalService.open(UpdateWorkoutModalComponent, { centered: true });
    modalRef.componentInstance.workoutId = workoutId;
    modalRef.componentInstance.workoutName = workoutName;
    modalRef.componentInstance.workoutDescription = workoutDescription;
    modalRef.result.then((result) => {
      if (result) {
        this.routines[routineIndex].workouts[workoutIndex].name = result.name;
        this.routines[routineIndex].workouts[workoutIndex].description = result.description;
        if (routineId && typeof routineId === 'number') {
          this.updateWorkout(routineId, result.id, result.name, result.description);
        }
      }
    }).catch((error) => {
      console.error('Error:', error);
    });
  }

  // Eliminar entrenamiento
  deleteWorkout(routineIndex: number, workoutIndex: number) {
    const workoutId = this.routines[routineIndex].workouts[workoutIndex].id;
    this.routines[routineIndex].workouts.splice(workoutIndex, 1);
    if (workoutId && typeof workoutId === 'number') {
      this.removeWorkout(workoutId);
    }
  }


  // Evento drop (Hay que arreglarlo)
  drop(event: CdkDragDrop<Workout[]>, routineIndex: number) {
    console.log("Evento de drop activado");
    moveItemInArray(this.routines[routineIndex].workouts, event.previousIndex, event.currentIndex);
    // Actualizar los índices después de mover el elemento
    this.updateWorkoutIndexes(routineIndex);
  }

  updateWorkoutIndexes(routineIndex: number) {
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
  async addRoutine(routineName: string, routineType: string): Promise<any> {
    try {
      let headersList = {
        "Authorization": "bearer " + sessionStorage.getItem("authToken"),
        "Content-Type": "application/json"
      }

      let bodyContent = JSON.stringify({
        "name": routineName,
        "type": routineType
      });

      let response = await fetch("http://localhost/api/routines", {
        method: "POST",
        body: bodyContent,
        headers: headersList
      });

      let data = await response.json();
      console.log(data);
      this.routines[this.routines.length - 1].id = data.data.id;
    } catch (error) {
      console.error("Error al crear la rutina: ", error);
      throw error;
    }
  }
  async updateRoutine(routineName: string, routineId: number, routineType: string): Promise<any> {
    try {
      let headersList = {
        "Authorization": "bearer " + sessionStorage.getItem("authToken"),
        "Content-Type": "application/json"
      }

      let bodyContent = JSON.stringify({
        "name": routineName,
        "type": routineType
      });

      let response = await fetch("http://localhost/api/routines/" + routineId, {
        method: "PUT",
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
  async addWorkout(routineId: number, workoutName: string, workoutDescription: string, routineIndex: number): Promise<any> {
    try {
      let headersList = {
        "Authorization": "bearer " + sessionStorage.getItem("authToken"),
        "Content-Type": "application/json"
      }

      let bodyContent = JSON.stringify({
        "routine_id": routineId,
        "name": workoutName,
        "description": workoutDescription
      });

      let response = await fetch("http://localhost/api/workout", {
        method: "POST",
        body: bodyContent,
        headers: headersList
      });

      let data = await response.json();
      console.log(data);
      this.routines[routineIndex].workouts[this.routines[routineIndex].workouts.length - 1].id = data.data.id;
    } catch (error) {
      console.error("Error al crear el entrenamiento:", error);
      throw error;
    }
  }
  async updateWorkout(routineId: number, workoutId: number, workoutName: string, workoutDescription: string): Promise<any> {
    try {
      let headersList = {
        "Authorization": "bearer " + sessionStorage.getItem("authToken"),
        "Content-Type": "application/json"
      }

      let bodyContent = JSON.stringify({
        "routine_id": routineId,
        "name": workoutName,
        "description": workoutDescription
      });

      let response = await fetch("http://localhost/api/workout/" + workoutId, {
        method: "PUT",
        body: bodyContent,
        headers: headersList
      });

      let data = await response.json();
      console.log(data);
    } catch (error) {
      console.error("Error al actualizar el entrenamiento:", error);
      throw error;
    }
  }
}