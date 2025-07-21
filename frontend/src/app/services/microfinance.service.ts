import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';
import { Microfinance, CreateMicrofinanceRequest } from '../models/microfinance.model';

@Injectable({
  providedIn: 'root'
})
export class MicrofinanceService {
  private apiUrl = `${environment.apiUrl}/microfinances`;

  constructor(private http: HttpClient) {}

  getMicrofinances(): Observable<Microfinance[]> {
    return this.http.get<Microfinance[]>(this.apiUrl);
  }

  createMicrofinance(microfinance: CreateMicrofinanceRequest): Observable<Microfinance> {
    return this.http.post<Microfinance>(this.apiUrl, microfinance);
  }

  getMicrofinance(id: string): Observable<Microfinance> {
    return this.http.get<Microfinance>(`${this.apiUrl}/${id}`);
  }

  updateMicrofinance(id: string, microfinance: CreateMicrofinanceRequest): Observable<Microfinance> {
    return this.http.put<Microfinance>(`${this.apiUrl}/${id}`, microfinance);
  }

  deleteMicrofinance(id: string): Observable<void> {
    return this.http.delete<void>(`${this.apiUrl}/${id}`);
  }
}
