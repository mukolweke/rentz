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

        <div class="space-y-8" v-if="user.role == 'tenant' && user.occupation">
          <div>
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700">
              Occupation
            </label>
            <div>
              {{ user.occupation }}
            </div>
          </div>
        </div>

        <!-- action -->
        <div>
          <EditUser :user="user" />
        </div>
      </div>
    </div>
  </div>

  <!-- 2. Next of kin info -->
  <div
    v-if="user.role == 'tenant'"
    class="p-8 rounded-lg bg-white border border-gray-200"
  >
    <!-- Panel Title -->
    <div class="flex items-center justify-between">
      <div class="font-semibold text-lg capitalize">
        {{ user.role }} Next of kin information
      </div>
      <!-- action -->
      <ManageNextOfKin :user-id="user.id" :next-of-kins="computedKins" />
    </div>
    <div class="w-full h-px bg-gray-200 my-4"></div>

    <div class="flex items-center justify-around mb-2 w-full">
      <label class="flex-1 block uppercase font-bold text-xs text-gray-700">
        Name
      </label>
      <label class="flex-1 block uppercase font-bold text-xs text-gray-700">
        Email
      </label>
      <label class="flex-1 block uppercase font-bold text-xs text-gray-700">
        Phone
      </label>
      <label class="flex-1 block uppercase font-bold text-xs text-gray-700">
        Relation
      </label>
    </div>
    <div class="w-full my-4" v-for="(kin, index) in computedKins" :key="index">
      <div class="flex items-center justify-around">
        <div class="flex-1 mr-1">{{ kin.name }}</div>

        <div class="flex-1 mr-2">{{ kin.email }}</div>

        <div class="flex-1 mr-1">{{ kin.phone }}</div>

        <div class="flex-1 mr-1">{{ kin.relation }}</div>
      </div>
      <div class="w-full h-px bg-gray-200 my-4"></div>
    </div>

    <div class="text-center" v-if="computedKins.length == 0">
      <p class="text-lg font-medium opacity-30 my-10">
        No next of kin attached
      </p>
      <div class="w-full h-px bg-gray-200 my-4"></div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import EditUser from './EditUser.vue';
import ManageNextOfKin from './ManageNextOfKin.vue';

const props = defineProps({
  user: Object,
  nextOfKins: Array,
});

const computedKins = computed(() => props.nextOfKins);
</script>
