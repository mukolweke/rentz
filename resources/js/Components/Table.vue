<template>
  <div>
    <div class="relative overflow-x-auto sm:rounded-lg">
      <table
        class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        aria-describedby="Display Table"
      >
        <thead
          class="text-xs text-gray-700 uppercase border-b-2 border-primaryGreen bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th
              v-for="field in fields"
              :key="field"
              scope="col"
              class="px-6 py-3 text-primaryGreen"
            >
              {{ field.replace("_", " ") }}
            </th>
            <th scope="col" class="px-6 py-3 text-primaryGreen">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(dataItem, index) in datum.data"
            :key="index"
            class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"
          >
            <td
              v-for="field in fields"
              :key="field"
              class="px-6 py-4 font-medium whitespace-nowrap"
            >
              {{ dataItem[field] }}
            </td>
            <td class="px-6 py-4">
              <!-- Actions Slot -->
              <slot name="actions"></slot>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <Pagination
      v-if="datum.total > 5"
      class="mt-8 text-right"
      :links="datum.links"
      :prev_url="datum.prev_page_url"
      :next_url="datum.next_page_url"
    />
  </div>
</template>

<script setup>
import Pagination from "./Pagination.vue"

defineProps({ datum: Object, fields: Array });
</script>
