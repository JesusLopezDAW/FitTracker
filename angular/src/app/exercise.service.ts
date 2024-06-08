import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ExerciseService {
  private exercisesUpdatedSource = new Subject<void>();
  exercisesUpdated$ = this.exercisesUpdatedSource.asObservable();

  notifyExercisesUpdated() {
    this.exercisesUpdatedSource.next();
  }
}
