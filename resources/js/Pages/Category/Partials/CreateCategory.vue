<template>
  <Modal
    :submitSuccess="isSubmitSuccess"
    btnLabel="Add Category"
    @confirm="createCategory"
  >
    <template v-slot:header> Create New Category </template>
    <template v-slot:body>
      <div class="w-[400px]">
        <div class="">
          <label
            for="name"
            class="block mb-2 uppercase font-bold text-xs text-gray-700"
          >
            Name
          </label>

          <TextInput
            v-model="categoryForm.name"
            name="name"
            id="name"
            placeholder="Enter a category name"
            class="w-full"
            required
          />
          <div
            class="text-xs text-red-500 mt-1"
            v-if="categoryForm.errors.name"
          >
            {{ categoryForm.errors.name }}
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

const categoryForm = useForm({
  name: null,
});

let isSubmitSuccess = ref(false);

let createCategory = () => {
  isSubmitSuccess.value = false;
  categoryForm.post('/category', {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
      categoryForm.reset('name');
    },
  });
}
</script>
