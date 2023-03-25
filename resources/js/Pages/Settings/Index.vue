<template>
    <MainLayout>
      <div>{{ label }}</div>
    </MainLayout>
  </template>

  <script setup>
  import MainLayout from '../../Layouts/MainLayout.vue';

  defineProps({
    label: String,
  });
  </script>
