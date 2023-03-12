import { Component, OnInit } from '@angular/core';
import { HttpEventType, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { ImportPokemonService } from 'src/app/services/import-pokemon.service';

@Component({
  selector: 'app-import-pokemon',
  templateUrl: './import-pokemon.component.html',
  styleUrls: ['./import-pokemon.component.css']
})

export class ImportPokemonComponent implements OnInit 
{

  selectedFiles ?:FileList;
  currentFile   ?: File;
  pokemons      ?: Observable<any>;

  progress = 0;
  message  = '';

  constructor(private importPokemonService: ImportPokemonService) { }

  ngOnInit(): void {
    this.refresh();
  }

  /**
   * Fetch pokemons from the server
   */
  refresh(): void {
    this.pokemons = this.importPokemonService.pokemons();
  }

  selectFile(event: any): void {
    this.selectedFiles = event.target.files;
  }

  import(): void 
  {
    this.progress = 0;

    if (this.selectedFiles) 
    {
      const file: File | null = this.selectedFiles.item(0);

      //todo validate file type

      if (file) {
        this.currentFile = file;

        this.importPokemonService
          .import(this.currentFile)
          .subscribe({
            next: (event: any) => {
              if (event.type === HttpEventType.UploadProgress) {
                this.progress = Math.round(100 * event.loaded / event.total);
              } else if (event instanceof HttpResponse) {
                this.message = event.body.message;
                this.refresh();
              }
            },

            error: (err: any) => {
              console.log(err);
              this.progress = 0;

              // if (err.error && err.error.message) {
              //   this.message = err.error.message;
              // } else {
              //   this.message = 'Could not upload the file!';
              // }
              this.currentFile = undefined;
            }
          });
      }

      this.selectedFiles = undefined;
    }
  }
}