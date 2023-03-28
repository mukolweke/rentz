<template>
  <button
    class="p-2 px-4 rounded-lg hover:shadow-lg transition"
    :class="{
      'border border-primaryGreen': outline,
      'bg-primaryGreen text-white hover:opacity-90': !outline,
    }"
  >
    {{ label }}
  </button>
</template>

<script setup>
defineProps({
  label: String,
  outline: Boolean,
})
</script>

