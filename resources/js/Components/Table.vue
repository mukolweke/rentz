<template>
  <div>
    <div class="relative overflow-x-auto sm:rounded-lg">
      <table class="w-full text-sm text-left" aria-describedby="Display Table">
        <thead
          class="text-xs uppercase border-b-2 border-primaryAlt bg-gray-50 text-center"
        >
          <tr>
            <th
              v-for="field in fields"
              :key="field"
              scope="col"
              class="px-6 py-3 text-primaryAlt"
            >
              {{ field.replace("_", " ") }}
            </th>
            <th
              v-if="displayAction"
              scope="col"
              class="px-6 py-3 text-primaryAlt"
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
              class="px-6 py-4 font-medium whitespace-nowrap text-center"
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
                  <span class="text-lg"><i class="fa-regular fa-eye"></i></span>
                </Link>
                <Link
                  preserve-scroll
                  :href="route(editRoute, dataItem['id'])"
                  class="text-blue-700 font-medium hover:underline"
                >
                  <span class="text-lg"
                    ><i class="fa-regular fa-edit"></i
                  ></span>
                </Link>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <Pagination
      v-if="datum.total > 0"
      class="mt-8 text-right"
      :links="datum.links"
      :prev_url="datum.prev_page_url"
      :next_url="datum.next_page_url"
    />

    <p
      v-if="datum.total == 0"
      class="text-center text-lg font-medium opacity-30 my-20"
    >
      There is no data
    </p>
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
