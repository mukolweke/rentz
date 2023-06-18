<script setup>
import { ref } from "vue";

defineProps({
  modelValue: String,
  placeholder: String,
  labelString: String,
  inputError: String,
  helpText: String,
  inputId: String || null,
  disabled: Boolean,
})

let showPassword = ref(false);

const emit = defineEmits(['update:model-value'])

const updateValue = (event) => {
  emit('update:model-value', event.target.value)
}

</script>
<template>
  <div>
    <label
      for="password"
      class="block mb-2 uppercase font-bold text-xs text-gray-700"
    >
      {{ labelString }}
    </label>
    <div class="relative">
      <input
        :type="showPassword ? 'text' : 'password'"
        :value="modelValue"
        @input="updateValue"
        :id="inputId"
        class="border border-gray-300 pl-3 text-sm rounded focus:outline-primary block w-full px-10 p-3.5"
        placeholder="**************"
      />
      <div
        class="absolute z-50 cursor-pointer inset-y-0 right-0 flex items-center pr-3"
      >
        <span class="w-5 h-5" @click="showPassword = !showPassword">
          <span v-if="!showPassword">
            <i class="fa-regular fa-eye"></i>
          </span>
          <span v-else><i class="fa-regular fa-eye-slash"></i></span>
        </span>
      </div>
    </div>

    <div class="text-xs text-red-500 mt-1" v-if="inputError">
      {{ inputError }}
    </div>
  </div>
</template>
