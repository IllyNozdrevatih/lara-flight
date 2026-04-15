import { router } from '@inertiajs/vue3'
import { reactive, watch } from 'vue'

export function useFlightFilters(initialFilters: Record<string, string>) {
  const filters = reactive({ ...initialFilters })

  // Автоматически обновляет URL при изменении фильтров
  watch(filters, (values) => {
    router.get(route('flights.index'), values, {
      preserveState: true,   // не сбрасывает скролл
      preserveScroll: true,
      replace: true,         // не засоряет history
    })
  }, { debounce: 300 })          // 👈 debounce чтобы не спамить запросы

  const reset = () => {
    Object.keys(filters).forEach(key => filters[key] = '')
  }

  return { filters, reset }
}
