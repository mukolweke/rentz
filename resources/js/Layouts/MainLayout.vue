<template>
  <div class="m-0 p-0 bg-[#f8fafc] min-h-screen">
    <!-- Top Navigation -->
    <div class="h-[70px] shadow-sm bg-white fixed w-full">
      <div
        class="max-w-[1200px] mx-4 xl:mx-auto h-full flex items-center justify-between"
      >
        <div class="font-bold text-[32px] leading-loose uppercase text-primary">
          RentZ
        </div>

        <div class="flex items-center space-x-4">
          <Link href="/logout" method="post" as="button">Logout</Link>
        </div>
      </div>
    </div>
    <!-- Main Section -->
    <div class="max-w-[1200px] mx-auto flex py-4 h-full]">
      <!-- Left Side: Navigation -->
      <div
        class="hidden w-[200px] h-full rounded-lg lg:flex flex-col justify-between fixed mt-[70px]"
      >
        <div>
          <ul>
            <li
              v-for="(item, index) in routes"
              :key="item.routeName"
              class="cursor-pointer hover:text-primary transition-all"
              :class="{
                'rounded-t-lg': index === 0,
                'font-light': !$page.url.includes(item.label),
                'font-bold text-primary': $page.url.includes(item.label),
              }"
            >
              <!-- fa-bounce -->
              <Link
                preserve-scroll
                :href="route(item.routeName)"
                class="flex items-center space-x-4 w-full h-full p-4 px-6 text-lg"
              >
                <span class="w-5">
                  <i :class="'fas ' + item.icon" aria-hidden="true"></i>
                </span>
                <span class="w-full">{{ item.name }}</span>
              </Link>
            </li>
          </ul>
        </div>

        <div></div>
      </div>

      <!-- Right Side: Main Body -->
      <div class="w-full lg:w-[85%] h-full lg:ml-[250px] mt-[70px]">
        <slot />
      </div>
    </div>

    <!-- Footer -->
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3'

let routes = ref(
  usePage().props.auth.user.role == 'tenant'
    ? [
      {
        name: 'Dashboard',
        routeName: 'dashboard',
        label: 'dashboard',
        icon: 'fa-gauge',
      },
      {
        name: 'Profile',
        routeName: 'profile',
        label: 'profile',
        icon: 'fa-user',
      },
      {
        name: 'Unit',
        routeName: 'unit',
        label: 'unit',
        icon: 'fa-user',
      },
      {
        name: 'Payment',
        routeName: 'payment',
        label: 'payment',
        icon: 'fa-user',
      }
    ]
    : [
      {
        name: 'Dashboard',
        routeName: 'dashboard',
        label: 'dashboard',
        icon: 'fa-gauge',
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
        name: 'Users',
        routeName: 'users.index',
        label: 'users',
        icon: 'fa-users',
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
