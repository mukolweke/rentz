<script setup>
import TenantLayout from '../../Layouts/TenantLayout.vue'
import PanelView from '../../Components/Panel.vue';

defineProps({
  user: Object
})

</script>

<template>
  <tenant-layout :user="user">
    <div>
        <panel-view>
            
        </panel-view>
    </div>
  </tenant-layout>
</template>
