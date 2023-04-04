<template>
  <Modal :submitSuccess="isSubmitSuccess" @confirm="updateCategory">
    <template v-slot:toggleBtn="{ onClick }">
      <div
        @click="
          onActionClick();
          onClick();
        "
        class="font-medium text-purple-400 cursor-pointer hover:underline"
      >
        Edit
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
          {{ tempField }}
          <input
            v-model="categoryForm.name"
            type="text"
            name="name"
            class="border border-gray-400 p-2 w-full rounded outline-purple-700"
            id="name"
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

