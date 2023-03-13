import { Component, OnInit } from '@angular/core';
import { HttpEventType, HttpResponse } from '@angular/common/http';
import { ImportPokemonService } from 'src/app/services/import-pokemon.service';

@Component({
  selector: 'app-import-pokemon',
  templateUrl: './import-pokemon.component.html',
  styleUrls: ['./import-pokemon.component.css']
})

export class ImportPokemonComponent implements OnInit 
{

  selectedFiles ?:FileList;
  currentFile   ?:File;
  pokemons      ?:any;

  progress = 0;
  message  = '';
  success  = false;

  constructor(private service: ImportPokemonService) { }

  ngOnInit(): void {
    this.refresh();
  }

  refresh(url?:string): void {
    this.service
    .getPokemons(url)
    .subscribe(pokemons => {
      this.pokemons = pokemons;
    });
  }

  previous():void {
    if(this.pokemons && this.pokemons.links.prev) {
      this.refresh(this.pokemons.links.prev);
    }
  }

  next():void {
    if(this.pokemons && this.pokemons.links.next) {
      this.refresh(this.pokemons.links.next);
    } 
  }

  selectFile(event: any): void {
    this.selectedFiles = event.target.files;
  }

  alertError(message:string): void {
    this.message = message;
    this.success = false;
  }

  alertSuccess(message:string): void {
    this.message = message;
    this.success = true;
  }

  import(): void 
  {
    this.progress = 0;

    if (this.selectedFiles) 
    {
      const file: File | null = this.selectedFiles.item(0);

      //@todo validate file type

      if (file) {
        this.currentFile = file;

        this.service
          .import(this.currentFile)
          .subscribe({
            next: (event: any) => {
              if (event.type === HttpEventType.UploadProgress) {
                this.progress = Math.round(100 * event.loaded / event.total);
              } else if (event instanceof HttpResponse) {
                this.alertSuccess('CSV imported succeeded!');
                this.refresh();
              }
            },
            error: (err: any) => {
              console.log(err);
              this.progress = 0;

              if (err.error && err.error.message) {
                this.alertError(err.error.message);
              } else {
                this.alertError('Could not upload the file!');
              }
              this.currentFile = undefined;
            }
          });
      }

      this.selectedFiles = undefined;
    }
  }
}