import { CommonModule } from '@angular/common';
import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MatBottomSheet, MatBottomSheetRef } from '@angular/material/bottom-sheet';
import { WorkoutStateService } from '../workout-state.service';
import { SaveWorkoutComponent } from '../save-workout/save-workout.component';

@Component({
  selector: 'app-start-workout',
  standalone: true,
  imports: [CommonModule, FormsModule, SaveWorkoutComponent],
  templateUrl: './start-workout.component.html',
  styleUrls: ['./start-workout.component.css']
})
export class StartWorkoutComponent implements OnInit {
  @Output() workoutClosed = new EventEmitter<boolean>();

  constructor(private bottomSheetRef: MatBottomSheetRef<StartWorkoutComponent>,
    public workoutState: WorkoutStateService,
    private bottomSheet: MatBottomSheet) { }

  ngOnInit(): void {
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
    this.workoutState.stopTimer();
    this.workoutState.setEndTime();
    this.bottomSheet.open(SaveWorkoutComponent, {
      hasBackdrop: true,
      panelClass: 'fullscreen-bottom-sheet'
    });
  }
}
