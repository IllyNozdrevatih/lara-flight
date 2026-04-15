<script setup lang="ts">
import HeaderNavFlight from '@/pages/flight/components/HeaderNavFlight.vue';
import { I_Airline } from '@/pages/flight/flight.types';
import AirlineCard from '@/pages/airline/components/AirlineCard.vue';


defineProps<{
  airline?: I_Airline
}>();
</script>

<template>
  <div class="container ml-auto mr-auto">
    <HeaderNavFlight/>
    <AirlineCard :airline-item="airline"/>
<!--    <FlightCard :flight-item="flight" />-->
  </div>
</template>
