import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-routine-details',
  imports: [CommonModule],
  templateUrl: './routine-details.component.html',
  styleUrls: ['./routine-details.component.css'],
  standalone: true
})
export class RoutineDetailsComponent implements OnInit {
  routineId: number = 0;  // Inicializamos con un valor predeterminado
  exercises = [
    { name: 'T Bar Row', sets: 4, reps: '9-12', rest: '2min 30s' },
    { name: 'Lat Pulldown (Cable)', sets: 4, reps: '9-12', rest: '2min 30s' },
    { name: 'Seated Cable Row - Bar Wide Grip', sets: 3, reps: '', rest: '2min 30s' },
    { name: 'Single Arm Cable Row', sets: 4, reps: '9-10', rest: '2min 0s' },
    { name: 'Straight Arm Lat Pulldown (Cable)', sets: 4, reps: '10', rest: '2min 0s' }
  ];

  constructor(private route: ActivatedRoute) { }

  ngOnInit() {
    this.route.params.subscribe(params => {
      this.routineId = +params['id'];
      // Aquí puedes hacer una llamada al servidor para obtener los detalles de la rutina
    });
  }
}
