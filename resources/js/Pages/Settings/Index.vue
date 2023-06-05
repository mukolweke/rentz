<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <h1 class="font-normal text-2xl antialiased mb-8">Settings</h1>

          <div class="border border-gray-200 rounded-lg p-4">
            <!-- User Module -->
            <div>
              <p class="antialiased text-lg">Setting</p>

              <div class="h-px bg-gray-200 w-full my-4"></div>

              <div class="flex items-start justify-between mt-2">Rentz</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

  <script setup>
import MainLayout from '../../Layouts/MainLayout.vue';

defineProps({
  label: String,
});
  </script>
