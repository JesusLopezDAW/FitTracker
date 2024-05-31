import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreateRoutineModalComponent } from './create-routine-modal.component';

describe('CreateRoutineModalComponent', () => {
  let component: CreateRoutineModalComponent;
  let fixture: ComponentFixture<CreateRoutineModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CreateRoutineModalComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(CreateRoutineModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
