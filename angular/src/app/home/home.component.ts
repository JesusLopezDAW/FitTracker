import { Component, Inject, OnInit } from '@angular/core';
import { CommonModule, DOCUMENT } from '@angular/common';
import { PostComponent } from './post/post.component';
import { SuggestionsComponent } from './suggestions/suggestions.component';
import { NavbarComponent } from '../navbar/navbar.component';
import { ProfileComponent } from './profile/profile.component';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [CommonModule, PostComponent, NavbarComponent, ProfileComponent, SuggestionsComponent],
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  postsForYou = [
    { id: 1, author: 'Author 1', content: 'Para ti Post 1', image: 'https://via.placeholder.com/50', postImage: 'https://via.placeholder.com/640x480', likes: 0, comments: 0, liked: false },
    { id: 2, author: 'Author 2', content: 'Para ti Post 2', image: 'https://via.placeholder.com/50', postImage: 'https://via.placeholder.com/640x480', likes: 0, comments: 0, liked: true }
  ];

  postsFollowing = [
    { id: 1, author: 'Author 1', content: 'Siguiendo Post 1', image: 'https://via.placeholder.com/50', postImage: 'https://via.placeholder.com/640x480', likes: 0, comments: 0, liked: false },
    { id: 2, author: 'Author 2', content: 'Siguiendo Post 2', image: 'https://via.placeholder.com/50', postImage: 'https://via.placeholder.com/640x480', likes: 0, comments: 0, liked: false }
  ];

  showForYou = true;

  constructor(@Inject(DOCUMENT) private document: Document) { }


  async ngOnInit(): Promise<void> {
    await this.postsParaTi();
    await this.postsSiguiendo();
  }

  async postsParaTi(): Promise<void> {
    const headersList = {
      "Accept": "*/*",
      "User-Agent": "Thunder Client (https://www.thunderclient.com/)",
      "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    };

    try {
      let response = await fetch("http://localhost/api/feed", {
        method: "GET",
        headers: headersList,
      });
      let data = await response.json();
      const posts = data.data.data;
      console.log(posts);
      this.postsForYou = [];
      this.postsForYou = posts.map((post: any) => ({
        id: post.id,
        author: post.user.username,
        content: post.title,
        image: post.user.profile_photo_path,
        postImage: post.image,
        likes: post.likes_count,
        comments: post.comments_count,
        liked: post.liked_by_user,
        workout_id: post.workout_id
      }));
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

  async postsSiguiendo(): Promise<void> {
    const headersList = {
      "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    };

    try {
      let response = await fetch("http://localhost/api/feed/followed", {
        method: "GET",
        headers: headersList,
      });
      let data = await response.json();
      const posts = data.data.data;
      console.log(posts);
      this.postsFollowing = [];
      this.postsFollowing = posts.map((post: any) => ({
        id: post.id,
        author: post.user.username,
        content: post.title,
        image: post.user.profile_photo_path,
        postImage: post.image,
        liked: post.liked_by_user,
        likes: post.likes_count,
        comments: post.comments_count,
        workout_id: post.workout_id
      }));
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

  togglePosts(showForYou: boolean) {
    this.showForYou = showForYou;
  }
}
