<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-semibold text-sm text-gray-500">
              <span v-if="house">{{ house.name }} house list of units</span>
              <span v-else>List of units</span>
            </p>

            <div class="space-x-6 flex items-center">

              <input
                v-model="search"
                type="text"
                placeholder="Search..."
                class="border rounded px-4 py-1.5 outline-primaryAltLight"
              />

              <Link
                :href="
                  house
                    ? route('units.create', { house: house.id })
                    : route('units.create')
                "
                class="text-white bg-primary p-2 px-4 rounded"
              >
                {{ house ? "Link a new unit" : "Create a new unit" }}
              </Link>
            </div>
          </div>
        </div>
        <!-- Units Listing -->
        <TableView
          title="Units Listing"
          :datum="units"
          show-route="units.show"
          edit-route="units.edit"
          :fields="['id', 'name', 'block', 'house', 'available']"
        />
      </div>
    </div>
  </MainLayout>
</template>

  <script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import TableView from '../../Components/Table.vue';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';

let props = defineProps({
  units: Object,
  house: Object | null,
  filters: Object
});

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
  router.get('/units', { search: value }, { preserveState: true, replace: true })
}, 300));
  </script>
