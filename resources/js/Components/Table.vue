<template>
  <div>
    <div class="relative overflow-x-auto sm:rounded-lg">
      <table
        class="w-full text-sm text-left text-gray-500"
        aria-describedby="Display Table"
      >
        <thead
          class="text-xs text-gray-700 uppercase border-b-2 border-purple-700 bg-gray-50"
        >
          <tr>
            <th
              v-for="field in fields"
              :key="field"
              scope="col"
              class="px-6 py-3 text-purple-700"
            >
              {{ field.replace("_", " ") }}
            </th>
            <th
              v-if="displayAction"
              scope="col"
              class="px-6 py-3 text-purple-700"
            >
              Actions
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(dataItem, index) in datum.data"
            :key="index"
            class="bg-white border-b"
          >
            <td
              v-for="field in fields"
              :key="field"
              class="px-6 py-4 font-medium whitespace-nowrap"
              v-html="dataItem[field]"
            ></td>
            <td v-if="displayAction" class="px-6 py-4">
              <!-- Actions Slot -->
              <slot
                v-if="showSlotActions()"
                name="actions"
                :onActionClick="() => actionClicked(dataItem)"
              ></slot>
              <div v-else class="flex items-center space-x-4">
                <Link
                  preserve-scroll
                  :href="route(showRoute, dataItem['id'])"
                  class="text-green-700 font-medium hover:underline"
                >
                  View
                </Link>
                <Link
                  preserve-scroll
                  :href="route(editRoute, dataItem['id'])"
                  class="text-blue-700 font-medium hover:underline"
                >
                  Edit
                </Link>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <Pagination
      class="mt-8 text-right"
      :links="datum.links"
      :prev_url="datum.prev_page_url"
      :next_url="datum.next_page_url"
    />
  </div>
</template>

<script setup>
import { useSlots } from 'vue'
import Pagination from "./Pagination.vue"

defineProps({
  datum: Object,
  fields: Array,
  showRoute: String,
  editRoute: String,
  displayAction: {
    type: Boolean, default: true,
  },
});

let emit = defineEmits(['activeRow']);

let actionClicked = (data) => {
  emit('activeRow', data)
}

const slots = useSlots()
const showSlotActions = () => {
  return !!slots.actions
}
</script>
