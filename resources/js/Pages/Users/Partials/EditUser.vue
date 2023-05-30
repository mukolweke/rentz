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
            <PhoneInput
              v-model="userForm.phone"
              name="phone"
              placeholder="Enter user phone"
              class="w-full"
              label-string="Phone Number"
              :input-error="userForm.errors.phone"
              required
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
          <div class="mb-6" v-if="user.role == 'tenant'">
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
        </div>
      </div>
    </template>
  </Modal>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '../../../Components/TextInput.vue';
import SelectInput from '../../../Components/SelectInput.vue';
import axios from 'axios';
import PhoneInput from '../../../Components/PhoneInput.vue';

let props = defineProps({
  user: Object,
});

const userForm = useForm({
  name: props.user.name,
  email: props.user.email,
  phone: props.user.phone,
  role: props.user.role,
  occupation: props.user.occupation,
  house: props.user.house_id,
  staffRole: props.user.staff_role,
});

let houseOptions = ref([]);

onMounted(async () => {
  await getHouseOptions();
})

const getHouseOptions = async () => {
  // if role staff fetch house options
  if (props.user.role === 'staff') {
    let response = await axios.get('/api/house-options');

    if (response.data) {
      houseOptions.value = [...response.data]
    }
  }
}

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
