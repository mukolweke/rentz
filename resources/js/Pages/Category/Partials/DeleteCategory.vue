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
        <span class="text-lg"><i class="fa fa-trash"></i></span>
      </div>
    </template>
    <template v-slot:body>
      <div class="w-[400px]">
        <div class="w-full space-y-4">
          <div class="flex items-center justify-center mb-8">
            <div
              class="border-2 border-red-500 rounded-full w-[100px] h-[100px] flex items-center justify-center"
            >
              <span class="text-4xl text-red-500"
                ><i class="fa fa-xmark"></i
              ></span>
            </div>
          </div>

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
