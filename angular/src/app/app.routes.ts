import { Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { ProfileComponent } from './profile/profile.component';
import { EditProfileComponent } from './edit-profile/edit-profile.component';
import { RoutinesComponent } from './routines/routines.component';
import { RoutineDetailsComponent } from './routines/routine-details/routine-details.component';

export const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'profile', component: ProfileComponent },
  { path: 'edit-profile', component: EditProfileComponent },
  { path: 'routines', component: RoutinesComponent },
  { path: 'routine/:id', component: RoutineDetailsComponent }
];
