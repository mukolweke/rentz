<template>
  <MainLayout>
    <div class="mb-4">
      <div class="flex items-center justify-between py-4">
        <p class="font-normal text-2xl antialiased">House Details</p>

        <div class="flex items-center space-x-4">
          <Link
            :href="route('units.index', { house: house.id })"
            class="p-2 px-4 bg-green-500 hover:shadow-lg rounded text-white"
          >
            Units
          </Link>
          <Link
            :href="route('houses.edit', house.id)"
            class="p-2 px-4 bg-blue-500 rounded text-white"
          >
            <span><i class="fa-regular fa-edit"></i></span>
          </Link>
          <Modal
            deleteModal
            :submitSuccess="isSubmitSuccess"
            @confirm="deleteCategory"
          >
            <template v-slot:toggleBtn="{ onClick }">
              <Button label="delete" danger @click="onClick" />
            </template>

            <template v-slot:body>
              <div class="w-[400px]">
                <div class="w-full space-y-4">
                  <div class="flex items-center justify-center mb-8">
                    <div
                      class="border-2 border-red-500 rounded-full w-[100px] h-[100px] flex items-center justify-center"
                    >
                      <span class="text-4xl text-red-500"
                        ><i class="fa fa-xmark"></i
                      ></span>
                    </div>
                  </div>

                  <p class="text-center">
                    Do you really want to delete this records? This process
                    cannot be undone.
                  </p>
                </div>
              </div>
            </template>
          </Modal>
        </div>
      </div>
    </div>
    <div class="py-4 shadow-lg rounded-lg bg-white">
      <!-- Page Content -->
      <div class="mt-8 px-8">
        <div class="w-full max-w-xl">
          <div aria-describedby="House Details Table">
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">Id</div>
              <div class="w-full">{{ house.id }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">Name</div>
              <div class="w-full">{{ house.name }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">Slug</div>
              <div class="w-full">{{ house.slug }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Location
              </div>
              <div class="w-full">{{ house.location }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Category
              </div>
              <div class="w-full">{{ house.category }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Created
              </div>
              <div class="w-full">{{ house.created_on }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Updated
              </div>
              <div class="w-full">{{ house.updated_on }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- House Staff -->
    <div class="mt-16 rounded-lg bg-white shadow-lg w-full p-8">
      <div>
        <div class="flex items-center justify-between">
          <p class="font-medium">House Staff</p>
          <Link
            :href="route('users.create', { house: house.id })"
            class="p-2 px-4 text-green-500 rounded font-semibold"
          >
            Add Staff
          </Link>
        </div>

        <div class="mt-4" v-if="staffs.total > 0">
          <TableView
            class="h-full"
            :displayAction="false"
            :fields="['id', 'name', 'email', 'phone', 'role']"
            :datum="staffs"
          />
        </div>

        <div
          v-else
          class="py-[64px] text-gray-500 font-medium text-lg text-center"
        >
          No staffs assigned
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import Button from '../../Components/Button.vue';
import { useForm } from '@inertiajs/vue3'
import axios from 'axios';
import TableView from '../../Components/Table.vue';

let props = defineProps({
  house: Object,
  units: Object,
});

const staffs = ref([]);

onMounted(async () => {
  // fetch the house staff;
  let { data } = await axios.get('/api/houses/' + props.house.id + '/staff');

  staffs.value = data;
})

const houseForm = useForm(props.house);

let isSubmitSuccess = ref(false);

let deleteCategory = () => {
  isSubmitSuccess.value = false;
  houseForm.delete('/houses/' + houseForm.id, {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
    },
  });
}
</script>
