<template>
  <label
    :for="labelString"
    class="block mb-2 uppercase font-bold text-xs text-gray-700"
  >
    {{ labelString }}
  </label>

  <select
    :value="modelValue"
    @input="updateValue"
    :disabled="disabled"
    :id="labelString"
    class="border border-gray-400 p-2 w-full rounded outline-primary"
  >
    <option selected class="text-gray-300" value="">Choose an option</option>
    <option
      v-for="(item, index) in selectOptions"
      :key="index"
      :value="item.id"
    >
      {{ item.name }}
    </option>
  </select>

  <div class="text-xs text-red-500 mt-1" v-if="inputError">
    {{ inputError }}
  </div>
</template>

<script setup>
defineProps({
  modelValue: String,
  disabled: Boolean,
  selectOptions: Array | Object,
  labelString: String,
  inputError: String
})

const emit = defineEmits(['update:modelValue'])

const updateValue = (event) => {
  emit('update:modelValue', event.target.value)
}
</script>
