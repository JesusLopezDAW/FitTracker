import { CommonModule, DOCUMENT, isPlatformBrowser } from '@angular/common';
import { Component, Inject, OnInit, PLATFORM_ID, Renderer2 } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, RouterModule } from '@angular/router';
import { MatBottomSheet } from '@angular/material/bottom-sheet';
import { MatBottomSheetModule } from '@angular/material/bottom-sheet';
import { MatButtonModule } from '@angular/material/button';
import { StartWorkoutComponent } from '../start-workout/start-workout.component';

@Component({
  selector: 'app-workout',
  standalone: true,
  imports: [FormsModule, CommonModule, RouterModule, MatBottomSheetModule, MatButtonModule],
  templateUrl: './workout.component.html',
  styleUrls: ['./workout.component.css']
})
export class WorkoutComponent implements OnInit {
  workoutId: string = '';
  menuOpen: boolean = false;

  exercises = [
    {
      name: 'Iso-Lateral Chest Press (Machine)',
      image: 'path/to/image1.png',
      sets: 4,
      reps: '9-12',
      rest: '2min 30s'
    },
    {
      name: 'Incline Bench Press (Dumbbell)',
      image: 'path/to/image2.png',
      sets: 4,
      reps: '9-10',
      rest: '2min 30s'
    },
    {
      name: 'Chest Fly (Machine)',
      image: 'path/to/image3.png',
      sets: 4,
      reps: '10-11',
      rest: '2min 30s'
    },
    {
      name: 'Chest Fly (Band)',
      image: '',
      sets: 4,
      reps: '10-11',
      rest: '2min 30s'
    }
  ];
  private isBrowser: boolean;
  constructor(private route: ActivatedRoute, private bottomSheet: MatBottomSheet, @Inject(DOCUMENT) private document: Document, private renderer: Renderer2, @Inject(PLATFORM_ID) private platformId: Object,) {
    this.isBrowser = isPlatformBrowser(platformId);
  }

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      this.workoutId = params.get('id')!;
      // Aquí puedes usar workoutId para cargar los datos del workout
    });
    if (this.isBrowser) {
      this.checkSize();
      this.renderer.listen('window', 'resize', () => this.checkSize());
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
    this.bottomSheet.open(StartWorkoutComponent, {
      hasBackdrop: true,
      panelClass: 'fullscreen-bottom-sheet'
    });
  }
}
