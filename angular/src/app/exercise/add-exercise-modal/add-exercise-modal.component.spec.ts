import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AddExerciseModalComponent } from './add-exercise-modal.component';

describe('AddExerciseModalComponent', () => {
  let component: AddExerciseModalComponent;
  let fixture: ComponentFixture<AddExerciseModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [AddExerciseModalComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(AddExerciseModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
