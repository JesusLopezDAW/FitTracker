import { Injectable, EventEmitter } from '@angular/core';

@Injectable({
  providedIn: 'root'
})

export class WorkoutStateService {
  workoutInProgressChanged = new EventEmitter<boolean>();
  duration: number = 0; // Duration in seconds
  totalVolume: number = 0;
  totalSets: number = 0;
  completedSets: number = 0;
  timer: any;
  endTime: string = '';
  id: string | null = null;
  exercises = [
    {
      id: 1,
      name: '',
      image: '',
      sets: [
        { kg: 0, reps: 0, completed: false },
        { kg: 0, reps: 0, completed: false },
        { kg: 0, reps: 0, completed: false },
        { kg: 0, reps: 0, completed: false }
      ]
    }
  ];

  setWorkoutId(id: string) {
    this.id = id;
    this.initializeExercises(this.id)
  }

  async initializeExercises(id: string | null) {
    let token = sessionStorage.getItem("authToken");
    let headersList = {
      "Accept": "*/*",
      "Content-Type": "application/json",
      "Authorization": `Bearer ${token}`
    };

    try {
      let response = await fetch("http://localhost/api/routine-workout/" + id, {
        method: "GET",
        headers: headersList
      });

      if (response.ok) {
        let data = await response.json();
        this.exercises = data.data.map((exercise: any) => {
          return {
            id: exercise.exercise.id,
            name: exercise.exercise.name,
            image: exercise.exercise.image,
            sets: [{ kg: 0, reps: 0, completed: false }]
          };
        });
      } else {
        console.error('Error en la respuesta de la petición:', response.statusText);
      }
    } catch (error) {
      console.error('There has been a problem with your fetch operation:', error);
    }
  }

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
