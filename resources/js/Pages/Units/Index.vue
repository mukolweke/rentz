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

              <CreateCategory />
            </div>
          </div>
          <TableView
            @activeRow="
              (data) => {
                categoryForm.name = data.name;
                categoryForm.id = data.id;
              }
            "
            :title="activeTab"
            :datum="categories"
            :fields="['name', 'slug', 'created_on', 'updated_on']"
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
});

const activeTab = ref('categories')

const categoryForm = useForm({
  name: null,
});
</script>
