import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { WizardserviceComponent } from './wizardservice.component';

describe('WizardserviceComponent', () => {
  let component: WizardserviceComponent;
  let fixture: ComponentFixture<WizardserviceComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ WizardserviceComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(WizardserviceComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
