import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ImportComponent } from './components/pokemon/import/import.component';
import { ImportPokemonsComponent } from './components/import-pokemons/import-pokemons.component';

@NgModule({
  declarations: [
    AppComponent,
    ImportComponent,
    ImportPokemonsComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
