import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Error404ComponentComponent } from './error404-component.component';

describe('Error404ComponentComponent', () => {
  let component: Error404ComponentComponent;
  let fixture: ComponentFixture<Error404ComponentComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [Error404ComponentComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(Error404ComponentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
