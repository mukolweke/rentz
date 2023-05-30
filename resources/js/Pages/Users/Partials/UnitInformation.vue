<template>
  <!-- User Unit Details -->
  <div class="p-8 rounded-lg bg-white border border-gray-200">
    <!-- Panel Title -->
    <div class="flex items-center justify-between">
      <h4 class="font-semibold text-lg capitalize">Tenant unit details</h4>
      <!-- Remove Tenant action -->
      <p
        v-if="!unit.tenant_removed_on"
        @click="removeTenant"
        class="font-semibold text-red-500 cursor-pointer"
      >
        Remove Tenant
      </p>
    </div>
    <div class="w-full h-px bg-gray-200 my-4"></div>
    <div class="w-full my-4">
      <div class="grid grid-cols-3 gap-8">
        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            House Name
          </label>
          <div>{{ unit.house }}</div>
        </div>

        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Unit Name
          </label>
          <div>{{ unit.name }}</div>
        </div>

        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Unit Block
          </label>
          <div>{{ unit.block }}</div>
        </div>

        <div v-if="unit.parking">
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Parking Spot
          </label>
          <div>{{ unit.parking }}</div>
        </div>

        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Joined Date
          </label>
          <div>{{ unit.tenant_joined_on }}</div>
        </div>

        <div v-if="unit.tenant_removed_on">
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Removed Date
          </label>
          <div>{{ unit.tenant_removed_on }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios';

const props = defineProps({
  unit: Object
});

let removeTenant = async () => {
  let unitId = props.unit.id;
  let tenantId = props.unit.tenant_id;

  await axios.get(`/units/${unitId}/tenant/${tenantId}/remove`);

  location.reload()
}
</script>
