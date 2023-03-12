import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ImportPokemonsComponent } from './import-pokemons.component';

describe('ImportPokemonsComponent', () => {
  let component: ImportPokemonsComponent;
  let fixture: ComponentFixture<ImportPokemonsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ImportPokemonsComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ImportPokemonsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
