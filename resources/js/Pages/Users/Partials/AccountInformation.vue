<template>
  <!-- 1. Personal Information -->
  <div class="p-8 rounded-lg bg-white border border-gray-200 mb-8">
    <!-- Panel Title -->
    <h4 class="font-semibold text-lg capitalize">
      {{ user.role }} Personal Information
    </h4>
    <div class="w-full h-px bg-gray-200 my-4"></div>
    <div class="w-full">
      <div class="flex items-start justify-between">
        <div class="space-y-8">
          <div>
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
              Name
            </label>
            <div>
              {{ user.name }}
            </div>
          </div>

          <div>
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
              Email
            </label>
            <div>
              {{ user.email }}
            </div>
          </div>

          <div>
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
              Phone
            </label>
            <div>
              {{ user.phone }}
            </div>
          </div>
        </div>

        <div class="space-y-8">
          <div>
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
              Occupation
            </label>
            <div>
              {{ user.name }}
            </div>
          </div>
        </div>

        <!-- action -->
        <div>
          <div class="font-semibold text-primaryAlt cursor-pointer">Update</div>
        </div>
      </div>
    </div>
  </div>

  <!-- 2. Next of kin info -->
  <div v-if="user.role == 'tenant'" class="p-8 rounded-lg bg-white border border-gray-200">
    <!-- Panel Title -->
    <div class="flex items-center justify-between">
      <div class="font-semibold text-lg capitalize">
        {{ user.role }} Next of kin information
      </div>
      <!-- action -->
      <div class="font-semibold text-primaryAlt cursor-pointer">Update</div>
    </div>
    <div class="w-full h-px bg-gray-200 my-4"></div>
    <div class="w-full my-4" v-for="(item, index) in [1, 2, 3]" :key="index">
      <div class="flex justify-between items-start">
        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Name
          </label>
          <div>Lindah Malea</div>
        </div>

        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Contact
          </label>
          <div>0790559860/testing@gmail.com</div>
        </div>

        <div>
          <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
            Relation
          </label>
          <div>Parent/Wife/Child</div>
        </div>
      </div>
      <div class="w-full h-px bg-gray-200 my-4"></div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  user: Object
})
</script>
