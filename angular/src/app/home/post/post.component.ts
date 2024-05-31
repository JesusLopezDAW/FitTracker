import { Component, Inject, Input, OnInit } from '@angular/core';
import { CommonModule, DOCUMENT } from '@angular/common';

@Component({
  selector: 'app-post',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './post.component.html',
  styleUrls: ['./post.component.css']
})
export class PostComponent implements OnInit {
  @Input() post: any;

  constructor(@Inject(DOCUMENT) private document: Document) { }

  ngOnInit(): void {
  }

  toggleLike() {
    // Si el post no estaba previamente liked, incrementa el contador de likes
    console.log(this.post.id);
    if (!this.post.liked) {
      this.post.likes++;
      this.addLike();
    } else {
      // Si el post estaba previamente liked, decrementa el contador de likes
      this.post.likes--;
      this.removeLike();
    }

    // Cambia el estado de liked
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
      "Accept": "*/*",
      "User-Agent": "Thunder Client (https://www.thunderclient.com)",
      "Authorization": "bearer " + sessionStorage.getItem("authToken"),
      "Content-Type": "application/json"
    }

    let response = await fetch("http://localhost/api/likes/"+this.post.id, {
      method: "DELETE",
      headers: headersList
    });

    let data = await response.json();
    console.log(data);

  }
}
