<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-normal text-2xl antialiased capitalize">Edit unit details</p>
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
              class="border border-gray-400 p-2 w-full rounded outline-primary"
              required
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
              class="border border-gray-400 placeholder:text-sm p-2 w-full rounded outline-primary"
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
              class="border border-gray-400 p-2 w-full placeholder:text-sm rounded outline-primary"
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
              class="block p-2.5 w-full placeholder:text-sm outline-primary rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
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
            <Button label="Update Unit" @click="updateUnit" />
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
  unit: Array,
  housesOptions: Array,
});

const unitForm = useForm({
  name: props.unit.name,
  block: props.unit.block,
  description: props.unit.description,
  house_id: props.unit.house_id,
});

let isSubmitSuccess = ref(false);

let updateUnit = () => {
  isSubmitSuccess.value = false;

  unitForm.patch('/units/' + props.unit.id, {
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
