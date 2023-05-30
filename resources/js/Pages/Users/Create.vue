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
            <TextInput
              v-model="userForm.name"
              name="name"
              placeholder="Enter full name"
              label-string="Name"
              :input-error="userForm.errors.name"
              required
            />
          </div>

          <!-- Email -->
          <div class="mb-6">
            <TextInput
              v-model="userForm.email"
              name="email"
              placeholder="Enter user email"
              label-string="Email"
              :input-error="userForm.errors.email"
              required
            />
          </div>

          <!-- Phone -->
          <div class="mb-6">
            <TextInput
              v-model="userForm.phone"
              name="phone"
              placeholder="Enter user phone number (2547********)"
              label-string="Phone Number"
              :input-error="userForm.errors.phone"
            />
          </div>

          <!-- User Role -->
          <div :class="{ 'mb-6': userForm.role == 'tenant' }">
            <SelectInput
              v-model="userForm.role"
              name="category"
              label-string="User Role"
              :select-options="userRoles"
              :input-error="userForm.errors.role"
              required
            />
          </div>

          <!-- Units -->
          <div class="mb-6" v-if="userForm.role == 'tenant'">
            <SelectInput
              v-model="userForm.unit"
              name="category"
              label-string="Link a unit"
              :select-options="unitsOptions"
              :input-error="userForm.errors.unit"
            />
          </div>

          <!-- Occupation -->
          <div v-if="userForm.role == 'tenant'">
            <TextInput
              v-model="userForm.occupation"
              name="occupation"
              placeholder="Enter user occupation"
              class="w-full"
              label-string="Occupation"
              help-text="Please provide the source of income e.g. Student, Sales agent at Rentz Supermarket"
              :input-error="userForm.errors.occupation"
              required
            />
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
import { computed, onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import Button from '../../Components/Button.vue';
import TextInput from '../../Components/TextInput.vue';
import SelectInput from '../../Components/SelectInput.vue';

defineProps({
  unitsOptions: Array
});

const userForm = useForm({
  name: null,
  email: null,
  phone: null,
  role: '',
  unit: null,
  occupation: '',
});

onMounted(() => {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);

  if (urlParams.has('unit')) {
    userForm.role = 'tenant';
    userForm.unit = urlParams.get('unit');
  }
})

const userRoles = ref([
  { id: 'admin', name: 'Admin' },
  { id: 'staff', name: 'Staff' },
  { id: 'tenant', name: 'Tenant' }
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
