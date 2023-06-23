<script setup>

let props = defineProps({
  options: Array
});

function lastItem(index) {
  return index == props.options.length - 1
}
</script>

<template>
  <nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center">
      <li class="inline-flex items-center mr-1 md:mr-4">
        <Link
          href="/"
          class="inline-flex items-center text-sm font-medium hover:text-primaryAlt"
        >
          <span class="text-sm mr-2">
            <i class="fa fa-home"></i>
          </span>
          Home
        </Link>
      </li>
      <li class="mr-1 md:mr-3" v-for="(item, index) in options" :key="index">
        <div class="flex items-center">
          <span class="text-gray-400 text-sm mr-3">
            <i class="fa fa-chevron-right"></i>
          </span>
          <Link
            v-if="!lastItem(index)"
            :href="item.href"
            class="ml-1 text-sm font-medium md:ml-2 hover:text-primaryAlt"
          >
            {{ item.label }}
          </Link>
          <span v-else class="text-gray-500 text-sm">
            {{ item.label }}
          </span>
        </div>
      </li>
    </ol>
  </nav>
</template>
