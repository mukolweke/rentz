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
          <h3 class="text-lg font-semibold">
            <slot name="header"></slot>
          </h3>
          <button class="p-1 leading-none" @click="isVisible = false">
            <div class="text-xl font-semibold h-6 w-6">
              <span>X</span>
            </div>
          </button>
        </div>
      </div>
      <div class="p-6 pb-0">
        <slot name="body"></slot>
      </div>
      <div class="p-6">
        <div class="flex items-center justify-end">
          <Button label="Cancel" outline @click="isVisible = false" />
          <Button class="ml-4" label="Confirm" @click="confirm" />
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
  }
})

let isVisible = ref(false);

let emit = defineEmits(['confirm'])

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
</script>

