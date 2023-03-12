import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ImportPokemonComponent } from './import-pokemon.component';

describe('ImportPokemonComponent', () => {
  let component: ImportPokemonComponent;
  let fixture: ComponentFixture<ImportPokemonComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ImportPokemonComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ImportPokemonComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
