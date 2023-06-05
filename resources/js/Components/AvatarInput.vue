<script setup>
import { ref } from 'vue';
import Icon from './Icon.vue';

const props = defineProps({
  modelValue: File,
  src: String,
  altTag: String,
  editPage: {
    type: Boolean,
    default: false,
  }
})

const fileInput = ref(null)

function browse() {
  fileInput.value.click();
}

let fileData = ref(null)

let src = ref(props.src)

let showActions = ref(props.editPage)

const emit = defineEmits(['update:model-value', 'remove-file'])

function fileInputChange(e) {
  fileData.value = e.target.files[0]
  emit('update:model-value', fileData.value)

  let reader = new FileReader();
  reader.readAsDataURL(fileData.value);
  reader.onload = (e) => {
    src.value = e.target.result;
  }
}

function remove() {
  fileData.value = null;
  src.value = null;
  emit('update:model-value', fileData.value);
  emit('remove-file');
}
</script>

<template>
  <div class="relative inline-block overflow-hidden">
    <div v-if="src" class="w-full h-full">
      <span
        v-if="src"
        class="relative inline-block w-full h-full overflow-hidden"
      >
        <img class="object-cover h-full w-full" :src="src" :alt="altTag" />
        <span class="absolute inset-0 border-2 border-black/10"></span>
      </span>
    </div>

    <div
      v-else
      class="w-full h-full border-2 border-black/10 text-primaryAlt opacity-70 flex items-center justify-center bg-white text-5xl"
    >
      {{ altTag }}
    </div>

    <input
      type="file"
      accept="image/*"
      class="hidden"
      ref="fileInput"
      @change="fileInputChange"
    />

    <div
      @mouseover="showActions = true"
      @mouseleave="showActions = props.editPage ?? false"
      class="absolute top-0 bottom-0 h-full w-full bg-black bg-opacity-25 flex items-center justify-center"
    >
      <div v-if="showActions" class="flex items-center">
        <button
          @click="browse()"
          class="cursor-pointer rounded-full flex items-center justify-center hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none transition duration-200"
        >
          <Icon name="camera" class="h-6 w-6" />
        </button>

        <button
          v-if="src"
          @click="remove()"
          class="cursor-pointer rounded-full flex items-center justify-center hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none transition duration-200"
        >
          <Icon name="x" class="h-6 w-6" />
        </button>
      </div>
    </div>
  </div>
</template>
