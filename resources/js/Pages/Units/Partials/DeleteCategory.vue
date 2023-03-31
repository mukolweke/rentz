<template>
  <Modal deleteModal :submitSuccess="isSubmitSuccess" @confirm="deleteCategory">
    <template v-slot:toggleBtn="{ onClick }">
      <div
        @click="
          onActionClick();
          onClick();
        "
        class="font-medium text-red-600 cursor-pointer hover:underline"
      >
        Delete
      </div>
    </template>
    <template v-slot:body>
      <div class="w-[400px]">
        <div class="w-full space-y-4">
          <p class="text-center">X</p>

          <p class="text-center">
            Do you really want to delete this records? This process cannot be
            undone.
          </p>
        </div>
      </div>
    </template>
  </Modal>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'

let props = defineProps({
  onActionClick: Function,
  itemId: Number,
});

const categoryForm = useForm({
  name: null
});

let isSubmitSuccess = ref(false);

let deleteCategory = () => {
  isSubmitSuccess.value = false;
  categoryForm.delete('/category/' + props.itemId, {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
    },
  });
}
</script>
