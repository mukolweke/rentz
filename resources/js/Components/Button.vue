<template>
  <button
    class="p-2 px-4 rounded hover:shadow-lg transition"
    :class="{
      'border border-primaryGreen text-gray-500': outline && !danger,
      'bg-primaryGreen text-white hover:opacity-90': !outline,
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

