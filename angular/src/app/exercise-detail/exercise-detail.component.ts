import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ExerciseDetailService } from '../services/exercise-detail.service';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-exercise-detail',
  standalone: true,
  imports: [RouterModule],
  templateUrl: './exercise-detail.component.html',
  styleUrls: ['./exercise-detail.component.css']
})
export class ExerciseDetailComponent implements OnInit {

  exercise: any;

  constructor(
    private route: ActivatedRoute,
    private exerciseService: ExerciseDetailService,
    private router: Router
  ) { }

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.exerciseService.getExercise(id).subscribe(data => {
        this.exercise = data.data;
        console.log(this.exercise)
      });
    }
  }

  goBack(): void {
    this.router.navigate(['/exercises']);
  }
}
