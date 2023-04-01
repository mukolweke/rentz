<template>
  <div class="mt-16">
    <div class="flex items-center justify-between">
      <p class="text-lg">List of house Units</p>

      <div>
        <Link
          :href="route('units.create', { house: houseId })"
          class="text-white bg-primaryGreen p-2 px-4 rounded"
        >
          Add a unit
        </Link>
      </div>
    </div>

    <div class="mt-8 p-4 shadow-lg rounded-lg bg-white">
      <TableView
        title="House Units Listing"
        :datum="units"
        show-route="units.show"
        edit-route="units.edit"
        :fields="['id', 'name', 'block', 'house']"
      />
    </div>
  </div>
</template>

<script setup>
import TableView from '@/Components/Table.vue';

defineProps({
  houseId: Number,
  units: Array
})
</script>

