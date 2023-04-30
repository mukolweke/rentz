<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <p class="font-normal text-2xl antialiased">Users</p>

            <Link
              :href="route('users.create')"
              class="text-white bg-primary p-2 px-4 rounded"
            >
              Create User
            </Link>
          </div>
        </div>
        <!-- Users Listing -->
        <TableView
          title="Users Listing"
          :datum="users"
          show-route="users.show"
          edit-route="users.edit"
          :fields="['id', 'name', 'email', 'phone', 'role_display']"
        />
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '../../Layouts/MainLayout.vue';
import TableView from '../../Components/Table.vue';

let props = defineProps({
  users: Object
});
</script>
