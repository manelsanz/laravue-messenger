<template>
  <b-form class="my-3 mx-2">
    <b-form-input
      v-model="querySearchContact"
      class="text-center"
      type="text"
      placeholder="Buscar un contacto..."
    ></b-form-input>
  </b-form>
</template>

<script>
export default {
    methods: {

    },
    computed: {
        querySearchContact: {
            get() {
                return this.$store.state.querySearchContact;
            },
            set(value) {
                this.$store.commit('newQuerySearchContact', value);
            }
        }
    }
};
</script>

