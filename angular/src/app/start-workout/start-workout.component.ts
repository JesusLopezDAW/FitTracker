import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MatBottomSheetRef } from '@angular/material/bottom-sheet';

interface Exercise {
  name: string;
  image: string;
  sets: Set[];
}

interface Set {
  previous: string;
  kg: number;
  reps: number;
  completed: boolean;
}

@Component({
  selector: 'app-start-workout',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './start-workout.component.html',
  styleUrls: ['./start-workout.component.css']
})
export class StartWorkoutComponent implements OnInit {
  duration: number = 0; // Duration in seconds
  totalVolume: number = 0;
  totalSets: number = 0;
  timer: any;
  completedSets: number = 0;

  exercises: Exercise[] = [
    {
      name: 'Press de Pecho Iso-Lateral (Máquina)',
      image: 'path/to/image1.png',
      sets: [
        { previous: '90kg x 12', kg: 90, reps: 12, completed: false },
        { previous: '90kg x 9', kg: 90, reps: 9, completed: false },
        { previous: '90kg x 9', kg: 90, reps: 9, completed: false },
        { previous: '90kg x 9', kg: 90, reps: 9, completed: false }
      ]
    },
    {
      name: 'Press de Banca Inclinado (Mancuerna)',
      image: 'path/to/image2.png',
      sets: [
        { previous: '27.5kg x 10', kg: 27.5, reps: 10, completed: false },
        { previous: '27.5kg x 10', kg: 27.5, reps: 10, completed: false },
        { previous: '27.5kg x 9', kg: 27.5, reps: 9, completed: false },
        { previous: '27.5kg x 9', kg: 27.5, reps: 9, completed: false }
      ]
    }
  ];

  constructor(private bottomSheetRef: MatBottomSheetRef<StartWorkoutComponent>) { }

  ngOnInit(): void {
    this.startTimer();
    this.updateTotals();
  }

  close(): void {
    this.bottomSheetRef.dismiss();
  }

  startTimer() {
    this.timer = setInterval(() => {
      this.duration++;
    }, 1000);
  }

  formatDuration(duration: number): string {
    const hours = Math.floor(duration / 3600);
    const minutes = Math.floor((duration % 3600) / 60);
    const seconds = duration % 60;

    let formatted = '';
    if (hours > 0) {
      formatted += `${hours}h `;
    }
    if (minutes > 0) {
      formatted += `${minutes}min `;
    }
    formatted += `${seconds}s`;

    return formatted;
  }

  toggleSetCompletion(exerciseIndex: number, setIndex: number) {
    const set = this.exercises[exerciseIndex].sets[setIndex];
    set.completed = !set.completed;
    this.updateTotals();
  }

  deleteSet(exerciseIndex: number, setIndex: number) {
    this.exercises[exerciseIndex].sets.splice(setIndex, 1);
    this.updateTotals();
  }

  updateTotals() {
    this.totalVolume = this.exercises.reduce((total, exercise) => {
      return total + exercise.sets.reduce((setTotal, set) => {
        return setTotal + (set.completed ? set.kg * set.reps : 0);
      }, 0);
    }, 0);

    this.totalSets = this.exercises.reduce((total, exercise) => {
      return total + exercise.sets.length;
    }, 0);

    this.completedSets = this.exercises.reduce((total, exercise) => {
      return total + exercise.sets.filter(set => set.completed).length;
    }, 0);
  }

  addSet(exerciseIndex: number) {
    const lastSet = this.exercises[exerciseIndex].sets[this.exercises[exerciseIndex].sets.length - 1];
    this.exercises[exerciseIndex].sets.push({ ...lastSet, completed: false });
    this.updateTotals();
  }
}
