<template>
  <MainLayout>
    <div>Good Evening User 👋</div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';

defineProps({
  label: String,
});

</script>
