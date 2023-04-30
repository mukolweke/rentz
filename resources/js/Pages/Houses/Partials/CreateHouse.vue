<template>
  <Modal
    btnLabel="Add House"
    :submitSuccess="isSubmitSuccess"
    @confirm="createHouse"
  >
    <template v-slot:header> Create New House </template>
    <template v-slot:body>
      <div class="w-[400px]">
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
            class="border border-gray-400 p-2 w-full rounded outline-primary"
            required
          >
            <option selected class="text-gray-300" value="">
              Choose a type
            </option>
            <option
              v-for="(category, index) in categories"
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

          <TextInput
            v-model="houseForm.name"
            name="name"
            id="name"
            placeholder="Enter the house name"
            class="w-full"
            required
          />

          <div class="text-xs text-red-500 mt-1" v-if="houseForm.errors.name">
            {{ houseForm.errors.name }}
          </div>
        </div>
        <!-- Location -->
        <div class="">
          <label
            for="location"
            class="block mb-2 uppercase font-bold text-xs text-gray-700"
          >
            Location
          </label>

          <TextInput
            v-model="houseForm.location"
            name="location"
            id="location"
            placeholder="Enter the house location"
            class="w-full"
            required
          />

          <div
            class="text-xs text-red-500 mt-1"
            v-if="houseForm.errors.location"
          >
            {{ houseForm.errors.location }}
          </div>
        </div>
      </div>
    </template>
  </Modal>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '../../../Components/TextInput.vue';

const houseForm = useForm({
  name: null,
  location: null,
  category_id: '',
});

defineProps({
  categories: Array,
})

let isSubmitSuccess = ref(false);

let createHouse = () => {
  isSubmitSuccess.value = false;

  houseForm.post('/houses', {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
      houseForm.reset();
    },
  });
}
</script>

<style>
</style>
