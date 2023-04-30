<template>
  <button
    class="px-4 rounded hover:shadow-lg transition"
    :class="{
      'p-1.5 border border-primary text-gray-500': outline && !danger,
      'p-2 bg-primary text-white hover:opacity-90': !outline,
      'bg-red-500': danger,
    }"
  >
    <span v-if="label == 'delete'"><i class="fa fa-trash"></i></span>
    <span v-else>{{ label }}</span>
  </button>
</template>

<script setup>
defineProps({
  label: String,
  outline: Boolean,
  danger: Boolean,
})
</script>

