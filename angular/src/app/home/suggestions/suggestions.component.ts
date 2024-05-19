import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-suggestions',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './suggestions.component.html',
  styleUrls: ['./suggestions.component.css']
})
export class SuggestionsComponent implements OnInit {
  suggestions = [
    { username: 'sarsnchez_', name: '@sarsnchez_', profileImage: 'https://via.placeholder.com/50' },
    { username: 'elenaarobles_', name: '@elenaarobles_', profileImage: 'https://via.placeholder.com/50' },
    { username: 'iirenelunaa', name: '@iirenelunaa', profileImage: 'https://via.placeholder.com/50' },
    { username: 'marwaa_zb', name: '@marwaa_zb', profileImage: 'https://via.placeholder.com/50' },
    { username: 'albba.27', name: '@albba.27', profileImage: 'https://via.placeholder.com/50' }
  ];

  constructor() { }

  ngOnInit(): void { }
}
