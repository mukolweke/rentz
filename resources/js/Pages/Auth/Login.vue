<template>
  <div class="login-bg grid place-content-center min-h-screen">
    <div
      class="p-8 rounded-lg shadow-md border border-gray-300 min-w-[500px] bg-white"
    >
      <h1 class="font-medium text-2xl mb-4">Welcome Back</h1>
      <p class="mb-8 text-sm font-medium opacity-60">
        Start your journey by login in
        <!-- Gmail & Apple login -->
      </p>

      <div class="space-y-4">
        <div
          class="p-2.5 flex items-center cursor-pointer justify-center space-x-2 shadow-sm hover:shadow-lg rounded w-full text-center font-medium border hover:border-[#19355e]"
        >
          <span class="w-5 h-5">
            <svg
              viewBox="-3 0 262 262"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              preserveAspectRatio="xMidYMid"
              fill="#000000"
            >
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g
                id="SVGRepo_tracerCarrier"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></g>
              <g id="SVGRepo_iconCarrier">
                <g>
                  <path
                    d="M255.878,133.451 C255.878,122.717 255.007,114.884 253.122,106.761 L130.55,106.761 L130.55,155.209 L202.497,155.209 C201.047,167.249 193.214,185.381 175.807,197.565 L175.563,199.187 L214.318,229.21 L217.003,229.478 C241.662,206.704 255.878,173.196 255.878,133.451"
                    fill="#4285F4"
                  ></path>
                  <path
                    d="M130.55,261.1 C165.798,261.1 195.389,249.495 217.003,229.478 L175.807,197.565 C164.783,205.253 149.987,210.62 130.55,210.62 C96.027,210.62 66.726,187.847 56.281,156.37 L54.75,156.5 L14.452,187.687 L13.925,189.152 C35.393,231.798 79.49,261.1 130.55,261.1"
                    fill="#34A853"
                  ></path>
                  <path
                    d="M56.281,156.37 C53.525,148.247 51.93,139.543 51.93,130.55 C51.93,121.556 53.525,112.853 56.136,104.73 L56.063,103 L15.26,71.312 L13.925,71.947 C5.077,89.644 0,109.517 0,130.55 C0,151.583 5.077,171.455 13.925,189.152 L56.281,156.37"
                    fill="#FBBC05"
                  ></path>
                  <path
                    d="M130.55,50.479 C155.064,50.479 171.6,61.068 181.029,69.917 L217.873,33.943 C195.245,12.91 165.798,0 130.55,0 C79.49,0 35.393,29.301 13.925,71.947 L56.136,104.73 C66.726,73.253 96.027,50.479 130.55,50.479"
                    fill="#EB4335"
                  ></path>
                </g>
              </g>
            </svg>
          </span>
          <span class="h-full">Sign in with Google</span>
        </div>

        <div
          class="p-2.5 flex items-center cursor-pointer justify-center space-x-2 shadow-sm hover:shadow-lg bg-[#19355e] rounded w-full text-center text-white font-medium"
        >
          <span class="w-5 h-5">
            <svg
              viewBox="-1.5 0 20 20"
              version="1.1"
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              fill="#000000"
            >
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g
                id="SVGRepo_tracerCarrier"
                stroke-linecap="round"
                stroke-linejoin="round"
              ></g>
              <g id="SVGRepo_iconCarrier">
                <title>apple [#ffffff]</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g
                  id="Page-1"
                  stroke="none"
                  stroke-width="1"
                  fill="none"
                  fill-rule="evenodd"
                >
                  <g
                    id="Dribbble-Light-Preview"
                    transform="translate(-102.000000, -7439.000000)"
                    fill="#ffffff"
                  >
                    <g id="icons" transform="translate(56.000000, 160.000000)">
                      <path
                        d="M57.5708873,7282.19296 C58.2999598,7281.34797 58.7914012,7280.17098 58.6569121,7279 C57.6062792,7279.04 56.3352055,7279.67099 55.5818643,7280.51498 C54.905374,7281.26397 54.3148354,7282.46095 54.4735932,7283.60894 C55.6455696,7283.69593 56.8418148,7283.03894 57.5708873,7282.19296 M60.1989864,7289.62485 C60.2283111,7292.65181 62.9696641,7293.65879 63,7293.67179 C62.9777537,7293.74279 62.562152,7295.10677 61.5560117,7296.51675 C60.6853718,7297.73474 59.7823735,7298.94772 58.3596204,7298.97372 C56.9621472,7298.99872 56.5121648,7298.17973 54.9134635,7298.17973 C53.3157735,7298.17973 52.8162425,7298.94772 51.4935978,7298.99872 C50.1203933,7299.04772 49.0738052,7297.68074 48.197098,7296.46676 C46.4032359,7293.98379 45.0330649,7289.44985 46.8734421,7286.3899 C47.7875635,7284.87092 49.4206455,7283.90793 51.1942837,7283.88393 C52.5422083,7283.85893 53.8153044,7284.75292 54.6394294,7284.75292 C55.4635543,7284.75292 57.0106846,7283.67793 58.6366882,7283.83593 C59.3172232,7283.86293 61.2283842,7284.09893 62.4549652,7285.8199 C62.355868,7285.8789 60.1747177,7287.09489 60.1989864,7289.62485"
                        id="apple-[#ffffff]"
                      ></path>
                    </g>
                  </g>
                </g>
              </g>
            </svg>
          </span>
          <span class="h-full">Sign in with Apple</span>
        </div>
      </div>

      <div class="w-full flex items-center space-x-4 my-8">
        <div class="w-full h-px bg-gray-200"></div>
        <div class="text-xs opacity-60 font-medium">or</div>
        <div class="w-full h-px bg-gray-200"></div>
      </div>

      <!-- Email Input -->
      <div class="mb-4">
        <label for="email" class="font-medium text-xs">Email </label>
        <div class="relative">
          <div
            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
          >
            <span class="w-5 h-5">
              <i class="fa-regular fa-envelope"></i>
            </span>
          </div>
          <input
            v-model="loginForm.email"
            type="text"
            id="email"
            class="border border-gray-300 text-sm rounded focus:outline-primary block w-full pl-10 p-3.5"
            placeholder="name@flowbite.com"
          />
        </div>
        <span
          v-if="loginForm.errors.email"
          class="text-[10px] text-red-500 font-medium"
        >
          {{ loginForm.errors.email }}
        </span>
      </div>

      <!-- Password Input -->
      <div class="mb-6">
        <label for="password" class="font-medium text-xs">Password </label>
        <div class="relative">
          <div
            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
          >
            <span class="w-5 h-5">
              <i class="fa fa-lock"></i>
            </span>
          </div>
          <input
            :type="showPassword ? 'text' : 'password'"
            v-model="loginForm.password"
            id="password"
            class="border border-gray-300 text-sm rounded focus:outline-primary block w-full px-10 p-3.5"
            placeholder="**************"
          />
          <div
            class="absolute z-50 cursor-pointer inset-y-0 right-0 flex items-center pr-3"
          >
            <span class="w-5 h-5" @click="showPassword = !showPassword">
              <span v-if="!showPassword">
                <i class="fa-regular fa-eye"></i>
              </span>
              <span v-else><i class="fa-regular fa-eye-slash"></i></span>
            </span>
          </div>
        </div>
        <span
          v-if="loginForm.errors.password"
          class="text-[10px] text-red-500 font-medium"
        >
          {{ loginForm.errors.password }}
        </span>
      </div>

      <!-- Submit Button -->
      <button
        @click="submitLogin"
        class="p-2.5 z-50 shadow-sm hover:shadow-lg bg-primary rounded w-full text-center text-white font-medium uppercase"
      >
        Login
      </button>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

let showPassword = ref(false);

const loginForm = useForm({
  email: '',
  password: ''
});

let submittingForm = ref(false);

const submitLogin = () => {
  submittingForm = true;

  loginForm.post('/login', {
    preserveScroll: true,
    onSuccess: () => {
      submittingForm.value = false;
      loginForm.reset();
    },
  });
}
</script>

<style>
.login-bg {
  background-image: linear-gradient(to bottom, rgb(255, 255, 255), #19355e),
    url("/images/bg-1.jpg");
  background-size: cover;
  background-blend-mode: multiply;
  background-repeat: no-repeat;
}
</style>
