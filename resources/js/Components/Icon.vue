<script setup>
defineProps({
  name: String,
  width: {
    type: String,
    default: '24px'
  },
  height: {
    type: String,
    default: '24px'
  },
  fill: {
    type: String,
    default: '#ffffff'
  }
})
</script>

<template>
  <svg
    v-if="name == 'camera'"
    :fill="fill"
    :width="width"
    :height="height"
    viewBox="0 0 16 16"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      d="M15 3.5h-4l-.22-.65A1.24 1.24 0 0 0 9.6 2H6.4a1.24 1.24 0 0 0-1.18.85L5 3.5H1a1 1 0 0 0-1 1V13a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a1 1 0 0 0-1-1zm-.25 9.25H1.25v-8H5.9l.5-1.5h3.2l.5 1.5h4.65z"
    />
    <path
      d="M8 6a2.59 2.59 0 0 0-2.67 2.5A2.59 2.59 0 0 0 8 11a2.59 2.59 0 0 0 2.67-2.5A2.59 2.59 0 0 0 8 6zm0 3.75A1.35 1.35 0 0 1 6.58 8.5 1.35 1.35 0 0 1 8 7.25 1.35 1.35 0 0 1 9.42 8.5 1.35 1.35 0 0 1 8 9.75z"
    />
    <ellipse cx="12.84" cy="6.63" rx=".67" ry=".63" />
  </svg>

  <svg
    v-if="name == 'x'"
    :fill="fill"
    :width="width"
    :height="height"
    viewBox="0 0 24 24"
    xmlns="http://www.w3.org/2000/svg"
  >
    <g id="Menu / Close_MD">
      <path
        id="Vector"
        d="M18 18L12 12M12 12L6 6M12 12L18 6M12 12L6 18"
        :stroke="fill"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
    </g>
  </svg>

  <svg
    v-if="name == 'image'"
    :fill="fill"
    :width="width"
    :height="height"
    viewBox="0 0 32 32"
    version="1.1"
    xmlns="http://www.w3.org/2000/svg"
  >
    <title>image</title>
    <path
      d="M0 26.016q0 2.496 1.76 4.224t4.256 1.76h20q2.464 0 4.224-1.76t1.76-4.224v-20q0-2.496-1.76-4.256t-4.224-1.76h-20q-2.496 0-4.256 1.76t-1.76 4.256v20zM4 26.016v-20q0-0.832 0.576-1.408t1.44-0.608h20q0.8 0 1.408 0.608t0.576 1.408v20q0 0.832-0.576 1.408t-1.408 0.576h-20q-0.832 0-1.44-0.576t-0.576-1.408zM6.016 24q0 0.832 0.576 1.44t1.408 0.576h16q0.832 0 1.408-0.576t0.608-1.44v-0.928q-0.224-0.448-1.12-2.688t-1.6-3.584-1.28-2.112q-0.544-0.576-1.12-0.608t-1.152 0.384-1.152 1.12-1.184 1.568-1.152 1.696-1.152 1.6-1.088 1.184-1.088 0.448q-0.576 0-1.664-1.44-0.16-0.192-0.48-0.608-1.12-1.504-1.6-1.824-0.768-0.512-1.184 0.352-0.224 0.512-0.928 2.24t-1.056 2.56v0.64zM6.016 9.024q0 1.248 0.864 2.112t2.112 0.864 2.144-0.864 0.864-2.112-0.864-2.144-2.144-0.864-2.112 0.864-0.864 2.144z"
    ></path>
  </svg>
</template>
