<template>
  <MainLayout>
    <div class="mb-4">
      <div class="flex items-center justify-between py-4">
        <p class="font-normal text-2xl antialiased">Edit House Details</p>
      </div>
    </div>
    <div class="py-4 pb-10 shadow-lg rounded-lg bg-white">
      <!-- Page Content -->
      <div class="mt-8 px-8">
        <div class="max-w-md w-full">
          <!-- Category -->
          <div class="mb-6">
            <SelectInput
              v-model="houseForm.category_id"
              name="category"
              :select-options="categoryOptions"
              label-string="Select House Type"
              :input-error="houseForm.errors.category_id"
              required
            />
          </div>
          <!-- Name -->
          <div class="mb-6">
            <TextInput
              v-model="houseForm.name"
              name="name"
              placeholder="Enter the house name"
              class="w-full"
              label-string="Name"
              :input-error="houseForm.errors.name"
              required
            />
          </div>
          <!-- Location -->
          <div class="mb-6">
            <TextInput
              v-model="houseForm.location"
              name="location"
              placeholder="Enter the house location"
              class="w-full"
              label-string="Location"
              :input-error="houseForm.errors.location"
              required
            />
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
import MainLayout from '../../Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3'
import Button from '../../Components/Button.vue';
import TextInput from '../../Components/TextInput.vue';
import SelectInput from '../../Components/SelectInput.vue';

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
