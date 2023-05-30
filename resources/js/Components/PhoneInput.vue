<template>
  <label
    v-if="labelString"
    :for="inputId ?? labelString"
    class="block mb-2 uppercase font-bold text-xs text-gray-700"
  >
    {{ labelString }}
  </label>

  <input
    v-maska
    data-maska="(+254) ### ### ###"
    :value="modelValue"
    @input="updateValue"
    :id="inputId ?? labelString"
    type="text"
    :placeholder="placeholder"
    class="border border-gray-400 placeholder:text-sm p-2 rounded outline-primary w-full"
    :disabled="disabled"
    :class="{ 'bg-gray-200': disabled }"
  />

  <div class="text-xs text-red-500 mt-1" v-if="inputError">
    {{ inputError }}
  </div>

  <div class="text-[10px] text-gray-500 mt-1" v-if="helpText">
    {{ helpText }}
  </div>
</template>

<script setup>
import { vMaska } from "maska"

defineProps({
  modelValue: String,
  placeholder: String,
  labelString: String,
  inputError: String,
  helpText: String,
  inputId: String || null,
  disabled: Boolean,
})

const emit = defineEmits(['update:modelValue'])

const updateValue = (event) => {
  emit('update:modelValue', event.target.value)
}
  </script>
