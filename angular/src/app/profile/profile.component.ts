import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PostsComponent } from './posts/posts.component';
import { ActivatedRoute, RouterModule } from '@angular/router';
import { Error404ComponentComponent } from '../error404-component/error404-component.component';
import { Subscription } from 'rxjs';


@Component({
  selector: 'app-profile',
  standalone: true,
  imports: [CommonModule, PostsComponent, RouterModule, Error404ComponentComponent],
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent {
  activeSection: string = 'posts';
  profile: any = [];
  following: string = '';
  followers: string = '';
  posts: string = '';
  userId: string = '';
  userExist: boolean = true;
  follow: boolean = false;

  isYou: boolean = false;
  private routeSub?: Subscription;

  constructor(
    private route: ActivatedRoute,

  ) { }

  ngOnInit(): void {
    this.routeSub = this.route.paramMap.subscribe(params => {
      this.getIsYou();
      this.getUser();
      this.isFollow();
      this.getFollowers();
      this.getFollowing();
      this.getPosts();
    })
  }

  showSection(section: string) {
    this.activeSection = section;
  }

  isActive(section: string): boolean {
    return this.activeSection === section;
  }

  async getUser() {
    if (this.isYou) {

      try {
        const token = sessionStorage.getItem("authToken")

        let headersList = {

          "Accept": "*/*",
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        }

        let response = await fetch("http://localhost/api/user/profile", {
          method: "GET",
          headers: headersList
        });

        let data = await response.json();
        console.log(data.data);
        this.profile = data.data;
      } catch (error) {
        console.error('Error fetching exercises:', error);
      }
    } else {
      try {
        const token = sessionStorage.getItem("authToken")

        let headersList = {

          "Accept": "*/*",
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        }

        let response = await fetch("http://localhost/api/user/profile/" + this.userId, {
          method: "GET",
          headers: headersList
        });

        let data = await response.json();
        console.log(data.data);
        this.profile = data.data;
      } catch (error) {
        console.error('Error fetching exercises:', error);
        this.userExist = false;
        console.error(this.userExist)
      }
    }
  }

  async getFollowers() {
    if (this.isYou) {
      try {
        const token = sessionStorage.getItem("authToken")

        let headersList = {
          "Accept": "*/*",
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        }

        let response = await fetch("http://localhost/api/followers/count", {
          method: "GET",
          headers: headersList
        });

        let data = await response.json();
        console.log(data.data);
        this.followers = data.data;
      } catch (error) {
        console.error('Error fetching exercises:', error);
      }
    } else {
      try {
        const token = sessionStorage.getItem("authToken")

        let headersList = {
          "Accept": "*/*",
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        }

        let response = await fetch("http://localhost/api/followers/count/" + this.userId, {
          method: "GET",
          headers: headersList
        });

        let data = await response.json();
        console.log(data.data);
        this.followers = data.data;
      } catch (error) {
        console.error('Error fetching exercises:', error);
      }
    }
  }

  async getFollowing() {
    if (this.isYou) {
      try {
        const token = sessionStorage.getItem("authToken")

        let headersList = {
          "Accept": "*/*",
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        }

        let response = await fetch("http://localhost/api/following/count", {
          method: "GET",
          headers: headersList
        });

        let data = await response.json();
        console.log(data.data);
        this.following = data.data;

      } catch (error) {
        console.error('Error fetching exercises:', error);
      }
    } else {
      try {
        const token = sessionStorage.getItem("authToken")

        let headersList = {
          "Accept": "*/*",
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        }

        let response = await fetch("http://localhost/api/following/count/" + this.userId, {
          method: "GET",
          headers: headersList
        });

        let data = await response.json();
        console.log(data.data);
        this.following = data.data;

      } catch (error) {
        console.error('Error fetching exercises:', error);
      }
    }
  }

  async getPosts() {
    if (this.isYou) {
      try {
        const token = sessionStorage.getItem("authToken")

        let headersList = {
          "Accept": "*/*",
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        }

        let response = await fetch("http://localhost/api/posts/count", {
          method: "GET",
          headers: headersList
        });

        let data = await response.json();
        console.log(data.data);
        this.posts = data.data;

      } catch (error) {
        console.error('Error fetching exercises:', error);
      }
    } else {
      try {
        const token = sessionStorage.getItem("authToken")

        let headersList = {
          "Accept": "*/*",
          "Content-Type": "application/json",
          "Authorization": `Bearer ${token}`
        }

        let response = await fetch("http://localhost/api/posts/count/" + this.userId, {
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

  getIsYou() {
    this.route.paramMap.subscribe(params => {
      this.userId = params.get('id')!;
      console.log('User id' + this.userId)
    });
    this.isYou = this.userId ? false : true;
    console.log(this.isYou)
  }

  async isFollow(){
    
    try {
      const token = sessionStorage.getItem("authToken")

      let headersList = {
        "Accept": "*/*",
        "Content-Type": "application/json",
        "Authorization": `Bearer ${token}`
      }

      let response = await fetch("http://localhost/api/follow/user/" + this.userId, { 
        method: "GET",
        headers: headersList
      });
      
      let data = await response.json();
      console.log('Es: ' + data);
      this.follow = data.data;

    } catch (error) {
      console.error('Error fetching exercises:', error);
    }
  }

  async toggleFollow() {
    console.log('TOGGLE')
    if (this.follow) {
      await this.unfollow(this.userId);
      await this.getFollowing();
    } else {
      await this.follows(this.userId);
      await this.getFollowing();
    }
    this.follow = !this.follow;
  }

  async follows(id: string){
    try {
      const token = sessionStorage.getItem("authToken")

      let headersList = {
        "Accept": "*/*",
        "Content-Type": "application/json",
        "Authorization": `Bearer ${token}`
      }

      let response = await fetch("http://localhost/api/follow/"+id, {
        method: "POST",
        headers: headersList
      });

      let data = await response.json();
      console.log(data)

    } catch (error) {
      console.error('Error fetching exercises:', error);
    }
  }

  async unfollow(id: string){
    try {
      const token = sessionStorage.getItem("authToken")

      let headersList = {
        "Accept": "*/*",
        "Content-Type": "application/json",
        "Authorization": `Bearer ${token}`
      }

      let response = await fetch("http://localhost/api/unfollow/"+id, {
        method: "POST",
        headers: headersList
      });

      let data = await response.json();
      console.log(data)
    } catch (error) {
      console.error('Error fetching exercises:', error);
    }
  }

}
