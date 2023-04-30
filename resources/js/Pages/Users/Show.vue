<template>
  <MainLayout>
    <div class="mb-4">
      <div class="flex items-center justify-between py-4">
        <p class="font-normal text-2xl antialiased">User Details</p>

        <div class="flex items-center space-x-4">
          <Link
            :href="route('users.edit', user.id)"
            class="p-2 px-4 bg-blue-500 rounded text-white"
          >
            <span><i class="fa fa-edit"></i></span>
          </Link>
          <!-- <Modal
            deleteModal
            :submitSuccess="isSubmitSuccess"
            @confirm="deleteUnit"
          >
            <template v-slot:toggleBtn="{ onClick }">
              <Button label="Delete" danger @click="onClick" />
            </template>

            <template v-slot:body>
              <div class="w-[400px]">
                <div class="w-full space-y-4">
                  <p class="text-center">X</p>

                  <p class="text-center">
                    Do you really want to delete this records? This process
                    cannot be undone.
                  </p>
                </div>
              </div>
            </template>
          </Modal> -->
        </div>
      </div>
    </div>
    <div class="py-4 shadow-lg rounded-lg bg-white">
      <!-- Page Content -->
      <div class="mt-8 px-8">
        <div class="w-full max-w-xl">
          <div aria-describedby="Unit Details Table">
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">Id</div>
              <div class="w-full">{{ user.id }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">Name</div>
              <div class="w-full">{{ user.name }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Email
              </div>
              <div class="w-full">{{ user.email }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Phone
              </div>
              <div class="w-full">{{ user.phone }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">Role</div>
              <div
                class="w-full font-bold capitalize"
                :class="{
                  'text-red-500': user.role == 'admin',
                  'text-green-500': user.role == 'staff',
                  'text-yellow-500': user.role == 'tenant',
                }"
              >
                {{ user.role }}
              </div>
            </div>
            <div class="flex items-center mb-4" v-if="user.unit">
              <div class="w-1/3 capitalize font-medium text-gray-400">Unit</div>
              <Link
                class="w-full font-bold text-primaryAlt"
                :href="'/units/' + user.unit_id"
              >
                {{ user.unit }}
                <span><i class="fa fa-arrow-up-right-from-square"></i></span>
              </Link>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Created
              </div>
              <div class="w-full">{{ user.created_on }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Updated
              </div>
              <div class="w-full">{{ user.updated_on }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
// import { ref } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
// import Button from '../../Components/Button.vue';
// import { useForm } from '@inertiajs/vue3'

let props = defineProps({
  user: Object
})

// const tenantForm = useForm(props.tenant);

// let isSubmitSuccess = ref(false);

// let deleteUnit = () => {
//   isSubmitSuccess.value = false;
//   tenantForm.delete('/units/' + tenantForm.id, {
//     preserveScroll: true,
//     onSuccess: () => {
//       isSubmitSuccess.value = true;
//     },
//   });
// }
</script>
