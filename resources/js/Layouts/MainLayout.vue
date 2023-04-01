<template>
  <div class="m-0 p-0 bg-[#f8fafc] min-h-screen">
    <!-- Top Navigation -->
    <div class="h-[70px] shadow-sm bg-white fixed w-full">
      <div
        class="max-w-[1200px] mx-auto h-full flex items-center justify-between"
      >
        <div class="font-bold text-[32px] leading-loose uppercase">RentZ</div>

        <div class="flex items-center space-x-4">
          <div>Profile</div>
        </div>
      </div>
    </div>
    <!-- Main Section -->
    <div class="max-w-[1200px] mx-auto flex py-4 h-full]">
      <!-- Left Side: Navigation -->
      <div class="w-[15%] h-full rounded-lg flex flex-col justify-between fixed mt-[70px]">
        <div>
          <ul>
            <li
              v-for="(item, index) in routes"
              :key="item.routeName"
              class="cursor-pointer hover:text-primaryGreen transition-all"
              :class="{
                'rounded-t-lg': index === 0,
                'font-semibold text-primaryGreen': $page.url.includes(
                  item.label
                ),
              }"
            >
              <!-- fa-bounce -->
              <Link
                preserve-scroll
                :href="route(item.routeName)"
                class="inline-block space-x-2 w-full h-full p-4 px-6"
              >
                <span>
                  <i :class="'fa ' + item.icon" aria-hidden="true"></i>
                </span>
                <span>{{ item.name }}</span>
              </Link>
            </li>
          </ul>
        </div>

        <div></div>
      </div>

      <!-- Right Side: Main Body -->
      <div class="w-[85%] h-full px-8 ml-[15%] mt-[70px]">
        <slot />
      </div>
    </div>

    <!-- Footer -->
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

let routes = ref([
  {
    name: 'Dashboard',
    routeName: 'dashboard',
    label: 'dashboard',
    icon: 'fa-home',
  },
  {
    name: 'House Types',
    routeName: 'category.index',
    label: 'category',
    icon: 'fa-list',
  },
  {
    name: 'Houses',
    routeName: 'houses.index',
    label: 'houses',
    icon: 'fa-list-alt',
    },
    {
    name: 'Units',
    routeName: 'units.index',
    label: 'units',
    icon: 'fa-building',
  },
  {
    name: 'Settings',
    routeName: 'settings',
    label: 'settings',
    icon: 'fa-cog',
  },
])

const getActiveRoute = computed(() => {
  return window.location.pathname;
});
</script>
