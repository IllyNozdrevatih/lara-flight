<script setup lang="ts">
import { I_Airline, I_Flight, I_Pagination, IndexFlightsFilters } from '@/pages/flight/flight.types';
import HeaderNavFlight from '@/pages/flight/components/HeaderNavFlight.vue';
import { Link } from '@inertiajs/vue3';
import AirlineSelect from '@/pages/flight/components/CreateFlight/AirlineSelect.vue';

import { useFlightFilters } from '@/pages/flight/composables/useFlightFilters';

const props = defineProps<{
  flights?: I_Pagination<I_Flight>;
  airlines?: I_Airline[];
  filters: IndexFlightsFilters;
}>();

const { filters, reset } = useFlightFilters(props.filters);

function handleSelectFilterAirline(airline: I_Airline) {
  filters.airline_id = String(airline.id);
}
</script>

<template>
  <div class="container ml-auto mr-auto">
    <HeaderNavFlight />
    <div v-if="flights" class="grid grid-cols-6 gap-1">
      <div class="col-span-4">
        <div class="ml-auto mr-auto h-[600px] overflow-auto" style="max-width: 700px">
          <table class="w-full table-auto">
            <thead>
              <tr>
                <td>#</td>
                <th class="px-1">From</th>
                <th class="px-1">To</th>
                <th class="px-1">Airline</th>
                <th class="px-1">Num.</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="flightItem of flights.data" :key="`flight-list-item-${flightItem.id}`">
                <td class="px-1">{{flightItem.id}}</td>
                <td class="px-1">{{ flightItem.from }}</td>
                <td class="px-1">{{ flightItem.to }}</td>
                <td class="px-1">{{ flightItem.airline.name }}</td>
                <td class="px-1">{{ flightItem.flight_number }}</td>
                <td>
                  <Link :href="`/flights/${flightItem.id}`">-></Link>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="mt-2">
            <Link
              v-for="(link, linkIndex) of flights.links" :key="`link-${linkIndex}`" :href="link.url" v-html="link.label"
              class="px-2"
              :class="{'link-active': flights.current_page === link.page }"
            />
          </div>
        </div>
      </div>
      <div class="col-span-1">
        <h2>Filter by</h2>
        <div>
          <template v-if="airlines">
            <h3>Airlines</h3>
            <AirlineSelect @select="handleSelectFilterAirline" :airline-list="airlines" :init-airline-id="filterAirlineIdValue" />
          </template>
          <div>
            <h3>Departure date</h3>
            <input v-model="filters.date" type="date" />
          </div>
        </div>
      </div>
      <div class="col-span-1">
        <h2>Sort by</h2>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.link-active {
  font-weight: 600;

}
</style>
