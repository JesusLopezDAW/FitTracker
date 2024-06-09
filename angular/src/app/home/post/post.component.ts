import { Component, Inject, Input, OnInit } from '@angular/core';
import { CommonModule, DOCUMENT } from '@angular/common';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { PostModalComponent } from '../../modals/post-modal/post-modal.component';

@Component({
  selector: 'app-post',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './post.component.html',
  styleUrls: ['./post.component.css']
})
export class PostComponent implements OnInit {
  @Input() post: any;

  constructor(@Inject(DOCUMENT) private document: Document, private modalService: NgbModal) { }

  ngOnInit(): void {
  }

  toggleLike() {
    console.log(this.post);
    if (!this.post.liked) {
      this.post.likes++;
      this.addLike();
    } else {
      this.post.likes--;
      this.removeLike();
    }

    this.post.liked = !this.post.liked;
  }

  async addLike(): Promise<void> {
    let headersList = {
      "Accept": "*/*",
      "User-Agent": "Thunder Client (https://www.thunderclient.com)",
      "Authorization": "bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    }

    let bodyContent = JSON.stringify({
      "post_id": this.post.id
    });

    let response = await fetch("http://localhost/api/likes", {
      method: "POST",
      body: bodyContent,
      headers: headersList
    });

    let data = await response.json();
    console.log(data);
  }
  
  async removeLike(): Promise<void> {
    let headersList = {
      "Authorization": "bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    }

    let response = await fetch("http://localhost/api/likes/" + this.post.id, {
      method: "DELETE",
      headers: headersList
    });

    let data = await response.json();
    console.log(data);

  }

  showPost(post_id: number, workout_id: number) {
    const modalRef = this.modalService.open(PostModalComponent, { size: 'lg' });
    modalRef.componentInstance.post_id = post_id;
    modalRef.componentInstance.workout_id = workout_id;
  }
}
