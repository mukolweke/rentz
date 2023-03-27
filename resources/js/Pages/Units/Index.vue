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
      <div class="mt-8 bg-white p-8 shadow-lg rounded-lg ">
        <div v-if="activeTab == 'units'" class="h-[450px]">
          <!-- <TableView :title="activeTab" :datum="[1, 2, 3, 4, 5]" /> -->
        </div>

        <div v-if="activeTab == 'categories'" class="h-[450px]">
          <div class="mb-8">
            <div class="flex items-center justify-between">
              <p class="font-semibold text-sm text-gray-500">
                List of categories
              </p>

              <button
                class="bg-primaryGreen text-white py-2 px-4 rounded-lg hover:shadow-sm text-sm"
              >
                Add Category
              </button>
            </div>
          </div>
          <TableView
            :title="activeTab"
            :datum="categories"
            :fields="['name', 'slug', 'created_on', 'updated_on']"
          />
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import TableView from '../../Components/Table.vue';

let props = defineProps({
  categories: Array,
});

const activeTab = ref('categories')
</script>
