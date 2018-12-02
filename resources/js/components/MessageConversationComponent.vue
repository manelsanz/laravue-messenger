<template>
  <b-media :right-align="fromMe" vertical-align="center" class="mb-2">
    <b-img rounded="circle" slot="aside" blank blank-color="#ccc" width="48" alt="placeholder"></b-img>
    <b-card>
      <slot></slot>
    </b-card>
  </b-media>
</template>

<script>
export default {
  props: {
    fromMe: Boolean
  },
  data() {
    return {
      // content: ""
    };
  },
  mounted() {
    // console.log("Component mounted.");
  }
};
</script>