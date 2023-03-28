<template>
  <MainLayout>
    <div>
      <!-- Tabs Title -->
      <div
        class="bg-white p-4 py-8 shadow-lg rounded-lg flex items-center space-x-4"
      >
        <div
          class="cursor-pointer"
          :class="{
            'underline underline-offset-4 font-semibold': activeTab === 'units',
          }"
          @click="activeTab = 'units'"
        >
          Units
        </div>
        <div
          class="cursor-pointer"
          :class="{
            'underline underline-offset-4 font-semibold':
              activeTab === 'categories',
          }"
          @click="activeTab = 'categories'"
        >
          Categories
        </div>
      </div>

      <!-- Tabs Content -->
      <div class="mt-8 bg-white p-8 shadow-lg rounded-lg">
        <div v-if="activeTab == 'units'" class="h-[450px]">
          <!-- <TableView :title="activeTab" :datum="[1, 2, 3, 4, 5]" /> -->
        </div>

        <div v-if="activeTab == 'categories'" class="h-[450px]">
          <div class="mb-8">
            <div class="flex items-center justify-between">
              <p class="font-semibold text-sm text-gray-500">
                List of categories
              </p>

              <Modal
                :submitSuccess="isSubmitSuccess"
                btnLabel="Add Category"
                @confirm="submitCategory"
              >
                <template v-slot:header> Create New Category </template>
                <template v-slot:body>
                  <div class="w-[400px]">
                    <div class="">
                      <label
                        for="name"
                        class="block mb-2 uppercase font-bold text-xs text-gray-700"
                      >
                        Name
                      </label>

                      <input
                        v-model="categoryForm.name"
                        type="text"
                        name="name"
                        class="border border-gray-400 p-2 w-full rounded outline-primaryGreen"
                        id="name"
                        required
                      />
                      <div
                        class="text-xs text-red-500 mt-1"
                        v-if="categoryForm.errors.name"
                      >
                        {{ categoryForm.errors.name }}
                      </div>
                    </div>
                  </div>
                </template>
              </Modal>
            </div>
          </div>
          <TableView
            :title="activeTab"
            :datum="categories"
            :fields="['name', 'slug', 'created_on', 'updated_on']"
          >
            <!-- Actions Slot -->
            <template v-slot:actions="{ onActionClick }">
              <div class="flex items-center space-x-4">
                <Modal>
                  <template v-slot:toggleBtn="{ onClick }">
                    <div
                      @click="onClick"
                      class="font-medium text-blue-600 cursor-pointer hover:underline"
                    >
                      Edit
                    </div>
                  </template>
                  <template v-slot:header>Edit Category </template>
                  <template v-slot:body>
                    <div class="w-[400px]">
                      <div class="">
                        <label
                          for="name"
                          class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        >
                          Name
                        </label>

                        <input
                          v-model="categoryForm.name"
                          type="text"
                          name="name"
                          class="border border-gray-400 p-2 w-full rounded outline-primaryGreen"
                          id="name"
                          required
                        />
                        <div
                          class="text-xs text-red-500 mt-1"
                          v-if="categoryForm.errors.name"
                        >
                          {{ categoryForm.errors.name }}
                        </div>
                      </div>
                    </div>
                  </template>
                </Modal>

                <div
                  class="font-medium text-red-600 cursor-pointer hover:underline"
                >
                  Delete
                </div>
              </div>
            </template>
          </TableView>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import TableView from '../../Components/Table.vue';
import { useForm } from '@inertiajs/vue3'

let props = defineProps({
  categories: Object,
});

const activeTab = ref('categories')

const categoryForm = useForm({
  name: null,
});

let isSubmitSuccess = ref(false);

let submitCategory = () => {
  isSubmitSuccess.value = false;
  categoryForm.post('/category', {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
      categoryForm.reset('name');
    },
  });
}

</script>
