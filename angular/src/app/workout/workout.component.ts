import { CommonModule, DOCUMENT, isPlatformBrowser } from '@angular/common';
import { Component, Inject, OnInit, PLATFORM_ID, Renderer2 } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, RouterModule } from '@angular/router';
import { MatBottomSheet } from '@angular/material/bottom-sheet';
import { MatBottomSheetModule } from '@angular/material/bottom-sheet';
import { MatButtonModule } from '@angular/material/button';
import { StartWorkoutComponent } from '../start-workout/start-workout.component';
import { WorkoutStateService } from '../workout-state.service';
import { Error404ComponentComponent } from '../error404-component/error404-component.component';

@Component({
  selector: 'app-workout',
  standalone: true,
  imports: [FormsModule, CommonModule, RouterModule, MatBottomSheetModule, MatButtonModule, Error404ComponentComponent],
  templateUrl: './workout.component.html',
  styleUrls: ['./workout.component.css']
})
export class WorkoutComponent implements OnInit {
  workoutId: string = '';
  menuOpen: boolean = false;
  workoutInProgress: boolean = false;
  isLoading: boolean = true;

  exercises: any[] = [];

  private isBrowser: boolean;

  constructor(
    private route: ActivatedRoute,
    private bottomSheet: MatBottomSheet,
    @Inject(DOCUMENT) private document: Document,
    private renderer: Renderer2,
    @Inject(PLATFORM_ID) private platformId: Object,
    public workoutState: WorkoutStateService
  ) {
    this.isBrowser = isPlatformBrowser(platformId);
  }

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      this.workoutId = params.get('id')!;
      this.getExercises(this.workoutId)
    });
    console.log(this.exercises)
    if (this.isBrowser) {
      this.checkSize();
      this.renderer.listen('window', 'resize', () => this.checkSize());
    }
    this.workoutState.workoutInProgressChanged.subscribe((inProgress: boolean) => {
      this.workoutInProgress = inProgress;
    });
  }

  async getExercises(id: string) {
    const token = sessionStorage.getItem("authToken")

    let headersList = {
      "Accept": "*/*",
      "Content-Type": "application/json",
      "Authorization": `Bearer ${token}`
    }
    try {

      let response = await fetch("http://localhost/api/workout-logs/" + id, {
        method: "GET",
        headers: headersList
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      let data = await response.json();
      this.exercises = data.data;
      console.log(this.exercises)

    } catch (error) {
      console.error('Error fetching exercises:', error);
      this.exercises = [];
    } finally {
      this.isLoading = false; // Desactivar el estado de carga una vez obtenidos los datos
    }


  }

  checkSize() {
    const button = this.document.getElementById("btn-startWorkout-mobile") as HTMLElement;
    if (window.innerWidth <= 992) {
      button.removeAttribute("hidden");
    } else {
      button.setAttribute("hidden", "true");
    }
  }

  toggleMenu() {
    this.menuOpen = !this.menuOpen;
  }

  closeMenu() {
    this.menuOpen = false;
  }

  copyRoutineLink() {
    console.log('Copy Routine Link');
  }

  editRoutine() {
    console.log('Edit Routine');
  }

  deleteRoutine() {
    console.log('Delete Routine');
  }

  openBottomSheet(): void {
    const bottomSheetRef = this.bottomSheet.open(StartWorkoutComponent, {
      hasBackdrop: true,
      panelClass: 'fullscreen-bottom-sheet'
    });

    bottomSheetRef.instance.workoutClosed.subscribe((wasPaused: boolean) => {
      this.workoutInProgress = wasPaused;
    });
  }

  resumeWorkout(): void {
    this.openBottomSheet();
  }

  discardWorkout(): void {
    this.workoutInProgress = false;
    this.workoutState.stopTimer();
    this.workoutState.reset();
  }
}
