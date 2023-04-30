<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-normal text-2xl antialiased capitalize">
              Edit unit details
            </p>
          </div>
        </div>
        <!-- Create Unit Form -->
        <div class="w-[400px]">
          <!-- House -->
          <div class="mb-6">
            <SelectInput
              v-model="unitForm.house_id"
              name="category"
              id="category"
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
          <div class="mb-6">
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
import TextInput from '../../Components/TextInput.vue';
import TextAreaInput from '../../Components/TextAreaInput.vue';
import SelectInput from '../../Components/SelectInput.vue';

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
