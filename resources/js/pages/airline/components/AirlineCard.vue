<script setup lang="ts">

import { I_Airline, I_Flight } from '@/pages/flight/flight.types';

defineProps<{
  airlineItem?: I_Airline
}>();
</script>

<style lang="scss">
.flight-card {
  border: 1px solid #555;
  box-shadow: 0 1px 2px rgba(200,200,200,.6),0 1px 3px 1px rgba(200,200,200,.6);
  padding: 10px;
  border-radius: 10px;
}
</style>

<template>
  <div v-if="airlineItem" class="flight-card">
    {{airlineItem}}
<!--    <div>To: {{flightItem.to}}</div>-->
<!--    <div>Airline: {{flightItem.airline.name}}</div>-->
<!--    <div>Flight number: {{flightItem.flight_number}}</div>-->
  </div>
</template>
