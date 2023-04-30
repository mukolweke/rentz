<template>
  <Modal
    btnLabel="Create House"
    :submitSuccess="isSubmitSuccess"
    @confirm="createHouse"
  >
    <template v-slot:header> Create House </template>
    <template v-slot:body>
      <div class="w-[400px]">
        <!-- Category -->
        <div class="mb-6">
          <SelectInput
            v-model="houseForm.category_id"
            name="category"
            :disabled="houseId"
            :select-options="categories"
            :class="{ 'bg-gray-200': houseId }"
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
            id="name"
            placeholder="Enter the house name"
            class="w-full"
            label-string="Name"
            :input-error="houseForm.errors.name"
            required
          />
        </div>
        <!-- Location -->
        <div class="">
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
      </div>
    </template>
  </Modal>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '../../../Components/TextInput.vue';
import SelectInput from '../../../Components/SelectInput.vue';

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
