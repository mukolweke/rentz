<template>
  <nav aria-label="Table Pagination">
    <ul class="inline-flex items-center -space-x-px text-sm">
      <li>
        <Link
          :href="prev_url ?? ''"
          preserve-scroll
          :disabled="prev_url == null"
          class="block px-3 text-sm py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700"
        >
          <span><i class="fa fa-chevron-left"></i></span>
        </Link>
      </li>

      <li>
        <Link
          v-for="(link, index) in linkItems"
          :key="index"
          preserve-scroll
          :href="link.url"
          aria-current="page"
          :class="{ 'text-primary font-bold': link.active }"
          class="px-3 py-2 text leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
        >
          {{ link.label }}
        </Link>
      </li>

      <li>
        <Link
          :href="next_url ?? ''"
          preserve-scroll
          :disabled="next_url == null"
          class="block px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700"
        >
          <span><i class="fa fa-chevron-right"></i></span>
        </Link>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { computed } from 'vue';

let props = defineProps({
  links: Array,
  next_url: String,
  prev_url: String,
})

const linkItems = computed(() => {
  /*
   * Remove the first and last element
   * We shall customize the next and prev urls
   */
  props.links.pop()
  props.links.shift()

  return props.links;
})
</script>
