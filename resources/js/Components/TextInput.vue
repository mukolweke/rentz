<template>
  <label
    v-if="labelString"
    :for="labelString"
    class="block mb-2 uppercase font-bold text-xs text-gray-700"
  >
    {{ labelString }}
  </label>

  <input
    :value="modelValue"
    @input="updateValue"
    :id="labelString"
    type="text"
    :placeholder="placeholder"
    class="border border-gray-400 placeholder:text-sm p-2 rounded outline-primary w-full"
  />

  <div class="text-xs text-red-500 mt-1" v-if="inputError">
    {{ inputError }}
  </div>

  <div class="text-[10px] text-gray-500 mt-1" v-if="helpText">
    {{ helpText }}
  </div>
</template>

<script setup>
defineProps({
  modelValue: String,
  placeholder: String,
  labelString: String,
  inputError: String,
  helpText: String,
})

const emit = defineEmits(['update:modelValue'])

const updateValue = (event) => {
  emit('update:modelValue', event.target.value)
}
</script>
