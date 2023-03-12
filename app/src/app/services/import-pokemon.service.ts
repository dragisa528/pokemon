import { Injectable } from '@angular/core';
import { HttpClient, HttpRequest, HttpEvent } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class ImportPokemonService 
{
  private baseUrl = 'http://api.pokemon.test/api/pokemons';

  constructor(private http: HttpClient) { }

  /**
   * Import pokemons from CSV
   * 
   * @param file 
   * @returns 
   */
  import(pokemons: File): Observable<HttpEvent<any>> 
  {
    const url      :string   = `${this.baseUrl}/import`;
    const formData :FormData = new FormData();

    formData.append('pokemons', pokemons);

    const req = new HttpRequest('POST', url, formData, {
      reportProgress: true,
      responseType: 'json'
    });

    return this.http.request(req);
  }

  /**
   * Fetch pokemons
   * 
   * @returns 
   */
  pokemons(): Observable<any> {
    return this.http.get(`${this.baseUrl}`);
  }
}