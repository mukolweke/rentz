<template>
  <MainLayout>
    <div class="mb-4">
      <div class="flex items-center justify-between py-4">
        <p class="font-normal text-2xl antialiased capitalize">Unit Details</p>

        <div class="flex items-center space-x-4">
          <Link
            :href="route('units.edit', unit.id)"
            class="p-2 px-4 bg-blue-500 rounded text-white"
          >
            <span><i class="fa fa-edit"></i></span>
          </Link>
          <Modal
            v-if="!tenant"
            deleteModal
            :submitSuccess="isSubmitSuccess"
            @confirm="deleteUnit"
          >
            <template v-slot:toggleBtn="{ onClick }">
              <Button label="delete" danger @click="onClick" />
            </template>

            <template v-slot:body>
              <div class="w-[400px]">
                <div class="w-full space-y-4">
                  <div class="flex items-center justify-center mb-8">
                    <div
                      class="border-2 border-red-500 rounded-full w-[100px] h-[100px] flex items-center justify-center"
                    >
                      <span class="text-4xl text-red-500"
                        ><i class="fa fa-xmark"></i
                      ></span>
                    </div>
                  </div>

                  <p class="text-center">
                    Do you really want to delete this records? This process
                    cannot be undone.
                  </p>
                </div>
              </div>
            </template>
          </Modal>
        </div>
      </div>
    </div>
    <div class="py-4 shadow-lg rounded-lg bg-white">
      <!-- Page Content -->
      <div class="mt-8 px-8">
        <div class="w-full max-w-xl">
          <div aria-describedby="Unit Details Table">
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">Id</div>
              <div class="w-full">{{ unit.id }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">Name</div>
              <div class="w-full">{{ unit.name }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Block
              </div>
              <div class="w-full">{{ unit.block }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Description
              </div>
              <div class="w-full">{{ unit.description }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                House
              </div>
              <div class="w-full">
                <Link
                  :href="route('houses.show', unit.house_id)"
                  class="font-bold text-primaryAlt"
                >
                  {{ unit.house }}
                </Link>
              </div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Created
              </div>
              <div class="w-full">{{ unit.created_on }}</div>
            </div>
            <div class="flex items-center mb-4">
              <div class="w-1/3 capitalize font-medium text-gray-400">
                Updated
              </div>
              <div class="w-full">{{ unit.updated_on }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Current Tenant Details -->
    <div class="mt-8">
      <div class="flex items-center justify-between">
        <p class="text-lg">Current Tenant</p>

        <Button
          v-if="tenant"
          label="Remove Tenant"
          danger
          @click="removeTenant"
        />
        <Link
          v-else
          :href="route('tenants.create', { unit: unit.id })"
          class="p-2 px-4 bg-primary rounded text-white"
        >
          Add Tenant
        </Link>
      </div>

      <div class="bg-white p-8 shadow-lg mt-4">
        <!-- If Assigned -->
        <div v-if="tenant">
          <div class="flex items-start">
            <div class="w-1/2 space-y-4">
              <p>
                <span class="font-bold mr-4"> Name: </span>{{ tenant["name"] }}
              </p>

              <p>
                <span class="font-bold mr-4">Email: </span>{{ tenant["email"] }}
              </p>

              <p>
                <span class="font-bold mr-4">Phone: </span>{{ tenant["phone"] }}
              </p>

              <p>
                <span class="font-bold mr-4">Joined: </span>
                {{ tenant["created_on"] }}
              </p>
            </div>

            <div class="w-1/2 space-y-4">
              <p><span class="font-bold mr-4">Reference: </span>N/A</p>

              <p><span class="font-bold mr-4">Next of Kin: </span>N/A</p>

              <p><span class="font-bold mr-4">Parking Spot:</span> N/A</p>
            </div>
          </div>

          <div class="mt-4">
            <Link
              :href="route('tenants.show', tenant['id'])"
              class="font-bold text-sm text-green-500 cursor-pointer"
            >
              View Profile <span><i class="fa fa-link"></i></span>
            </Link>
          </div>
        </div>

        <!-- If not assigned -->
        <div v-else class="text-primary font-bold text-lg">Unit Available</div>
      </div>
    </div>

    <!-- Units Actions -->
    <div class="mt-8">
      <p class="text-lg mb-4">Units Actions</p>
      <div class="flex items-center space-x-4">
        <div
          class="font-medium cursor-pointer"
          :class="{
            'border-b-2 border-primary':
              isActiveUnitActionTab('tenant-history'),
            'text-gray-400 hover:text-primary':
              !isActiveUnitActionTab('tenant-history'),
          }"
          @click="activeUnitActionTab = 'tenant-history'"
        >
          Tenants History
        </div>

        <div
          class="font-medium cursor-pointer"
          :class="{
            'border-b-2 border-primary':
              isActiveUnitActionTab('repair-history'),
            'text-gray-400 hover:text-primary':
              !isActiveUnitActionTab('repair-history'),
          }"
          @click="activeUnitActionTab = 'repair-history'"
        >
          Repair History
        </div>
      </div>
    </div>

    <div class="mt-8 bg-white shadow-lg w-full p-8">
      <div v-if="isActiveUnitActionTab('tenant-history')">
        <p v-if="prevTenants.total > 0" class="font-medium">Previous Tenants</p>

        <div class="mt-4" v-if="prevTenants.total > 0">
          <TableView
            class="h-full"
            :displayAction="false"
            :fields="['id', 'name', 'email', 'phone', 'removed_on']"
            :datum="prevTenants"
          />
        </div>

        <div v-else class="text-primary font-medium text-lg">
          No tenants history available
        </div>
      </div>

      <div v-if="isActiveUnitActionTab('repair-history')">
        <p>Repair History</p>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import Button from '../../Components/Button.vue';
import { useForm } from '@inertiajs/vue3'
import TableView from '../../Components/Table.vue';

let props = defineProps({
  unit: Object,
  tenant: Array | null,
  prevTenants: Array,
})

const unitForm = useForm(props.unit);

let isSubmitSuccess = ref(false);

let deleteUnit = () => {
  isSubmitSuccess.value = false;
  unitForm.delete('/units/' + unitForm.id, {
    preserveScroll: true,
    onSuccess: () => {
      isSubmitSuccess.value = true;
    },
  });
}

const revokeForm = useForm({
  unitId: props.unit.id,
  tenantId: props.tenant ? props.tenant.id : null,
})

let removeTenant = () => {
  revokeForm.get(`/units/${revokeForm.unitId}/tenant/${revokeForm.tenantId}/remove`, {
    preserveScroll: true,
  })
}

let activeUnitActionTab = ref('tenant-history');

let isActiveUnitActionTab = (tabName) => {
  return activeUnitActionTab.value == tabName
}
</script>
