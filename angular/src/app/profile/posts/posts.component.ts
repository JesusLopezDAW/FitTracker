import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-posts',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.css']
})
export class PostsComponent implements OnInit {
  posts = [
    { id: 1, author: 'Author 1', content: 'Post 1', image: 'https://via.placeholder.com/150' },
    { id: 2, author: 'Author 2', content: 'Post 2', image: 'https://via.placeholder.com/150' },
    { id: 3, author: 'Author 3', content: 'Post 3', image: 'https://via.placeholder.com/150' },
    { id: 4, author: 'Author 4', content: 'Post 4', image: 'https://via.placeholder.com/150' },
    { id: 5, author: 'Author 5', content: 'Post 5', image: 'https://via.placeholder.com/150' },
    { id: 6, author: 'Author 6', content: 'Post 6', image: 'https://via.placeholder.com/150' },
    { id: 7, author: 'Author 7', content: 'Post 7', image: 'https://via.placeholder.com/150' },
    { id: 8, author: 'Author 8', content: 'Post 8', image: 'https://via.placeholder.com/150' },
    { id: 9, author: 'Author 9', content: 'Post 9', image: 'https://via.placeholder.com/150' }
  ];

  constructor() { }

  ngOnInit(): void { }
}
