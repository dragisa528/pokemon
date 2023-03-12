import { TestBed } from '@angular/core/testing';

import { ImportPokemonsService } from './import-pokemons.service';

describe('ImportPokemonsService', () => {
  let service: ImportPokemonsService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ImportPokemonsService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
