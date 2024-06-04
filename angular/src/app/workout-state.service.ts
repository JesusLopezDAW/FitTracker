import { Injectable, EventEmitter } from '@angular/core';
import { StartWorkoutComponent } from './start-workout/start-workout.component';

@Injectable({
  providedIn: 'root'
})
export class WorkoutStateService {
  workoutInProgressChanged = new EventEmitter<boolean>();
  private startWorkoutComponent!: StartWorkoutComponent;
  duration: number = 0; // Duration in seconds
  totalVolume: number = 0;
  totalSets: number = 0;
  completedSets: number = 0;
  timer: any;
  endTime: string = '';
  exercises = [
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

  startTimer() {
    clearInterval(this.timer);
    this.timer = setInterval(() => {
      this.duration++;
    }, 1000);
  }

  stopTimer() {
    clearInterval(this.timer);
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

  reset() {
    this.duration = 0;
    this.totalVolume = 0;
    this.totalSets = 0;
    this.completedSets = 0;
    this.endTime = '';
    this.exercises.forEach(exercise => {
      exercise.sets.forEach(set => {
        set.kg = 0;
        set.reps = 0;
        set.completed = false;
      });
    });
  }

  discardWorkout() {
    this.stopTimer();
    this.reset();
  }
  
  getFormattedDate(): string {
    const now = new Date();
    return now.toLocaleString();
  }

  setEndTime() {
    this.endTime = this.getFormattedDate();
  }

}
