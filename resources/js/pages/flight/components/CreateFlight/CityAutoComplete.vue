<script setup lang="ts">
import { Combobox, ComboboxButton, ComboboxInput, ComboboxOption, ComboboxOptions, TransitionRoot } from '@headlessui/vue';
import _ from 'lodash';
import axios from 'axios';
import { ref, watch } from 'vue';
import { I_GeoDbCity } from '@/types/geodb.type';
import { geoDbCityFabric } from '@/pages/flight/until/geoDbCity.fabric';
import "flag-icons/css/flag-icons.min.css";

const emit = defineEmits(['select']);
const cityOptions = ref<I_GeoDbCity[]>([]);
const selectedValue = ref<I_GeoDbCity>(geoDbCityFabric);
const queryStr = ref('');

const handleInputDebounce = _.debounce(async (str: string) => {
  const { data } = await axios.get(`/api/geodb?q=${str}`);

  // const { data } = await axios.get(`/api/airportapi?q=${str}`);
  cityOptions.value = data;
}, 300);

watch(queryStr, () => {
  handleInputDebounce(queryStr.value);
});

watch(selectedValue, () => {
  emit('select', selectedValue.value);
});
</script>

<template>
  <Combobox v-model="selectedValue">
    <div class="relative mt-1">
      <div
        class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
      >
        <ComboboxInput
          class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
          :displayValue="(city) => city.name"
          @change="queryStr = $event.target.value"
        />
        <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
          <!--                  <ChevronUpDownIcon-->
          <!--                    class="h-5 w-5 text-gray-400"-->
          <!--                    aria-hidden="true"-->
          <!--                  />-->
        </ComboboxButton>
      </div>
      <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0" @after-leave="queryStr = ''">
        <ComboboxOptions
          class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
          style="z-index: 999"
        >
          <div v-if="cityOptions.length === 0 && queryStr !== ''" class="relative cursor-default select-none px-4 py-2 text-gray-700">
            Nothing found.
          </div>

          <ComboboxOption v-for="city in cityOptions" as="template" :key="city.id" :value="city" v-slot="{ selected, active }">
            <li
              class="relative cursor-default select-none py-2 pl-10 pr-4"
              :class="{
                'bg-teal-600 text-white': active,
                'text-gray-900': !active,
              }"
            >
              <span class="block truncate" :class="{ 'font-medium': selected, 'font-normal': !selected }">
                <span :class="`fi fi-${city.countryCode.toLowerCase()}`"/> {{ city.name }}
              </span>
              <span
                v-if="selected"
                class="absolute inset-y-0 left-0 flex items-center pl-3"
                :class="{ 'text-white': active, 'text-teal-600': !active }"
              >
                <!--                  <CheckIcon class="h-5 w-5" aria-hidden="true" />-->
              </span>
            </li>
          </ComboboxOption>
        </ComboboxOptions>
      </TransitionRoot>
    </div>
  </Combobox>
</template>
