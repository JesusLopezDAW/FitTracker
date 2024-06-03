import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ExerciseDetailService {

  private apiUrl = 'http://localhost/api/exercise';

  constructor(private http: HttpClient) { }

  getExercise(id: string): Observable<any> {
    return this.http.get(`${this.apiUrl}/${id}`);
  }
}
