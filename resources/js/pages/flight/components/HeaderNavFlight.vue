<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
</script>

<style lang="scss">
.flight-nav-bar {
  margin: 0 -5px;
}
.flight-nav-item {
  padding: 5px;
  text-decoration: underline;
}
</style>

<template>
  <nav class="flight-nav-bar grid grid-cols-2">
    <Link class="flight-nav-item grid justify-center" href="/flights">Flight list</Link>
    <Link class="flight-nav-item grid justify-center" href="/flights-api/create">Create flight</Link>
  </nav>
</template>
