import { CommonModule } from '@angular/common';
import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MatBottomSheet, MatBottomSheetRef } from '@angular/material/bottom-sheet';
import { WorkoutStateService } from '../workout-state.service';
import { SaveWorkoutComponent } from '../save-workout/save-workout.component';
import { ActivatedRoute, RouterModule } from '@angular/router';
import { Inject } from '@angular/core';
import { MAT_BOTTOM_SHEET_DATA } from '@angular/material/bottom-sheet';



@Component({
  selector: 'app-start-workout',
  standalone: true,
  imports: [CommonModule, FormsModule, SaveWorkoutComponent, RouterModule],
  templateUrl: './start-workout.component.html',
  styleUrls: ['./start-workout.component.css']
})
export class StartWorkoutComponent implements OnInit {
  @Output() workoutClosed = new EventEmitter<boolean>();
  workoutId: string = '';
  constructor(@Inject(MAT_BOTTOM_SHEET_DATA) public data: any,
    private bottomSheetRef: MatBottomSheetRef<StartWorkoutComponent>,
    public workoutState: WorkoutStateService,
    private route: ActivatedRoute,
    private bottomSheet: MatBottomSheet) { }

  ngOnInit(): void {
    this.workoutId = this.data.workoutId;
    this.workoutState.startTimer();
    this.workoutState.updateTotals();
  }

  close(): void {
    this.workoutClosed.emit(true);
    this.bottomSheetRef.dismiss();
  }

  discard(): void {
    this.workoutState.stopTimer();
    this.workoutClosed.emit(false);
    this.bottomSheetRef.dismiss();
  }

  openSaveWorkout(): void {
    // console.log(this.workoutState.exercises);
    this.workoutState.stopTimer();
    this.workoutState.setEndTime();
    this.bottomSheet.open(SaveWorkoutComponent, {
      hasBackdrop: true,
      panelClass: 'fullscreen-bottom-sheet',
      data: { exercises: this.workoutState.exercises }  // Pasar los datos actualizados
    });
  }

}
