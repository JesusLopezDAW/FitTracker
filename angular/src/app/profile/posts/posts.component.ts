import { Component, OnInit, Input } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';


@Component({
  selector: 'app-posts',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.css']
})
export class PostsComponent implements OnInit {
  posts: any = [];
  @Input() userId: any = null;

  constructor() { }

  ngOnInit(): void {
    this.getPosts();
  }

  async getPosts() {
    if(this.userId){
      try {
        const token = sessionStorage.getItem("authToken")
  
        let headersList = {
          "Accept": "*/*",
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        }
  
        let response = await fetch("http://localhost/api/user/posts/" + this.userId, {
          method: "GET",
          headers: headersList
        });
  
        let data = await response.json();
        console.log(data.data);
        this.posts = data.data;
  
      } catch (error) {
        console.error('Error fetching exercises:', error);
      }
    }else{
      try {
        const token = sessionStorage.getItem("authToken")
  
        let headersList = {
          "Accept": "*/*",
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        }
  
        let response = await fetch("http://localhost/api/posts", {
          method: "GET",
          headers: headersList
        });
  
        let data = await response.json();
        console.log(data.data);
        this.posts = data.data;
  
      } catch (error) {
        console.error('Error fetching exercises:', error);
      }
    }
    }
    
}
