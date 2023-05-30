<template>
  <div class="">
    <slot
      v-if="showToggleBtn()"
      name="toggleBtn"
      :onClick="() => (isVisible = true)"
    />
    <Button v-else :label="btnLabel" @click="isVisible = true" />
  </div>
  <div v-if="isVisible" class="opacity-25 z-40 fixed inset-0 bg-black"></div>
  <div
    v-if="isVisible"
    class="fixed z-50 inset-0 flex justify-center items-center"
  >
    <div class="flex flex-col max-w-5xl rounded-lg shadow-lg bg-white">
      <div class="p-5 h-full">
        <div class="flex items-center justify-between h-full">
          <h3 class="font-normal text-2xl antialiased capitalize">
            <slot name="header"></slot>
          </h3>
          <button
            class="p-1 leading-none"
            @click="
              isVisible = false;
              emit('cancel');
            "
          >
            <div class="text-xl font-semibold h-6 w-6 text-gray-300">
              <span>X</span>
            </div>
          </button>
        </div>
      </div>
      <div class="pb-6 pt-6 px-6">
        <slot name="body"></slot>
      </div>
      <div class="p-6">
        <div
          class="flex items-center"
          :class="{
            'justify-end': !deleteModal,
            'justify-center': deleteModal,
          }"
        >
          <Button
            label="Cancel"
            @click="
              isVisible = false;
              emit('cancel');
            "
            outline
          />
          <Button
            class="ml-4"
            label="Confirm"
            @click="confirm"
            :danger="deleteModal"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, useSlots } from 'vue';
import Button from './Button.vue';

let props = defineProps({
  btnLabel: {
    type: String,
    default: 'Toggle Modal',
  },
  submitSuccess: {
    type: Boolean,
    default: false,
  },
  deleteModal: Boolean
})

let isVisible = ref(false);

let emit = defineEmits(['confirm', 'cancel'])

const confirm = () => {
  emit('confirm')
}

watch(() => props.submitSuccess, async (value) => {
  isVisible.value = !value
});

const slots = useSlots()
const showToggleBtn = () => {
  return !!slots.toggleBtn
}
const showHeader = () => {
  return !!slots.header
}
</script>

