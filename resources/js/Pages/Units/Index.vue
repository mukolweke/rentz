<template>
  <MainLayout>
    {{ label }}
  </MainLayout>
</template>

<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';

defineProps({
  label: String,
});
</script>
