<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-semibold text-sm text-gray-500">List of tenants</p>

            <Link
              :href="route('tenants.create')"
              class="text-white bg-primary p-2 px-4 rounded"
            >
              Create a new tenant
            </Link>
          </div>
        </div>
        <!-- Tenants Listing -->
        <TableView
          title="Tenants Listing"
          :datum="tenants"
          show-route="tenants.show"
          edit-route="tenants.edit"
          :fields="['id', 'name', 'contact_info', 'unit']"
        />
      </div>
    </div>
  </MainLayout>
</template>

    <script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import TableView from '../../Components/Table.vue';

let props = defineProps({
  tenants: Object
});

    </script>
