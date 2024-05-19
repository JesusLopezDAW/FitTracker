import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
// import { StatsComponent } from './stats/stats.component';
import { PostsComponent } from './posts/posts.component';

@Component({
  selector: 'app-profile',
  standalone: true,
  // imports: [CommonModule, StatsComponent, PostsComponent],
  imports: [CommonModule, PostsComponent],
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

}
