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
            <PhoneInput
              v-model="userForm.phone"
              name="phone"
              placeholder="Enter user phone number (2547********)"
              label-string="Phone Number"
              :input-error="userForm.errors.phone"
            />
          </div>

          <!-- User Role -->
          <div class="mb-6">
            <SelectInput
              v-model="userForm.role"
              name="role"
              label-string="User Role"
              :select-options="userRoles"
              :input-error="userForm.errors.role"
              :disabled="
                getUrlParams().has('unit') || getUrlParams().has('house')
              "
              required
            />
          </div>

          <!-- Units -->
          <div class="mb-6" v-if="userForm.role == 'tenant'">
            <SelectInput
              v-model="userForm.unit"
              name="unit"
              label-string="Link a unit"
              :select-options="unitOptions"
              :input-error="userForm.errors.unit"
              :disabled="getUrlParams().has('unit')"
            />
          </div>
          <!-- Houses -->
          <div class="mb-6" v-if="userForm.role == 'staff'">
            <SelectInput
              v-model="userForm.house"
              name="house"
              label-string="Link a house"
              :select-options="houseOptions"
              :input-error="userForm.errors.house"
              :disabled="getUrlParams().has('house')"
            />
          </div>

          <!-- Staff Role -->
          <div class="mb-6" v-if="userForm.role == 'staff'">
            <TextInput
              v-model="userForm.staffRole"
              name="staff role"
              placeholder="Enter the staff role e.g. caretaker"
              label-string="Staff Role"
              :input-error="userForm.errors.staffRole"
            />
          </div>

          <!-- Occupation -->
          <div class="mb-6" v-if="userForm.role == 'tenant'">
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

          <!-- Avatar -->
          <div>
            <label
              for="avatar"
              class="block mb-2 uppercase font-bold text-xs text-gray-700"
            >
              Avatar
            </label>

            <AvatarInput
              v-model="userForm.avatar"
              :create-page="true"
              class="w-40 h-40 rounded-lg"
              placeholder="Upload Avatar"
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
import { onMounted, ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3'
import Button from '../../Components/Button.vue';
import TextInput from '../../Components/TextInput.vue';
import SelectInput from '../../Components/SelectInput.vue';
import axios from 'axios';
import PhoneInput from '../../Components/PhoneInput.vue';
import AvatarInput from '../../Components/AvatarInput.vue';

let unitOptions = ref([]);
let houseOptions = ref([]);

const userForm = useForm({
  name: null,
  email: null,
  phone: null,
  role: '',
  unit: null,
  house: null,
  staffRole: '',
  occupation: '',
  avatar: null,
});

const getUrlParams = () => {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);

  return urlParams;
}

onMounted(() => {
  let urlParams = getUrlParams();

  if (urlParams.has('unit')) {
    userForm.role = 'tenant';
    userForm.unit = urlParams.get('unit');
  }

  if (urlParams.has('house')) {
    userForm.role = 'staff';
    userForm.house = urlParams.get('house');
  }
});


watch(() => userForm.role, async (value) => {
  // if role tenant fetch unit options
  if (value === 'tenant') {
    axios.get('/api/unit-options').then(({ data }) => {
      unitOptions.value = [...data]
    }).catch((err) => console.log(err));
  }

  // if role staff fetch house options
  if (value === 'staff') {
    axios.get('/api/house-options').then(({ data }) => {
      houseOptions.value = [...data]
    }).catch((err) => console.log(err));
  }
});

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
    forceFormData: true,
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
