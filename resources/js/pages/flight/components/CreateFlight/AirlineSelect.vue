
<script lang="ts" setup>
import { onMounted, ref, watch } from 'vue';
import {
  Listbox,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
} from '@headlessui/vue'
import { I_Airline } from '@/pages/flight/flight.types';
import { airlineFabric } from '@/pages/flight/until/airline.fabric';

const emit = defineEmits(['select'])
interface Props {
  airlineList: I_Airline[]
  initAirlineId?: number
}
const props = withDefaults(defineProps<Props>(), {
  airlineList: () => [],
  initAirlineId: -1
});

const selectedAirline = ref(airlineFabric)

onMounted(()=> {
  if (props.initAirlineId !== -1 && props.airlineList.length){
    const item = props.airlineList.find((air:I_Airline)=> {
      return air.id === props.initAirlineId
    })
    if (item){
      selectedAirline.value = item
    }
  }
})

function handleSelectAirline(airline: I_Airline){
  selectedAirline.value = airline
  emit('select', selectedAirline.value)
}
</script>

<template>
  <div class="relative">
    <Listbox @update:model-value="handleSelectAirline" by="id">
      <ListboxButton class="border px-4 py-2 rounded w-full text-left">
        {{ selectedAirline.name || 'Select Airline' }}
      </ListboxButton>

      <ListboxOptions
        class="absolute z-10 mt-1 w-full bg-white border rounded shadow-lg max-h-60 overflow-auto focus:outline-none"
      >
        <ListboxOption
          v-for="airlineItem in props.airlineList"
          :key="airlineItem.id"
          :value="airlineItem"
          v-slot="{ active, selected }"
        >
          <li :class="['px-4 py-2 cursor-pointer', active ? 'bg-blue-500 text-white' : '']">
            {{ airlineItem.name }}
          </li>
        </ListboxOption>
      </ListboxOptions>
    </Listbox>
  </div>
</template>
