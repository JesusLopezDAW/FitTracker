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

  ngOnInit(): void { }

  togglePosts(showForYou: boolean) {
    this.showForYou = showForYou;
  }
}
