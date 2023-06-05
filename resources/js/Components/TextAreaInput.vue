<template>
  <label
    for="labelString"
    class="block mb-2 uppercase font-bold text-xs text-gray-700"
  >
    {{ labelString }}
  </label>

  <textarea
    :value="modelValue"
    @input="updateValue"
    :id="labelString"
    rows="4"
    class="block p-2.5 w-full placeholder:text-sm outline-primary rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
    :placeholder="placeholder"
    :disabled="disabled"
    :class="{ 'bg-gray-200': disabled }"
  ></textarea>

  <div class="text-xs text-red-500 mt-1" v-if="inputError">
    {{ inputError }}
  </div>
</template>

<script setup>
defineProps({
  modelValue: String,
  placeholder: String,
  labelString: String,
  inputError: String,
  disabled: Boolean,
});

const emit = defineEmits(['update:model-value'])

const updateValue = (event) => {
  emit('update:model-value', event.target.value)
}
</script>
