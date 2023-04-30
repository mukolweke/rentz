<template>
  <input
    :value="modelValue"
    @input="updateValue"
    type="text"
    :placeholder="placeholder"
    class="border border-gray-400 placeholder:text-sm p-2 rounded outline-primary"
  />
</template>

<script setup>
defineProps({
  modelValue: String,
  placeholder: String
})

const emit = defineEmits(['update:modelValue'])

const updateValue = (event) => {
  emit('update:modelValue', event.target.value)
}
</script>
