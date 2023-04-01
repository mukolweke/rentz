<template>
  <MainLayout>
    <div class="mb-4">
      <div class="flex items-center justify-between py-4">
        <p class="text-2xl">Unit Details</p>

        <div class="flex items-center space-x-4">
          <Link
            :href="route('units.edit', unit.id)"
            class="p-2 px-4 bg-blue-500 rounded text-white"
            >Edit</Link
          >
          <Modal
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
          </Modal>
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
              <div class="w-full">{{ unit.id }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">Name</div>
              <div class="w-full">{{ unit.name }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Block
              </div>
              <div class="w-full">{{ unit.block }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Description
              </div>
              <div class="w-full">{{ unit.description }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                House
              </div>
              <div class="w-full">
                <Link
                  :href="route('houses.show', unit.house_id)"
                  class="font-bold text-blue-500"
                >
                  {{ unit.house }}
                </Link>
              </div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Created
              </div>
              <div class="w-full">{{ unit.created_on }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Updated
              </div>
              <div class="w-full">{{ unit.updated_on }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Units Actions -->
    <div class="mt-16">
      <p class="text-lg mb-4">Units Actions</p>
      <div class="flex items-center space-x-4">
        <div class="p-2 px-4 bg-green-500 rounded text-white">
          Tenant History
        </div>

        <div class="p-2 px-4 bg-yellow-500 rounded text-white">
          Repair History
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import Button from '../../Components/Button.vue';
import { useForm } from '@inertiajs/vue3'

let props = defineProps({
  unit: Object
})

const unitForm = useForm(props.unit);

let isSubmitSuccess = ref(false);

let deleteUnit = () => {
  isSubmitSuccess.value = false;
  unitForm.delete('/units/' + unitForm.id, {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
    },
  });
}
</script>
