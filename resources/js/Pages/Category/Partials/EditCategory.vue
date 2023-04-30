<template>
  <Modal :submitSuccess="isSubmitSuccess" @confirm="updateCategory">
    <template v-slot:toggleBtn="{ onClick }">
      <div
        @click="
          onActionClick();
          onClick();
        "
        class="font-medium text-primary cursor-pointer hover:underline"
      >
        <span class="text-lg"><i class="fa-regular fa-edit"></i></span>
      </div>
    </template>
    <template v-slot:header>Edit Category </template>
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
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '../../../Components/TextInput.vue';

let props = defineProps({
  onActionClick: Function,
  item: Object,
});

let categoryForm = useForm({
  name: null
});

watch(() => props.item.name, async (value) => {
  categoryForm.name = value
});

let isSubmitSuccess = ref(false);

let updateCategory = () => {
  isSubmitSuccess.value = false;
  categoryForm.post('/category/' + props.item.id, {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
      categoryForm.reset('name');
    },
  });
}
</script>

