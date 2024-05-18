import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PostComponent } from '../post/post.component';
import { SuggestionsComponent } from '../suggestions/suggestions.component';
import { NavbarComponent } from '../navbar/navbar.component';
import { ProfileComponent } from '../profile/profile.component';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [CommonModule, PostComponent, SuggestionsComponent, NavbarComponent, ProfileComponent],
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  postsForYou = [
    { id: 1, author: 'Author 1', content: 'Para ti Post 1', image: 'https://via.placeholder.com/50', postImage: 'https://via.placeholder.com/600x300' },
    { id: 2, author: 'Author 2', content: 'Para ti Post 2', image: 'https://via.placeholder.com/50', postImage: 'https://via.placeholder.com/600x300' }
  ];

  postsFollowing = [
    { id: 1, author: 'Author 1', content: 'Siguiendo Post 1', image: 'https://via.placeholder.com/50', postImage: 'https://via.placeholder.com/600x300' },
    { id: 2, author: 'Author 2', content: 'Siguiendo Post 2', image: 'https://via.placeholder.com/50', postImage: 'https://via.placeholder.com/600x300' }
  ];

  showForYou = true;

  constructor() { }

  async ngOnInit(): Promise<void> {
    await this.fetchData();
  }

  async fetchData(): Promise<void> {
    const headersList = {
      "Accept": "*/*",
      "User-Agent": "Thunder Client (https://www.thunderclient.com/)",
      "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTcxNjA2NTQ1NywiZXhwIjoxNzE2MDY5MDU3LCJuYmYiOjE3MTYwNjU0NTcsImp0aSI6InlLMWM2UWtRbUZES3RSWHIiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.4UVFnHpnvTSbyBjr7NYcnPZMv3GDljL52VGOtKTk254",
      "post_id": "1",
      "Content-Type": "application/json"
    };


    try {
      let response = await fetch("http://localhost/api/feed", {
        method: "GET",
        headers: headersList,
      });
      let data = await response.json();
      const posts = data.data.data;
      console.log(data.data.data);
      // Asumiendo que `data` es un array de posts
      this.postsForYou = posts.map((post: any) => ({
        id: post.id,
        author: post.name,
        content: post.title,
        image: 'https://via.placeholder.com/50', // puedes cambiar esto si tienes la URL de la imagen del autor
        postImage: post.image
      }));
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

  togglePosts(showForYou: boolean) {
    this.showForYou = showForYou;
  }
}
