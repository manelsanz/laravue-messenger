<template>
  <b-media :right-align="fromMe" vertical-align="center" class="mb-2">
    <b-img :src="image" rounded="circle" slot="aside" width="48" height="48" alt="placeholder"></b-img>
    <b-card>
      <slot></slot>
    </b-card>
  </b-media>
</template>

<script>
export default {
  props: {
    fromMe: Boolean,
    image: String
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