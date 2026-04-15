<script setup lang="ts">
import HeaderNavFlight from '@/pages/flight/components/HeaderNavFlight.vue';
import { I_Flight } from '@/pages/flight/flight.types';
import FlightCard from '@/pages/flight/components/FlightCard.vue';


defineProps<{
  flight?: I_Flight
}>();
</script>

<template>
      <div class="container ml-auto mr-auto">
        <HeaderNavFlight/>
        <FlightCard :flight-item="flight" />
      </div>
</template>
