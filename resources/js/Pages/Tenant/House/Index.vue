<script setup>
import TenantLayout from '../../../Layouts/TenantLayout.vue';
import BreadCrumps from '../../../Components/BreadCrumps.vue';
import PanelView from '../../../Components/Panel.vue';
import TableView from '../../../Components/Table.vue';
import Accordion from '../../../Components/Accordion.vue';

defineProps({
  user: Object,
  house: Object,
  unit: Object,
  staffs: Array,
  neighbours: Array,
})

</script>

<template>
  <tenant-layout :user="user">
    <bread-crumps
      class="mb-8"
      :options="[
        { href: `house/${house.id}/view-details`, label: 'House Details' },
      ]"
    />

    <div>
      <!-- Building Details Section -->
      <accordion title="Building Details" class="mb-8">
        <!-- Heading -->
        <h4
          class="tracking-normal uppercase text-sm font-semibold border-b pb-2 border-primaryAltLight"
        >
          Details
        </h4>

        <!-- Content -->
        <div aria-describedby="House Details Table" class="mt-4">
          <div class="grid grid-cols-3 gap-8">
            <div>
              <label
                class="block mb-2 uppercase font-bold text-xs text-gray-700"
              >
                House Name
              </label>
              <div>{{ house.name }}</div>
            </div>

            <div>
              <label
                class="block mb-2 uppercase font-bold text-xs text-gray-700"
              >
                House Location
              </label>
              <div>{{ house.location }}</div>
            </div>

            <div>
              <label
                class="block mb-2 uppercase font-bold text-xs text-gray-700"
              >
                House Type
              </label>
              <div>{{ house.category }}</div>
            </div>
          </div>
        </div>
      </accordion>

      <!-- Tenant Unit Details Section -->
      <accordion class="mb-8" title="Tenant Unit Details">
        <!-- Heading -->
        <h4
          class="tracking-normal uppercase text-sm font-semibold border-b pb-2 border-primaryAltLight"
        >
          Details
        </h4>

        <!-- Content -->
        <div aria-describedby="Tenant Unit Details Panel" class="mt-4">
          <div class="grid grid-cols-3 gap-8">
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
        </div>
      </accordion>

      <!-- Building Staff Details Section -->
      <accordion title="Building Staff Details" class="mb-8">
        <!-- Heading -->
        <h4
          class="tracking-normal uppercase text-sm font-semibold border-b pb-2 border-primaryAltLight"
        >
          Details
        </h4>

        <!-- Content -->
        <div aria-describedby="Building Staff Details" class="mt-4">
          <table-view
            class="h-full"
            :displayAction="false"
            :fields="['name', 'phone', 'role']"
            :datum="staffs"
          />
        </div>
      </accordion>

      <!-- Neighbours Details Section -->
      <accordion title="Neighbours Details" class="mb-8">
        <!-- Heading -->
        <h4
          class="tracking-normal uppercase text-sm font-semibold border-b pb-2 border-primaryAltLight"
        >
          Details
        </h4>

        <!-- Content -->
        <div aria-describedby="Building Staff Details" class="mt-4">
          <table-view
            class="h-full"
            :displayAction="false"
            :fields="['name', 'phone', 'unit']"
            :datum="neighbours"
          />
        </div>
      </accordion>
    </div>
  </tenant-layout>
</template>
