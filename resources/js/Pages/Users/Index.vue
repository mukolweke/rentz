<template>
  <MainLayout>
    <div class="h-full">
      <!-- Page Content -->
      <div class="mt-4 bg-white p-8 shadow-lg rounded-lg">
        <div class="mb-8">
          <p class="font-normal text-2xl antialiased mb-4">Users</p>

          <div class="flex items-center justify-between">
            <!-- Search Input -->
            <div class="max-w-[200px]">
              <Search v-model="search" placeholder="Search users..." />
            </div>
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
          :fields="['id', 'name', 'email', 'phone', 'role_display']"
        />
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref, watch } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import TableView from '../../Components/Table.vue';
import Search from '../../Components/TextInput.vue';
import debounce from 'lodash/debounce';
import { router } from '@inertiajs/vue3';

let props = defineProps({
  users: Object,
  filters: Object
});

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
  router.get('/users', { search: value }, { preserveState: true, replace: true })
}, 300));
</script>
