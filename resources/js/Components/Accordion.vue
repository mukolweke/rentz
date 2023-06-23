
<script setup>
import { ref } from 'vue';

let props = defineProps({
  title: String,
  open: Boolean
})

let isOpen = ref(props.open)

const emit = defineEmits(['toggleOpen']);

</script>

<template>
  <div class="">
    <div
      @click="isOpen = !isOpen"
      :class="{ 'border-none bg-primary text-white': isOpen }"
      class="border border-gray-400 hover:text-white hover:bg-primary rounded-md p-4 capitalize cursor-pointer flex items-center justify-between"
    >
      {{ title }}

      <span>
        <span v-if="!isOpen" class="transition duration-200 ease-in-out">
          <i class="fa fa-chevron-down"></i>
        </span>

        <span v-else class="transition duration-200 ease-in-out">
          <i class="fa fa-chevron-up"></i>
        </span>
      </span>
    </div>
    <div
      class="border border-gray-200 bg-white p-4 mt-2 rounded-md transition duration-200 ease-in w-full"
      :class="isOpen ? 'block' : 'hidden'"
    >
      <slot></slot>
    </div>
  </div>
</template>

