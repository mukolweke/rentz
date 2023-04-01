<template>
  <div class="mt-16">
    <div class="flex items-center justify-between">
      <p class="text-lg">List of house Units</p>

      <div>
        <Modal
          btnLabel="Add a unit"
          :submitSuccess="isSubmitSuccess"
          @confirm="deleteCategory"
        >
          <template v-slot:header> Add a unit </template>
          <template v-slot:body>
            <div class="w-[400px]">The unit form</div>
          </template>
        </Modal>
      </div>
    </div>

    <div class="mt-8 py-4 shadow-lg rounded-lg bg-white min-h-[500px]">

    </div>
  </div>
</template>

<script setup>

</script>

