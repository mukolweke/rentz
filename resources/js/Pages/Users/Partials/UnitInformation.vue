<template>
  <!-- User Unit Details -->
  <div class="p-8 rounded-lg bg-white border border-gray-200">
    <!-- Panel Title -->
    <div class="flex items-center justify-between">
      <h4 class="font-semibold text-lg capitalize">Tenant unit details</h4>
      <!-- action -->
      <p class="font-semibold text-red-500 cursor-pointer">Deactivate</p>
    </div>
    <div class="w-full h-px bg-gray-200 my-4"></div>
    <div class="w-full my-4">
      <div class="grid grid-cols-3 gap-[32px]">
        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            House Name
          </label>
          <div>Starlight Homes</div>
        </div>

        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Unit Name
          </label>
          <div>A14</div>
        </div>

        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Parking Spot
          </label>
          <div>LOT B2</div>
        </div>

        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Joined Date
          </label>
          <div>4th June 2022</div>
        </div>

        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Removed Date
          </label>
          <div>20th December 2050</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>
