// import { Component } from '@angular/core';
// import { CommonModule } from '@angular/common';
// import { ChartOptions, ChartType } from 'chart.js';
// import { NgChartsModule } from 'ng2-charts';
// import { FullCalendarModule } from '@fullcalendar/angular';
// import dayGridPlugin from '@fullcalendar/daygrid';
// import interactionPlugin from '@fullcalendar/interaction';
// import { CalendarOptions } from '@fullcalendar/core';

// @Component({
//   selector: 'app-stats',
//   standalone: true,
//   imports: [CommonModule, NgChartsModule, FullCalendarModule],
//   templateUrl: './stats.component.html',
//   styleUrls: ['./stats.component.css'],
//   providers: []
// })
// export class StatsComponent {
//   chartOptions: ChartOptions = {
//     responsive: true,
//   };
//   chartLabels: string[] = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
//   chartData = [
//     { data: [65, 59, 80, 81, 56, 55, 40], label: 'Entrenamientos' }
//   ];
//   chartType: ChartType = 'line';
//   chartLegend = true;

//   calendarOptions: CalendarOptions = {
//     plugins: [dayGridPlugin, interactionPlugin],
//     initialView: 'dayGridMonth',
//     dateClick: this.handleDateClick.bind(this)
//   };

//   handleDateClick(arg: any) {
//     arg.dayEl.style.backgroundColor = 'blue';
//   }
// }
