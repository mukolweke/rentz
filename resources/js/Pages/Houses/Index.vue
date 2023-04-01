<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-semibold text-sm text-gray-500">List of houses</p>

            <CreateHouse :categories="categoryOptions" />
          </div>
        </div>
        <!-- Houses Listing -->
        <TableView
          @activeRow="
            (data) => {
              houseForm.name = data.name;
              houseForm.id = data.id;
            }
          "
          title="Houses"
          :datum="houses"
          show-route="houses.show"
          edit-route="houses.edit"
          :fields="['id', 'name', 'slug', 'category', 'created_on', 'updated_on']"
        />
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import TableView from '../../Components/Table.vue';

// Partials Imports
import CreateHouse from './Partials/CreateHouse.vue';

let props = defineProps({
  categories: Object,
  categoryOptions: Array,
  houses: Object,
});

</script>
