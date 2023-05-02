<template>
  <MainLayout>
    <div class="mt-4">
      <p class="font-normal text-2xl antialiased">User Details</p>

      <!-- Tabs Header -->
      <div class="flex items-center justify-between my-6">
        <div class="flex items-center space-x-2">
          <div
            @click="updateActiveTab('account')"
            class="capitalize rounded font-medium p-2 px-4 cursor-pointer"
            :class="{
              'bg-primary text-white': activeTab == 'account',
              'bg-gray-100': activeTab != 'account',
            }"
          >
            Account Settings
          </div>
          <div
            v-if="user.role == 'tenant'"
            @click="updateActiveTab('unit')"
            class="capitalize rounded font-medium p-2 px-4 cursor-pointer"
            :class="{
              'bg-primary text-white': activeTab == 'unit',
              'bg-gray-100': activeTab != 'unit',
            }"
          >
            Unit Details
          </div>
          <div
            v-if="user.role == 'tenant'"
            @click="updateActiveTab('payment')"
            class="capitalize rounded font-medium p-2 px-4 cursor-pointer"
            :class="{
              'bg-primary text-white': activeTab == 'payment',
              'bg-gray-100': activeTab != 'payment',
            }"
          >
            Payments
          </div>
        </div>
      </div>
    </div>

    <!-- Tab Contents -->
    <div v-if="activeTab == 'account'">
      <AccountInformation :user="user" />
    </div>

    <div v-if="activeTab == 'unit'">
      <UnitInformation />
    </div>

    <div v-if="activeTab == 'payment'">
      <PaymentInformation />
    </div>
  </MainLayout>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
// import Button from '../../Components/Button.vue';
// import { useForm } from '@inertiajs/vue3'
import AccountInformation from './Partials/AccountInformation.vue';
import PaymentInformation from './Partials/PaymentInformation.vue';
import UnitInformation from './Partials/UnitInformation.vue';
import { router } from '@inertiajs/vue3';

let props = defineProps({
  user: Object
})

let activeTab = ref('account');

const updateActiveTab = async (tabName) => {
  activeTab.value = tabName;
  let currentUrl = router.page.url;
  let url = currentUrl.split('?tab=').pop()
    ? currentUrl.split('?tab=')[0] + '?tab=' + tabName
    : currentUrl + '?tab=' + tabName;

  window.history.pushState({}, '', url);
}

onMounted(() => {
  // Set Active Tab
  let currentUrl = router.page.url;
  let route = currentUrl.split('?tab=');

  if (route.length > 1) {
    activeTab.value = currentUrl.split('?tab=').pop();
  }
})

// const tenantForm = useForm(props.tenant);

// let isSubmitSuccess = ref(false);

// let deleteUnit = () => {
//   isSubmitSuccess.value = false;
//   tenantForm.delete('/units/' + tenantForm.id, {
//     preserveScroll: true,
//     onSuccess: () => {
//       isSubmitSuccess.value = true;
//     },
//   });
// }
</script>
