import { Component, NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-search-bar',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './search-bar.component.html',
  styleUrl: './search-bar.component.css'
})
export class SearchBarComponent {
  mostrarDiv: boolean = false;
  query: string = '';
  exercises: any[] = [];

  toggleDiv() {
    this.mostrarDiv = !this.mostrarDiv;
  }

  onInputChange = async (event: Event) => {
    const input = event.target as HTMLInputElement;
    console.log(input.value);

    if (input.value.length > 1) {
      const baseUrl = "http://localhost/api/search/exercise";
      const queryParam = encodeURIComponent(input.value);
      const url = `${baseUrl}?query=${queryParam}`;

      try {
        const response = await fetch(url, {
          method: "GET",
          headers: {
            "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
            "Content-Type": "application/json"
          }
        });

        if (response.ok) {
          const responseData = await response.json();
          console.log(responseData.data.data);
          this.exercises = responseData.data.data;
        } else {
          console.error('Error en la respuesta de la petición:', response.statusText);
        }
      } catch (error) {
        console.error('There has been a problem with your fetch operation:', error);
      }
    }else if(input.value.length == 0){
      this.exercises = [];
    }
  }

}
