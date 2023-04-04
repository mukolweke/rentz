<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-semibold text-sm text-gray-500">Create a tenants</p>
          </div>
        </div>
        <!-- Create Unit Form -->
        <div class="w-[400px]">
          <!-- Units -->
          <div class="mb-6">
            <label
              for="category"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Link a unit
            </label>

            <select
              v-model="tenantForm.unit_id"
              name="category"
              id="category"
              placeholder="Choose a unit"
              class="border border-gray-400 p-2 w-full rounded outline-purple-700"
              required
              :disabled="unitId"
              :class="{ 'bg-gray-200': unitId }"
            >
              <option selected class="text-gray-300" value="">
                Choose a unit
              </option>
              <option
                v-for="(unit, index) in unitsOptions"
                :key="index"
                :value="unit.id"
              >
                {{ unit.name }}
              </option>
            </select>
            <div
              class="text-xs text-red-500 mt-1"
              v-if="tenantForm.errors.unit_id"
            >
              {{ tenantForm.errors.unit_id }}
            </div>
          </div>
          <!-- First Name -->
          <div class="mb-6">
            <label
              for="first_name"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              First Name
            </label>

            <input
              v-model="tenantForm.first_name"
              type="text"
              name="first name"
              placeholder="Enter the first name"
              class="border border-gray-400 placeholder:text-sm p-2 w-full rounded outline-purple-700"
              id="first_name"
              required
            />
            <div
              class="text-xs text-red-500 mt-1"
              v-if="tenantForm.errors.first_name"
            >
              {{ tenantForm.errors.first_name }}
            </div>
          </div>
          <!-- Last Name -->
          <div class="mb-6">
            <label
              for="last_name"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Last Name
            </label>

            <input
              v-model="tenantForm.last_name"
              type="text"
              name="last name"
              placeholder="Enter the last name"
              class="border border-gray-400 placeholder:text-sm p-2 w-full rounded outline-purple-700"
              id="last_name"
              required
            />
            <div
              class="text-xs text-red-500 mt-1"
              v-if="tenantForm.errors.last_name"
            >
              {{ tenantForm.errors.last_name }}
            </div>
          </div>
          <!-- Email -->
          <div class="mb-6">
            <label
              for="email"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Email
            </label>

            <input
              v-model="tenantForm.email"
              type="text"
              name="email"
              placeholder="Enter tenant email"
              class="border border-gray-400 placeholder:text-sm p-2 w-full rounded outline-purple-700"
              id="email"
              required
            />
            <div
              class="text-xs text-red-500 mt-1"
              v-if="tenantForm.errors.email"
            >
              {{ tenantForm.errors.email }}
            </div>
          </div>

          <!-- Phone -->
          <div class="mb-6">
            <label
              for="phone"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Phone Number
            </label>

            <input
              v-model="tenantForm.phone"
              type="text"
              name="phone"
              placeholder="Enter tenant phone number (2547********)"
              class="border border-gray-400 placeholder:text-sm p-2 w-full rounded outline-purple-700"
              id="phone"
              required
            />
            <div
              class="text-xs text-red-500 mt-1"
              v-if="tenantForm.errors.phone"
            >
              {{ tenantForm.errors.phone }}
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="mt-4 flex justify-end items-center space-x-4">
            <Button label="Cancel" outline @click="back" />
            <Button label="Create Tenant" @click="createTenant" />
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import Button from '../../Components/Button.vue';

let props = defineProps({
  unitsOptions: Array,
  unitId: Number | null
});

const tenantForm = useForm({
  first_name: null,
  last_name: null,
  email: null,
  phone: null,
  unit_id: props.unitId ?? '',
});


let isSubmitSuccess = ref(false);

let createTenant = () => {
  isSubmitSuccess.value = false;

  tenantForm.post('/tenants', {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
      tenantForm.reset();
    },
  });
}

let back = () => {
  window.history.back();
}

</script>
