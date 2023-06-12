<script setup>
import TenantLayout from '../../Layouts/TenantLayout.vue'
import PanelView from '../../Components/Panel.vue';
import ManageNextOfKin from '../Users/Partials/ManageNextOfKin.vue';
import { computed } from 'vue';

const props = defineProps({
  user: Object,
  unit: Object,
  nextOfKins: Array,
})

const computedKins = computed(() => props.nextOfKins);

</script>

<template>
  <tenant-layout :user="user">
    <!-- Unit Details -->
    <div class="mb-10">
      <h2 class="tracking-wide text-lg mb-4">Unit Details</h2>

      <panel-view>
        <div class="grid grid-cols-3 gap-8">
          <div>
            <label
              class="block mb-2 tracking-wide uppercase text-xs font-semibold"
            >
              House Name
            </label>
            <div>{{ unit.house }}</div>
          </div>

          <div>
            <label
              class="block mb-2 tracking-wide uppercase text-xs font-semibold"
            >
              Unit Name
            </label>
            <div>{{ unit.name }}</div>
          </div>

          <div>
            <label
              class="block mb-2 tracking-wide uppercase text-xs font-semibold"
            >
              Unit Block
            </label>
            <div>{{ unit.block }}</div>
          </div>

          <div v-if="unit.parking">
            <label
              class="block mb-2 tracking-wide uppercase text-xs font-semibold"
            >
              Parking Spot
            </label>
            <div>{{ unit.parking }}</div>
          </div>

          <div>
            <label
              class="block mb-2 tracking-wide uppercase text-xs font-semibold"
            >
              Joined Date
            </label>
            <div>{{ unit.tenant_joined_on }}</div>
          </div>

          <div v-if="unit.tenant_removed_on">
            <label
              class="block mb-2 tracking-wide uppercase text-xs font-semibold"
            >
              Removed Date
            </label>
            <div>{{ unit.tenant_removed_on }}</div>
          </div>
        </div>
      </panel-view>
    </div>

    <!-- Next Of Kin -->
    <div>
      <div class="flex items-center justify-between mb-4">
        <h2 class="tracking-wide text-lg">Next Of Kin</h2>

        <ManageNextOfKin :user-id="user.id" :next-of-kins="computedKins" />
      </div>

      <panel-view>
        <div class="">
          <div class="flex items-center justify-around mb-2 w-full">
            <label
              class="flex-1 block uppercase font-bold text-xs text-gray-700"
            >
              Name
            </label>
            <label
              class="flex-1 block uppercase font-bold text-xs text-gray-700"
            >
              Email
            </label>
            <label
              class="flex-1 block uppercase font-bold text-xs text-gray-700"
            >
              Phone
            </label>
            <label
              class="flex-1 block uppercase font-bold text-xs text-gray-700"
            >
              Relation
            </label>
          </div>
          <div class="w-full h-px bg-gray-200 my-4"></div>
          <div
            class="w-full my-4"
            v-for="(kin, index) in computedKins"
            :key="index"
          >
            <div class="flex items-center justify-around text-sm">
              <div class="flex-1 mr-1">{{ kin.name }}</div>

              <div class="flex-1 mr-2">{{ kin.email }}</div>

              <div class="flex-1 mr-1">{{ kin.phone }}</div>

              <div class="flex-1 mr-1">{{ kin.relation }}</div>
            </div>
            <div class="w-full h-px bg-gray-200 my-4"></div>
          </div>

          <div class="text-center" v-if="computedKins.length == 0">
            <p class="font-medium opacity-30 my-10">No next of kin provided.</p>
            <div class="w-full h-px bg-gray-200 my-4"></div>
          </div>
        </div>
      </panel-view>
    </div>
  </tenant-layout>
</template>
