<script setup>
import { ref, watch } from 'vue';
import PanelView from '../Components/Panel.vue';
import Icon from '../Components/Icon.vue'
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  user: Object,
  editing: Boolean
});

let showHeaderEdit = ref(false);
let showAvatarEdit = ref(false);

const fileInput = ref(null);
const uploadType = ref('');

function browseFile(type) {
  fileInput.value.click();
  uploadType.value = type
}

const fileForm = useForm({
  header: null,
  avatar: null,
});

const avatarSrc = ref(props.user.avatar);
const headerSrc = ref(props.user.header);

function fileInputChange(e) {
  if (uploadType.value == 'avatar') {
    fileForm.avatar = e.target.files[0];

    let reader = new FileReader();
    reader.readAsDataURL(fileForm.avatar);
    reader.onload = (e) => {
      avatarSrc.value = e.target.result;

      // save file;
      fileForm.post('/tenant/' + props.user.id + '/update-avatar', {
        preserveScroll: true,
      });
    }
  }

  if (uploadType.value == 'header') {
    fileForm.header = e.target.files[0]

    let reader = new FileReader();
    reader.readAsDataURL(fileForm.header);
    reader.onload = (e) => {
      headerSrc.value = e.target.result;

      // save file;
      fileForm.post('/tenant/' + props.user.id + '/update-header', {
        preserveScroll: true,
      });
    }
  }
}
</script>

<style scoped>
.bg-header {
  background-color: #a8e6ff;
  background-position: center center;
  background-size: cover;
}
</style>

<template>
  <div class="m-0 p-0 bg-[#f8fafc] min-h-screen">
    <div class="">
      <input
        type="file"
        accept="image/*"
        class="hidden"
        ref="fileInput"
        @change="fileInputChange"
      />
      <!-- Header -->
      <header class="h-[192px] flex items-center justify-center select-none">
        <div
          class="bg-header h-[192px] w-full relative cursor-pointer transition duration-200"
          :style="`background-image: url('${headerSrc}');text-align:center;`"
          @mouseenter="showHeaderEdit = true"
          @mouseleave="showHeaderEdit = false"
        >
          <div
            v-if="showHeaderEdit"
            class="absolute inset-0 bg-black/10"
            @click="() => browseFile('header')"
          >
            <div class="flex items-center justify-center h-full">
              <div class="text-white flex flex-col items-center justify-center">
                <Icon name="image" fill="#ffffff" class="h-6 w-6" />
                <p class="font-medium mt-2">Update your header image</p>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- Content -->
      <section
        class="max-w-[1000px] w-full mx-auto flex justify-center flex-row"
      >
        <aside class="p-5 min-w-[240px] basis-[320px] select-none">
          <!-- Profile -->
          <div class="-mt-[90px] z-50 inline-block relative">
            <!-- Avatar -->
            <div
              class="w-[150px] h-[150px] bg-primaryAlt rounded-full border-4 border-white relative"
              @mouseenter="showAvatarEdit = true"
              @mouseleave="showAvatarEdit = false"
            >
              <div class="w-full h-full">
                <!-- avatar -->
                <img
                  v-if="avatarSrc"
                  class="h-full w-full object-cover rounded-full"
                  :src="avatarSrc"
                  :alt="user.name"
                />

                <!-- Name initials -->
                <div
                  v-else
                  class="h-full w-full absolute inset-0 flex items-center justify-center z-0"
                >
                  <p class="text-white text-5xl">
                    {{ user.name.match(/\b(\w)/g).join("") }}
                  </p>
                </div>
                <!-- Hover upload avatar -->
                <div
                  v-if="showAvatarEdit"
                  class="absolute inset-0 bg-black/10 rounded-full"
                >
                  <div class="flex items-center justify-center h-full">
                    <div
                      @click="() => browseFile('avatar')"
                      class="cursor-pointer text-white flex flex-col items-center justify-center"
                    >
                      <Icon name="camera" fill="#ffffff" class="h-6 w-6" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-5">
              <h1 class="font-bold break-all tracking-wide text-2xl">
                {{ user.name }}
              </h1>
            </div>
          </div>

          <div
            v-if="$page.props.auth.user.hasDefaultPassword"
            class="text-yellow-500 font-bold text-xs rounded mt-5 motion-safe:animate-bounce"
          >
            Please update your password
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
            <Link
              v-if="!editing"
              href="/tenant/dashboard/edit"
              method="get"
              as="button"
              class="mb-4 bg-slate-100 p-2 w-full text-center font-medium hover:bg-slate-200 transition duration-200 rounded-md cursor-pointer uppercase text-sm"
            >
              Manage your account
            </Link>

            <Link
              href="/logout"
              method="post"
              as="button"
              class="p-2 w-full text-center text-primaryAlt hover:text-white hover:bg-primaryAlt transition duration-200 font-medium rounded-md cursor-pointer uppercase text-sm"
            >
              <span class="mr-2">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
              </span>
              Sign out
            </Link>
          </div>
        </aside>

        <main class="p-5 py-8 min-w-[240px] basis-[640px]">
          <slot />
        </main>
      </section>
    </div>
  </div>
</template>
