import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { MicrofinanceComponent } from './components/microfinance/microfinance.component';
import { MemberComponent } from './components/member/member.component';
import { LoanComponent } from './components/loan/loan.component';

const routes: Routes = [
  { path: '', redirectTo: '/dashboard', pathMatch: 'full' },
  { path: 'dashboard', component: DashboardComponent },
  { path: 'microfinances', component: MicrofinanceComponent },
  { path: 'members', component: MemberComponent },
  { path: 'loans', component: LoanComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
