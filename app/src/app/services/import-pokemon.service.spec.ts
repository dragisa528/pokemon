import { TestBed } from '@angular/core/testing';

import { ImportPokemonService } from './import-pokemon.service';

describe('ImportPokemonService', () => {
  let service: ImportPokemonService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ImportPokemonService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
