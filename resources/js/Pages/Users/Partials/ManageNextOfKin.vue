<template>
  <div>
    <Modal
      :submitSuccess="isSubmitSuccess"
      @confirm="addNextOfKins"
      @cancel="modalClosed"
    >
      <template v-slot:toggleBtn="{ onClick }">
        <div
          @click="onClick()"
          class="font-semibold text-primaryAlt cursor-pointer capitalize"
        >
          {{
            nextOfKins.length > 0 ? "Manage next of kins" : "Add next of kins"
          }}
        </div>
      </template>
      <template v-slot:header>
        {{ nextOfKins.length > 0 ? "Manage next of kins" : "Add next of kins" }}
      </template>
      <template v-slot:body>
        <div v-for="(kin, index) in nextOfKinForm.kins" :key="index">
          <div class="flex items-end justify-between space-x-4">
            <!-- Name -->
            <div class="">
              <TextInput
                v-model="nextOfKinForm.kins[index].name"
                name="name"
                placeholder="Enter user full name"
                class="w-full"
                label-string="Name"
                :input-id="'name_' + index"
                :input-error="nextOfKinForm.errors['kins.' + index + '.name']"
                required
              />
            </div>

            <!-- Email -->
            <div class="">
              <TextInput
                v-model="nextOfKinForm.kins[index].email"
                name="email"
                placeholder="Enter user email"
                class="w-full"
                label-string="Email"
                :input-id="'email_' + index"
                :input-error="nextOfKinForm.errors['kins.' + index + '.email']"
                required
              />
            </div>

            <!-- Phone -->
            <div class="">
              <TextInput
                v-model="nextOfKinForm.kins[index].phone"
                name="phone"
                placeholder="Enter user phone"
                class="w-full"
                label-string="Phone Number"
                :input-id="'phone_' + index"
                :input-error="nextOfKinForm.errors['kins.' + index + '.phone']"
                required
              />
            </div>

            <!-- Relation -->
            <div class="">
              <SelectInput
                v-model="nextOfKinForm.kins[index].relation"
                name="relation"
                placeholder="Enter user relation"
                class="w-full"
                label-string="Relation"
                :input-id="'relation_' + index"
                :input-error="
                  nextOfKinForm.errors['kins.' + index + '.relation']
                "
                :select-options="[
                  { label: 'Child', value: 'Child' },
                  { label: 'Spouse', value: 'Spouse' },
                  { label: 'Brother', value: 'Brother' },
                  { label: 'Sister', value: 'Sister' },
                  { label: 'Parent', value: 'Parent' },
                ]"
                required
              />
            </div>

            <!-- Remove Kin data from array -->
            <div
              class="h-full cursor-pointer"
              v-if="nextOfKinForm.kins.length > 1"
              @click="nextOfKinForm.kins.splice(index, 1)"
            >
              <span class="h-full text-red-500 px-2 py-4">
                <i class="fa fa-trash-alt"></i>
              </span>
            </div>
          </div>
          <div class="w-full h-px bg-gray-200 my-4"></div>
        </div>
        <div
          v-if="nextOfKinForm.kins.length < 3"
          @click="
            nextOfKinForm.kins.push({
              name: '',
              email: '',
              phone: '',
              relation: '',
            })
          "
          class="capitalize text-primaryAlt cursor-pointer text-sm p-3 w-max"
        >
          <span><i class="fa fa-add"></i></span>
          add kin
        </div>
      </template>
    </Modal>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import TextInput from '../../../Components/TextInput.vue';
import SelectInput from '../../../Components/SelectInput.vue';

const props = defineProps({
  userId: Number,
  nextOfKins: Array,
});

const nextOfKinForm = useForm({
  kins: props.nextOfKins.length > 0
    ? [
      ...props.nextOfKins
    ]
    : [
      { name: '', email: '', phone: '', relation: '' }
    ]
});

let isSubmitSuccess = ref(false);

let addNextOfKins = () => {
  isSubmitSuccess.value = false;

  nextOfKinForm.post('/users/' + props.userId + '/next-of-kins', {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
      nextOfKinForm.reset();
    },
  });
}

let modalClosed = () => {
  nextOfKinForm.reset();
}
</script>
