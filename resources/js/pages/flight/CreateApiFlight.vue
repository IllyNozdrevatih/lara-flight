<script setup lang="ts">
import HeaderNavFlight from '@/pages/flight/components/HeaderNavFlight.vue';
import { I_Airline } from '@/pages/flight/flight.types';
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

import CityAutoComplete from '@/pages/flight/components/CreateFlight/CityAutoComplete.vue';
import { I_GeoDbCity } from '@/types/geodb.type';
import AirlineSelect from '@/pages/flight/components/CreateFlight/AirlineSelect.vue';
import { Button } from '@/components/ui/button';
import axios from 'axios';
// import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

defineProps<{
  airlines?: I_Airline[];
}>();

const to = ref('');
const from = ref('');
const airline_id = ref(-1);


function handleSelectCityFrom(city: I_GeoDbCity) {
  from.value = city.name;
}

function handleSelectCityTo(city: I_GeoDbCity) {
  to.value = city.name;
}

function handleSelectAirline(airline: I_Airline) {
  airline_id.value = airline.id;
}

async function submit() {
  const payload = {
    from: from.value,
    to: to.value,
    airline_id: airline_id.value
  }

  try {
    await axios.post('/api/flights',payload)

    router.visit( '/flights' )
  } catch (e) {
    console.log('Errors:', e.response.data.errors);
  }
}
function goHome(){
  router.visit( '/flights' )
}
</script>

<template>
  <div class="container ml-auto mr-auto">
    <HeaderNavFlight />
    <button @click="goHome">go home</button>
    <h2>Create new Flight</h2>
    <div>
      <div class="mt-10 grid grid-cols-2 gap-x-3">
        <div class="col-span-1">
          <div>
            <h2>From</h2>
            <CityAutoComplete @select="handleSelectCityFrom" />
          </div>
        </div>
        <div class="col-span-1">
          <div>
            <h2>To</h2>
            <CityAutoComplete @select="handleSelectCityTo" />
          </div>
        </div>
      </div>
      <div class="mt-1 grid grid-cols-1" v-if="airlines">
        <div class="col-span-1">
          <label for="airline" class="block text-sm/6 font-medium text-gray-900">Airline</label>
          <div class="mt-2">
            <AirlineSelect @select="handleSelectAirline" :airline-list="airlines" />
          </div>
        </div>
      </div>
      <div class="mt-2">
        <button @click="submit" class="w-full rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700" type="submit">Save</button>
      </div>
    </div>
  </div>
</template>
