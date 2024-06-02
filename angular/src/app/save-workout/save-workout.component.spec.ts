import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SaveWorkoutComponent } from './save-workout.component';

describe('SaveWorkoutComponent', () => {
  let component: SaveWorkoutComponent;
  let fixture: ComponentFixture<SaveWorkoutComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [SaveWorkoutComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(SaveWorkoutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
