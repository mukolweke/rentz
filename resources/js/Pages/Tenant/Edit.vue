<script setup>
import TenantLayout from '../../Layouts/TenantLayout.vue'
import BreadCrumps from '../../Components/BreadCrumps.vue';
import TextInput from '../../Components/TextInput.vue';
import PhoneInput from '../../Components/PhoneInput.vue';
import { useForm } from '@inertiajs/vue3';
import Button from '../../Components/Button.vue';
import { ref } from 'vue';
import PasswordInput from '../../Components/PasswordInput.vue'

let showPassword = ref(false);

const props = defineProps({
  user: Object,
});

const breadCrumpsOptions = [
  { href: 'tenant/dashboard/edit', label: 'Edit' }
];

// Edit Forms
let aboutForm = useForm({
  name: props.user.name,
  occupation: props.user.occupation,
});
let contactForm = useForm({
  email: props.user.email,
  phone: props.user.phone,
});
let passwordForm = useForm({
  password: '',
  password_confirmation: ''
});

// actions
const updateTenant = (form) => {
  switch (form) {
    case 'about':
      aboutForm.post(`/tenant/${props.user.id}/edit?type=about`);
      break;
    case 'contact':
      contactForm.post(`/tenant/${props.user.id}/edit?type=contact`);
      break;
    case 'password':
      passwordForm.post(`/tenant/${props.user.id}/edit?type=password`)
      break;
    default:
      break;
  }
}


</script>


<template>
  <tenant-layout :user="user" :editing="true">
    <bread-crumps class="mb-8" :options="breadCrumpsOptions" />

    <!-- Edit About -->
    <div
      class="border border-gray-200 bg-white p-4 rounded-md transition duration-200 ease-in w-full"
    >
      <div
        class="tracking-normal uppercase text-sm text-gray-400 border-b border-gray-300 pb-2 font-semibold mb-8"
      >
        About
      </div>
      <div class="grid grid-cols-2 gap-8">
        <div>
          <TextInput
            v-model="aboutForm.name"
            name="name"
            placeholder="Enter full name"
            label-string="Name"
            :input-error="aboutForm.errors.name"
            required
          />
        </div>

        <div>
          <TextInput
            v-model="aboutForm.occupation"
            name="occupation"
            placeholder="Enter occupation"
            label-string="Occupation"
            :input-error="aboutForm.errors.occupation"
            help-text="Please provide the source of income e.g. Student, Sales agent at Rentz Supermarket"
            required
          />
        </div>
      </div>

      <div class="w-full flex justify-end mt-8">
        <Button label="Save" class="" @click="updateTenant('about')" />
      </div>
    </div>

    <!-- Edit Contact -->
    <div
      class="border border-gray-200 bg-white p-4 mt-4 rounded-md transition duration-200 ease-in w-full"
    >
      <div
        class="tracking-normal uppercase text-sm text-gray-400 border-b border-gray-300 pb-2 font-semibold mb-8"
      >
        Contact
      </div>

      <div class="grid grid-cols-2 gap-8">
        <div>
          <TextInput
            v-model="contactForm.email"
            name="email"
            placeholder="Enter email"
            label-string="email"
            :input-error="contactForm.errors.email"
            required
          />
        </div>

        <div>
          <PhoneInput
            v-model="contactForm.phone"
            name="phone"
            placeholder="Enter phone"
            class="bg-transparent"
            label-string="phone"
            :input-error="contactForm.errors.phone"
            required
          />
        </div>
      </div>

      <div class="w-full flex justify-end mt-8">
        <Button label="Save" class="" @click="updateTenant('contact')" />
      </div>
    </div>

    <!-- Edit Password -->
    <div
      class="border border-gray-200 bg-white p-4 mt-4 rounded-md transition duration-200 ease-in w-full"
    >
      <div
        class="tracking-normal uppercase text-sm text-gray-400 border-b border-gray-300 pb-2 font-semibold mb-8"
      >
        Password
      </div>
      <div class="grid grid-cols-2 gap-8">
        <div>
          <PasswordInput
            v-model="passwordForm.password"
            name="password"
            placeholder="Enter password"
            label-string="password"
            :input-error="passwordForm.errors.password"
            required
          />
        </div>

        <div>
          <PasswordInput
            v-model="passwordForm.password_confirmation"
            name="password_confirmation"
            placeholder="Enter confirm password"
            label-string="confirm password"
            :input-error="passwordForm.errors.password_confirmation"
            required
          />
        </div>
      </div>
      <div class="w-full flex justify-end mt-8">
        <Button label="Save" class="" @click="updateTenant('password')" />
      </div>
    </div>
  </tenant-layout>
</template>
