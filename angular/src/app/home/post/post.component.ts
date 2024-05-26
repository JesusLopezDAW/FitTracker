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
    // Alternar el estado de liked
    this.post.liked = !this.post.liked;

    // Incrementar o decrementar el número de likes dependiendo del estado
    if (this.post.liked) {
      this.post.likes++;
    } else {
      this.post.likes--;
    }
  }
}
