<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <p class="font-normal text-2xl antialiased mb-4">Houses</p>

          <div class="flex items-center justify-between">
            <div class="max-w-[200px]">
              <Search v-model="search" placeholder="Search houses..." />
            </div>

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
          :fields="['id', 'name', 'slug', 'category']"
        />
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import MainLayout from '../../Layouts/MainLayout.vue';
import TableView from '../../Components/Table.vue';
import Search from '../../Components/TextInput.vue'
import debounce from 'lodash/debounce';
import CreateHouse from './Partials/CreateHouse.vue';

let props = defineProps({
  categories: Object,
  categoryOptions: Array,
  houses: Object,
  filters: Object
});

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
  router.get('/houses', { search: value }, { preserveState: true, replace: true })
}, 300));

</script>
