<template>
  <MainLayout>
    <div class="mb-4">
      <div class="flex items-center justify-between py-4">
        <p class="text-2xl">Edit House Details</p>
      </div>
    </div>
    <div class="py-4 pb-10 shadow-lg rounded-lg bg-white">
      <!-- Page Content -->
      <div class="mt-8 px-8">
        <div class="max-w-md w-full">
          <!-- Category -->
          <div class="mb-6">
            <label
              for="category"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Select House Type
            </label>

            <select
              v-model="houseForm.category_id"
              name="category"
              id="category"
              placeholder="Choose a type"
              class="border border-gray-400 p-2 w-full rounded outline-purple-700"
              required
            >
              <option selected class="text-gray-300" value="">
                Choose a type
              </option>
              <option
                v-for="(category, index) in categoryOptions"
                :key="index"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
            <div
              class="text-xs text-red-500 mt-1"
              v-if="houseForm.errors.category_id"
            >
              {{ houseForm.errors.category_id }}
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
              v-model="houseForm.name"
              type="text"
              name="name"
              placeholder="Enter the house name"
              class="border border-gray-400 placeholder:text-sm p-2 w-full rounded outline-purple-700"
              id="name"
              required
            />
            <div class="text-xs text-red-500 mt-1" v-if="houseForm.errors.name">
              {{ houseForm.errors.name }}
            </div>
          </div>
          <!-- Location -->
          <div class="mb-6">
            <label
              for="location"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Location
            </label>

            <input
              v-model="houseForm.location"
              type="text"
              name="location"
              placeholder="Enter the house location"
              class="border border-gray-400 p-2 w-full placeholder:text-sm rounded outline-purple-700"
              id="location"
              required
            />
            <div
              class="text-xs text-red-500 mt-1"
              v-if="houseForm.errors.location"
            >
              {{ houseForm.errors.location }}
            </div>
          </div>

          <!-- Submit Button -->
          <div class="mt-4 flex justify-end items-center space-x-4">
            <Button label="Cancel" outline @click="back" />
            <Button label="Update House" @click="editHouse" />
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3'
import Button from '../../Components/Button.vue';

let props = defineProps({
  house: Object,
  categoryOptions: Array,
})

const houseForm = useForm({
  name: props.house.name,
  location: props.house.location,
  category_id: props.house.category_id,
});

let editHouse = () => {
  houseForm.put('/houses/' + props.house.id, {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
      houseForm.reset();
    },
  });
}

let back = () => {
  window.history.back();
}
</script>
