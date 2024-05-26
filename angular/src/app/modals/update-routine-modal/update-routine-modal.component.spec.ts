import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdateRoutineModalComponent } from './update-routine-modal.component';

describe('UpdateRoutineModalComponent', () => {
  let component: UpdateRoutineModalComponent;
  let fixture: ComponentFixture<UpdateRoutineModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [UpdateRoutineModalComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(UpdateRoutineModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
