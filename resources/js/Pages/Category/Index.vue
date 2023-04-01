<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-8 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-semibold text-sm text-gray-500">
              List of categories
            </p>

            <CreateCategory />
          </div>
        </div>
        <!-- Category Listing -->
        <TableView
          @activeRow="
            (data) => {
              categoryForm.name = data.name;
              categoryForm.id = data.id;
            }
          "
          title="Category"
          :datum="categories"
          :fields="['id', 'name', 'slug', 'created_on']"
        >
          <!-- Actions Slot -->
          <template v-slot:actions="{ onActionClick }">
            <div class="flex items-center space-x-4">
              <EditCategory
                :onActionClick="onActionClick"
                :item="categoryForm"
              />

              <DeleteCategory
                :onActionClick="onActionClick"
                :itemId="categoryForm.id"
              />
            </div>
          </template>
        </TableView>
      </div>
    </div>
  </MainLayout>
</template>

  <script setup>
import { ref } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import TableView from '../../Components/Table.vue';
import { useForm } from '@inertiajs/vue3'

// Partials Imports
import CreateCategory from './Partials/CreateCategory.vue';
import DeleteCategory from './Partials/DeleteCategory.vue';
import EditCategory from './Partials/EditCategory.vue';

let props = defineProps({
  categories: Object,
  categoryOptions: Array,
  houses: Object,
});

const categoryForm = useForm({
  name: null,
});
  </script>
