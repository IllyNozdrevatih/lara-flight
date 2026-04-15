export interface I_Flight {
  id: number;
  from: string;
  to: string;
  airline: I_Airline;
  flight_number: string;
  departure_date: string | null;
  arrival_date: string | null;
  gate: string;
  seating: number;
  flight_time: string;
  created_at: string | null;
  updated_at: string | null;
}

export interface I_Airline {
  id: number;
  name: string;
  address: string;
  country: string;
  email: string;
  phone: string;
  created_at: string | null;
  updated_at: string | null;
}

export interface I_Airport_City {
  id: number;
  wikiDataId: string;
  type: string;
  city: string;
  name: string;
  country: string;
  countryCode: string;
  region: string;
  regionCode: string;
  regionWdId: string;
  latitude: number;
  longitude: number;
  population: number;
}

// export interface IndexFlightsFilters {
//   from: string;
//   to: string;
//   airline_id: string;
//   date: string;
//   gate: string;
// }

export type IndexFlightsFilters = Record<string, string>

export interface I_Pagination<T> {
  data: T[]
  current_page: number
  last_page: number
  per_page: number
  total: number
  links: {
    url: string | null
    label: string
    active: boolean
  }[]
}
