import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-profile',
  standalone: true,
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  user = {
    username: 'jesuspzz_',
    name: 'JESUS',
    profileImage: 'https://via.placeholder.com/50' // Reemplaza con la URL de la imagen de perfil real
  };

  constructor() { }

  ngOnInit(): void {
  }
}
