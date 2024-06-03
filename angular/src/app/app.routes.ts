// src/app/app.routes.ts
import { Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { ProfileComponent } from './profile/profile.component';
import { EditProfileComponent } from './edit-profile/edit-profile.component';
import { RoutinesComponent } from './routines/routines.component';
import { RoutineDetailsComponent } from './routines/routine-details/routine-details.component';
import { LoginComponent } from './login/login.component';
import { ProtectedComponent } from './protected/protected.component';
import { AuthGuard } from './guards/auth.guard';
import { ExerciseComponent } from './exercise/exercise.component';
import { WorkoutComponent } from './workout/workout.component';
import { ExerciseDetailComponent } from './exercise-detail/exercise-detail.component';

export const routes: Routes = [
  { path: '', component: HomeComponent, canActivate: [AuthGuard] },
  { path: 'profile', component: ProfileComponent, canActivate: [AuthGuard] },
  { path: 'edit-profile', component: EditProfileComponent, canActivate: [AuthGuard] },
  { path: 'routines', component: RoutinesComponent, canActivate: [AuthGuard] },
  { path: 'routine/:id', component: RoutineDetailsComponent, canActivate: [AuthGuard] },  
  { path: 'exercises', component: ExerciseComponent, canActivate: [AuthGuard] },
  { path: 'exercises/:id', component: ExerciseDetailComponent },
  { path: 'login', component: LoginComponent },
  { path: 'protected', component: ProtectedComponent, canActivate: [AuthGuard] },
  { path: 'workout/:id', component: WorkoutComponent },
  { path: 'startWorkout/:id', component: WorkoutComponent },
  { path: '**', redirectTo: '/login' }
];
