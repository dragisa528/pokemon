import { Injectable } from '@angular/core';
import { HttpClient, HttpRequest, HttpEvent } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class ImportPokemonService 
{
  constructor(private http: HttpClient) { }

  getBaseUrl() {
    const url = new URL(window.location.href.split('?')[0]);
    url.port = '';
    const baseUrl = url.toString();

    if(baseUrl == 'http://localhost/')  {
      return 'http://127.0.0.1/api/pokemons';
    }

    return baseUrl + 'api/pokemons';
  }

  /**
   * Import pokemons from CSV
   * 
   * @param file 
   * @returns 
   */
  import(pokemons: File): Observable<HttpEvent<any>> 
  {
    const url      :string   = this.getBaseUrl() + 'import'; 
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
  getPokemons(url?:string): Observable<any> {
    url = url ?? this.getBaseUrl();
    return this.http.get(url);
  }
}