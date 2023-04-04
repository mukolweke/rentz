<template>
  <button
    class="px-4 rounded hover:shadow-lg transition"
    :class="{
      'p-1.5 border border-purple-700 text-gray-500': outline && !danger,
      'p-2 bg-purple-700 text-white hover:opacity-90': !outline,
      'bg-red-500': danger,
    }"
  >
    {{ label }}
  </button>
</template>

<script setup>
defineProps({
  label: String,
  outline: Boolean,
  danger: Boolean,
})
</script>

