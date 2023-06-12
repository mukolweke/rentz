<script setup>
import PanelView from '../Components/Panel.vue';

defineProps({
  user: Object
})
</script>

<template>
  <div class="m-0 p-0 bg-[#f8fafc] min-h-screen">
    <div class="">
      <!-- Header -->
      <header class="h-[192px] flex items-center justify-center select-none">
        <div class="bg-primaryAltLight h-[192px] w-full">
          <!-- bg-[#F4F5F7] -->
        </div>
      </header>

      <!-- Content -->
      <section
        class="max-w-[1000px] w-full mx-auto flex justify-center flex-row"
      >
        <aside class="p-5 min-w-[240px] basis-[320px] select-none">
          <!-- Profile -->
          <div class="-mt-[90px] z-50 inline-block">
            <!-- Avatar -->
            <div
              class="w-[150px] h-[150px] bg-primaryAlt rounded-full border-4 border-white"
            >
              <div class="w-full h-full flex items-center justify-center">
                <img
                  v-if="user.avatar"
                  class="h-full w-full object-cover rounded-full"
                  :src="user.avatar"
                  :alt="user.name"
                />

                <p v-else class="text-white text-5xl">
                  {{ user.name.match(/\b(\w)/g).join("") }}
                </p>
              </div>
            </div>

            <div class="mt-5">
              <h1 class="font-bold break-all tracking-wide text-2xl">
                {{ user.name }}
              </h1>
            </div>
          </div>

          <!-- Profile Info -->
          <panel-view class="my-8">
            <div class="mb-10">
              <h2 class="tracking-normal uppercase text-sm font-semibold">
                About
              </h2>

              <div class="mt-4 space-y-4">
                <p class="text-sm tracking-wide">
                  <span class="mr-2"><i class="fa fa-briefcase"></i></span>
                  <span>{{ user.occupation ?? "Not Stated" }}</span>
                </p>

                <p class="text-sm tracking-wide">
                  <span class="mr-2"><i class="fa fa-location-pin"></i></span>
                  <span>Nairobi, KE</span>
                </p>
              </div>
            </div>

            <div>
              <h2 class="tracking-normal uppercase text-sm font-semibold">
                Contact
              </h2>

              <div class="mt-4 space-y-4">
                <p class="text-sm tracking-wide">
                  <span class="mr-2"><i class="fa fa-envelope"></i></span>
                  <span>{{ user.email }}</span>
                </p>

                <p class="text-sm tracking-wide">
                  <span class="mr-2"><i class="fa fa-phone"></i></span>
                  <span>{{ user.phone }}</span>
                </p>
              </div>
            </div>
          </panel-view>

          <!-- Actions -->
          <div>
            <div
              class="bg-slate-100 p-2 w-full text-center font-medium hover:bg-slate-200 transition duration-200 rounded-md cursor-pointer uppercase text-sm"
            >
              Manage your account
            </div>

            <div
              class="mt-4 p-2 w-full text-center text-primaryAlt hover:text-white hover:bg-primaryAlt transition duration-200 font-medium rounded-md cursor-pointer uppercase text-sm"
            >
              Log out
            </div>
          </div>
        </aside>

        <main class="p-5 py-8 min-w-[240px] basis-[640px]">
          <slot />
        </main>
      </section>
    </div>
  </div>
</template>
