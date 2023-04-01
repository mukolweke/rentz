<template>
  <MainLayout>
    <div class="mb-4">
      <div class="flex items-center justify-between py-4">
        <p class="text-2xl">House Details</p>

        <div class="flex items-center space-x-4">
          <Link
            :href="route('houses.edit', house.id)"
            class="p-2 px-4 bg-blue-500 rounded text-white"
            >Edit</Link
          >
          <Modal
            deleteModal
            :submitSuccess="isSubmitSuccess"
            @confirm="deleteCategory"
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
          <div aria-describedby="House Details Table">
            <div
              v-for="(value, key) in house"
              :key="value"
              class="flex items-center mb-4"
            >
              <div class="w-1/3 capitalize font-medium text-gray-400">
                {{ key }}
              </div>
              <div class="w-full">{{ value }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Units Sections -->
    <UnitsIndex v-if="units.total > 0" :units="units" :house-id="house.id" />
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import Button from '../../Components/Button.vue';
import { useForm } from '@inertiajs/vue3'

import UnitsIndex from './Units/Index.vue'
let props = defineProps({
  house: Object,
  units: Array,
})

const back = () => {
  history.back();
  return false;
}

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
