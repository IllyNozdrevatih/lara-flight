import { router } from '@inertiajs/vue3'
import { reactive, watch } from 'vue'

export function useFlightFilters(initialFilters: Record<string, string>) {
  const filters = reactive({ ...initialFilters })

  watch(filters, (values) => {
    router.get(route('flights.index'), values, {
      preserveState: true,
      preserveScroll: true,
      replace: true,
    })
  }, { debounce: 300 })

  const reset = () => {
    Object.keys(filters).forEach(key => filters[key] = '')
  }

  return { filters, reset }
}
