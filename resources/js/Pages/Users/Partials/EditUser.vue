<template>
  <Modal :submitSuccess="isSubmitSuccess" @confirm="updateTenant">
    <template v-slot:toggleBtn="{ onClick }">
      <div
        @click="onClick()"
        class="font-semibold text-primaryAlt cursor-pointer"
      >
        Update
      </div>
    </template>
    <template v-slot:header> Update User </template>
    <template v-slot:body>
      <div class="w-[500px]">
        <div class="">
          <!-- Name -->
          <div class="mb-6">
            <TextInput
              v-model="userForm.name"
              name="name"
              placeholder="Enter user full name"
              class="w-full"
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
              class="w-full"
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
              placeholder="Enter user phone"
              class="w-full"
              label-string="Phone Number"
              :input-error="userForm.errors.phone"
              required
            />
          </div>

          <!-- Occupation -->
          <div class="mb-6" v-if="user.role == 'tenant'">
            <TextInput
              v-model="userForm.occupation"
              name="occupation"
              placeholder="Enter user occupation"
              class="w-full"
              label-string="Occupation"
              help-text="Please provide the source of income e.g. Sales agent at Rentz Supermarket"
              :input-error="userForm.errors.occupation"
              required
            />
          </div>
        </div>
      </div>
    </template>
  </Modal>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '../../../Components/TextInput.vue';

let props = defineProps({
  user: Object,
});

const userForm = useForm({
  name: props.user.name,
  email: props.user.email,
  phone: props.user.phone,
  role: props.user.role,
  occupation: props.user.occupation,
});


let isSubmitSuccess = ref(false);

let updateTenant = () => {
  isSubmitSuccess.value = false;

  userForm.patch('/users/' + props.user.id, {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
      userForm.reset();
    },
  });
}
</script>
