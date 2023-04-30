<template>
  <MainLayout>
    <div class="mt-4">
      <div class="capitalize">
        {{ greeting }}
        <span class="font-medium">{{ $page.props.auth.user.username }}</span> 👋
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { computed } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';

defineProps({
  label: String,
});

let greeting = computed(() => {
  //   let name =
  //     ", " + this.activeUser.firstName + " " + this.activeUser.lastName;
  const myDate = new Date();
  const hrs = myDate.getHours();
  let greet;

  if (hrs < 12) greet = "Good Morning ";
  else if (hrs >= 12 && hrs <= 17) greet = "Good Afternoon ";
  else if (hrs >= 17 && hrs <= 24) greet = "Good Evening ";
  return greet;
})

</script>
