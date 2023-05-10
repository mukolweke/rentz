<template>
  <Modal
    :submitSuccess="isSubmitSuccess"
    btnLabel="Create House Type"
    @confirm="createCategory"
  >
    <template v-slot:header> Create House Type </template>
    <template v-slot:body>
      <div class="w-[400px]">
        <div class="">
          <TextInput
            v-model="categoryForm.name"
            name="name"
            placeholder="Enter a category name"
            class="w-full"
            label-string="Name"
            :input-error="categoryForm.errors.name"
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
