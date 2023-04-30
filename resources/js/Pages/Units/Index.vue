<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <p class="font-normal text-2xl antialiased capitalize mb-4">
            <span v-if="house">{{ house.name }} Units</span>
            <span v-else>Units</span>
          </p>
          <div class="flex items-center justify-between">
            <!-- Search Input -->
            <Search v-model="search" placeholder="Search..." />

            <div class="space-x-6 flex items-center">
              <Link
                :href="
                  house
                    ? route('units.create', { house: house.id })
                    : route('units.create')
                "
                class="text-white bg-primary p-2 px-4 rounded"
              >
                {{ house ? "Link Unit" : "Create Unit" }}
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
import Search from '../../Components/TextInput.vue';

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
