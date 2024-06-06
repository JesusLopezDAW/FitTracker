import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ExerciseModalComponent } from './exercise-modal.component';

describe('ExerciseModalComponent', () => {
  let component: ExerciseModalComponent;
  let fixture: ComponentFixture<ExerciseModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ExerciseModalComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ExerciseModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
