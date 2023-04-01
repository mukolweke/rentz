<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-semibold text-sm text-gray-500">Create a unit</p>
          </div>
        </div>
        <!-- Create Unit Form -->
        <div class="w-[400px]">
          <!-- House -->
          <div class="mb-6">
            <label
              for="category"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Link a house
            </label>

            <select
              v-model="unitForm.house_id"
              name="category"
              id="category"
              placeholder="Choose a type"
              class="border border-gray-400 p-2 w-full rounded outline-primaryGreen"
              required
              :disabled="houseId"
              :class="{ 'bg-gray-200': houseId }"
            >
              <option selected class="text-gray-300" value="">
                Choose a type
              </option>
              <option
                v-for="(house, index) in housesOptions"
                :key="index"
                :value="house.id"
              >
                {{ house.name }}
              </option>
            </select>
            <div
              class="text-xs text-red-500 mt-1"
              v-if="unitForm.errors.house_id"
            >
              {{ unitForm.errors.house_id }}
            </div>
          </div>
          <!-- Name -->
          <div class="mb-6">
            <label
              for="name"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Name
            </label>

            <input
              v-model="unitForm.name"
              type="text"
              name="name"
              placeholder="Enter the house name"
              class="border border-gray-400 placeholder:text-sm p-2 w-full rounded outline-primaryGreen"
              id="name"
              required
            />
            <div class="text-xs text-red-500 mt-1" v-if="unitForm.errors.name">
              {{ unitForm.errors.name }}
            </div>
          </div>
          <!-- Block -->
          <div class="mb-6">
            <label
              for="block_name"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Block
            </label>

            <input
              v-model="unitForm.block"
              type="text"
              name="block name"
              placeholder="Enter the block name"
              class="border border-gray-400 p-2 w-full placeholder:text-sm rounded outline-primaryGreen"
              id="block_name"
            />
            <div class="text-xs text-red-500 mt-1" v-if="unitForm.errors.block">
              {{ unitForm.errors.block }}
            </div>
          </div>

          <!-- Unit Description -->
          <div class="mb-6">
            <label
              for="unit_description"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Description
            </label>

            <textarea
              v-model="unitForm.description"
              id="unit_description"
              rows="4"
              name="description"
              class="block p-2.5 w-full placeholder:text-sm outline-primaryGreen rounded-lg border border-gray-300 focus:ring-primaryGreen focus:border-primaryGreen"
              placeholder="Write a small unit description"
            ></textarea>
            <div
              class="text-xs text-red-500 mt-1"
              v-if="unitForm.errors.description"
            >
              {{ unitForm.errors.description }}
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="mt-4 flex justify-end items-center space-x-4">
            <Button label="Cancel" outline @click="back" />
            <Button label="Create Unit" @click="createUnit" />
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import MainLayout from '../../Layouts/MainLayout.vue';
import Button from '../../Components/Button.vue';

let props = defineProps({
  housesOptions: Array,
  houseId: Number | null,
})

const unitForm = useForm({
  name: null,
  block: null,
  description: null,
  house_id: props.houseId ?? '',
});


let isSubmitSuccess = ref(false);

let createUnit = () => {
  isSubmitSuccess.value = false;

  unitForm.post('/units', {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
      unitForm.reset();
    },
  });
}

let back = () => {
  window.history.back();
}
</script>
