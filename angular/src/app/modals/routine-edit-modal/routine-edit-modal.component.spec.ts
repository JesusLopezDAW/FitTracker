import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RoutineEditModalComponent } from './routine-edit-modal.component';

describe('RoutineEditModalComponent', () => {
  let component: RoutineEditModalComponent;
  let fixture: ComponentFixture<RoutineEditModalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [RoutineEditModalComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(RoutineEditModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
