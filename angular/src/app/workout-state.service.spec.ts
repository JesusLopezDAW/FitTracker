import { TestBed } from '@angular/core/testing';

import { WorkoutStateService } from './workout-state.service';

describe('WorkoutStateService', () => {
  let service: WorkoutStateService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(WorkoutStateService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
