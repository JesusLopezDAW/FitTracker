import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdateWorkoutModalComponent } from './update-workout-modal.component';

describe('UpdateWorkoutModalComponent', () => {
  let component: UpdateWorkoutModalComponent;
  let fixture: ComponentFixture<UpdateWorkoutModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [UpdateWorkoutModalComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(UpdateWorkoutModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
