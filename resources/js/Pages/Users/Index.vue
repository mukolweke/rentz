<template>
  <div>
    <h1 class="text-3xl font-bold underline">Hello world! {{ label }}</h1>

    <a :href="route('second-route')">Go to second route</a>
  </div>
</template>

<script setup>
defineProps({
  label: String,
})
</script>
