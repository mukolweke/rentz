<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-normal text-2xl antialiased">Create User</p>
          </div>
        </div>
        <!-- Create User Form -->
        <div class="w-[400px]">
          <!-- Name -->
          <div class="mb-6">
            <label
              for="name"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Name
            </label>

            <input
              v-model="userForm.name"
              type="text"
              name="name"
              placeholder="Enter full name"
              class="border border-gray-400 placeholder:text-sm p-2 w-full rounded outline-primary"
              id="name"
              required
            />
            <div class="text-xs text-red-500 mt-1" v-if="userForm.errors.name">
              {{ userForm.errors.name }}
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
              v-model="userForm.email"
              type="text"
              name="email"
              placeholder="Enter user email"
              class="border border-gray-400 placeholder:text-sm p-2 w-full rounded outline-primary"
              id="email"
              required
            />
            <div class="text-xs text-red-500 mt-1" v-if="userForm.errors.email">
              {{ userForm.errors.email }}
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
              v-model="userForm.phone"
              type="text"
              name="phone"
              placeholder="Enter user phone number (2547********)"
              class="border border-gray-400 placeholder:text-sm p-2 w-full rounded outline-primary"
              id="phone"
            />
            <div class="text-xs text-red-500 mt-1" v-if="userForm.errors.phone">
              {{ userForm.errors.phone }}
            </div>
          </div>

          <!-- User Role -->
          <div :class="{ 'mb-6': userForm.role.toLowerCase() == 'tenant' }">
            <label
              for="category"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              User Role
            </label>

            <select
              v-model="userForm.role"
              name="category"
              id="category"
              placeholder="Choose a unit"
              class="border border-gray-400 p-2 w-full rounded outline-primary"
              required
            >
              <option selected class="text-gray-300" value="">
                Choose an option
              </option>
              <option
                v-for="(role, index) in userRoles"
                :key="index"
                :value="role"
                class="capitalize"
              >
                {{ role }}
              </option>
            </select>
            <div class="text-xs text-red-500 mt-1" v-if="userForm.errors.role">
              {{ userForm.errors.role }}
            </div>
          </div>

          <!-- Units -->
          <div class="" v-if="userForm.role.toLowerCase() == 'tenant'">
            <label
              for="category"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Link a unit
            </label>

            <select
              v-model="userForm.unit"
              name="category"
              id="category"
              placeholder="Choose a unit"
              class="border border-gray-400 p-2 w-full rounded outline-primary"
              required
            >
              <option selected class="text-gray-300" value="">
                Choose an option
              </option>
              <option
                v-for="(unit, index) in unitsOptions"
                :key="index"
                :value="unit.id"
              >
                {{ unit.name }}
              </option>
            </select>
            <div class="text-xs text-red-500 mt-1" v-if="userForm.errors.unit">
              {{ userForm.errors.unit }}
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="mt-8 flex justify-end items-center space-x-4">
            <Button label="Cancel" outline @click="back" />
            <Button label="Create User" @click="createUser" />
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

defineProps({
  unitsOptions: Array
});

const userForm = useForm({
  name: null,
  email: null,
  phone: null,
  role: '',
  unit: '',
});

const userRoles = ref([
  'Admin', 'Staff', 'Tenant'
])

let isSubmitSuccess = ref(false);

let createUser = () => {
  isSubmitSuccess.value = false;

  userForm.post('/users', {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
      userForm.reset();
    },
  });
}

let back = () => {
  window.history.back();
}

</script>
