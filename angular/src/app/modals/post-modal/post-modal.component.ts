import { CommonModule } from '@angular/common';
import { Component, Input, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-post-modal',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './post-modal.component.html',
  styleUrls: ['./post-modal.component.css']
})
export class PostModalComponent implements OnInit {
  @Input() post: any;
  @Input() post_id?: number;
  @Input() workout_id?: number;
  newComment: string = '';
  comments: any[] = [];
  isLoading: boolean = true;
  isLoadingComments: boolean = false;
  constructor(public activeModal: NgbActiveModal) { }

  ngOnInit(): void {
    this.fetchPostData();
    this.isLoading = true;
    this.isLoadingComments = false;
  }

  async fetchPostData() {
    await this.getPostData();
    await this.getCommentsData();
    this.isLoading = false;
  }

  async addComment() {
    if (this.newComment.trim()) {
      this.isLoadingComments = true;
      console.log('Adding comment:', this.newComment);
      let headersList = {
        "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
        "Content-Type": "application/json"
      }

      let bodyContent = JSON.stringify({
        "post_id": this.post_id,
        "content": this.newComment
      });

      let response = await fetch("http://localhost/api/comments", {
        method: "POST",
        body: bodyContent,
        headers: headersList
      });

      let data = await response.json();
      console.log(data);
      this.newComment = '';
      this.getCommentsData();
    }
    
  }

  closeModal() {
    this.activeModal.dismiss();
  }

  async getPostData() {
    let headersList = {
      "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    }

    let bodyContent = JSON.stringify({
      "post_id": this.post_id,
      "workout_id": this.workout_id
    });

    let response = await fetch("http://localhost/api/logs/byWorkout", {
      method: "POST",
      body: bodyContent,
      headers: headersList
    });

    let data = await response.json();
    this.post = data.data.postData[0];
  }

  async getCommentsData() {
    let headersList = {
      "Authorization": "Bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    }
    let response = await fetch("http://localhost/api/comments/" + this.post_id, {
      method: "GET",
      headers: headersList
    });

    let data = await response.json();
    console.log(data.data);
    this.comments = [];
    data.data.forEach((element: any) => {
      const comment = {
        "user_id": element.user.id,
        "user_image": element.user.profile_photo_path,
        "username": element.user.username,
        "comment": element.comment
      };
      this.comments.push(comment);
    });
    this.isLoadingComments = false;
  }
}
