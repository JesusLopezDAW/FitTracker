import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-suggestions',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './suggestions.component.html',
  styleUrls: ['./suggestions.component.css']
})
export class SuggestionsComponent implements OnInit {
  suggestions = [
    { id: 1, content: 'Suggestion 1' },
    { id: 2, content: 'Suggestion 2' }
  ];

  constructor() { }

  ngOnInit(): void { }
}
