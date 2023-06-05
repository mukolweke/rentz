<template>
  <label
    :for="inputId ?? labelString"
    class="block mb-2 uppercase font-bold text-xs text-gray-700"
  >
    {{ labelString }}
  </label>

  <select
    :value="modelValue"
    @input="updateValue"
    :disabled="disabled"
    :id="inputId ?? labelString"
    class="border border-gray-400 p-2 w-full rounded outline-primary"
    :class="{ 'bg-gray-200': disabled }"
  >
    <option selected class="text-gray-300" value="">Choose an option</option>
    <option
      v-for="(item, index) in selectOptions"
      :key="index"
      :value="item.id ?? item.value"
    >
      {{ item.name ?? item.label }}
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
  inputError: String,
  inputId: String || null,
})

const emit = defineEmits(['update:model-value'])

const updateValue = (event) => {
  emit('update:model-value', event.target.value)
}
</script>
