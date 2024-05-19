import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PostsComponent } from './posts/posts.component';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-profile',
  standalone: true,
  imports: [CommonModule, PostsComponent, RouterModule],
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent {
  activeSection: string = 'posts';

  constructor() { }

  ngOnInit(): void { }

  showSection(section: string) {
    this.activeSection = section;
  }

  isActive(section: string): boolean {
    return this.activeSection === section;
  }

}
