<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-normal text-2xl antialiased">Update User</p>
          </div>
        </div>
        <!-- Update User Form -->
        <div class="w-[400px]">
          <!-- Name -->
          <div class="mb-6">
            <TextInput
              v-model="userForm.name"
              name="name"
              placeholder="Enter full name"
              label-string="Full Name"
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
          <div class="" v-if="userForm.role == 'tenant'">
            <SelectInput
              v-model="userForm.unit"
              name="category"
              label-string="Link a unit"
              :select-options="unitsOptions"
              :input-error="userForm.errors.unit"
            />
          </div>

          <!-- Submit Buttons -->
          <div class="mt-8 flex justify-end items-center space-x-4">
            <Button label="Cancel" outline @click="back" />
            <Button label="Create User" @click="updateUser" />
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
import TextInput from '../../Components/TextInput.vue';
import SelectInput from '../../Components/SelectInput.vue';

let props = defineProps({
  user: Object,
  unitsOptions: Array,
});

const userForm = useForm({
  name: props.user.name,
  role: props.user.role,
  email: props.user.email,
  phone: props.user.phone,
  unit: props.user.unit_id,
});

const userRoles = ref([
  { id: 'admin', name: 'Admin' },
  { id: 'staff', name: 'Staff' },
  { id: 'tenant', name: 'Tenant' }
])

let isSubmitSuccess = ref(false);

let updateUser = () => {
  isSubmitSuccess.value = false;

  userForm.patch('/users/' + props.user.id, {
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
