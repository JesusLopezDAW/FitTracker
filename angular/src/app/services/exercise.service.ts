// src/app/services/exercise.service.ts
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ExerciseService {
  private apiUrl = 'http://localhost/api/exercise';

  constructor(private http: HttpClient) {}

  getExercises(): Observable<any> {
    return this.http.get(this.apiUrl);
  }
}
