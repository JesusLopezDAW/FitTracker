import { TestBed } from '@angular/core/testing';

import { ExerciseDetailService } from './exercise-detail.service';

describe('ExerciseDetailService', () => {
  let service: ExerciseDetailService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ExerciseDetailService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
