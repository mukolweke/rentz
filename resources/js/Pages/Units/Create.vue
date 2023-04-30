<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-normal text-2xl antialiased capitalize">
              Create unit
            </p>
          </div>
        </div>
        <!-- Create Unit Form -->
        <div class="w-[400px]">
          <!-- House -->
          <div class="mb-6">
            <SelectInput
              v-model="unitForm.house_id"
              name="house"
              :disabled="houseId"
              :select-options="housesOptions"
              :class="{ 'bg-gray-200': houseId }"
              label-string="Link a house"
              :input-error="unitForm.errors.house_id"
              required
            />
          </div>
          <!-- Name -->
          <div class="mb-6">
            <TextInput
              v-model="unitForm.name"
              name="name"
              required
              placeholder="Enter the house name"
              class="w-full"
              label-string="Name"
              :input-error="unitForm.errors.name"
            />
          </div>
          <!-- Block -->
          <div class="mb-6 w-full">
            <TextInput
              v-model="unitForm.block"
              name="block"
              required
              placeholder="Enter the block name"
              label-string="Block"
              :input-error="unitForm.errors.block"
            />
          </div>

          <!-- Unit Description -->
          <div class="mb-6">
            <TextAreaInput
              v-model="unitForm.description"
              name="description"
              placeholder="Write a small unit description"
              label-string="Description"
              :input-error="unitForm.errors.description"
            />
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
import TextInput from '../../Components/TextInput.vue';
import SelectInput from '../../Components/SelectInput.vue';
import TextAreaInput from '../../Components/TextAreaInput.vue';

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
