import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-workout',
  standalone: true,
  imports: [FormsModule, CommonModule],
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

  constructor(private route: ActivatedRoute) { }

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      this.workoutId = params.get('id')!;
      // Aquí puedes usar workoutId para cargar los datos del workout
    });
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
}
