<template>
  <button
    class="px-4 rounded hover:shadow-lg transition"
    :class="{
      'p-1.5 border border-primaryGreen text-gray-500': outline && !danger,
      'p-2 bg-primaryGreen text-white hover:opacity-90': !outline,
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

