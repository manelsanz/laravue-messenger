<template>
  <div>
    <b-form class="my-3 mx-2">
      <b-form-input class="text-center" type="text" placeholder="Buscar un contacto..."></b-form-input>
    </b-form>
    <b-list-group>
      <contact-component
        v-for="conversation in conversations"
        :key="`conversation_${conversation.id}`"
        :conversation="conversation"
        @conversation-click="selectConversation(conversation)"
      ></contact-component>
      <!-- <contact-component variant="dark"></contact-component>
      <contact-component variant></contact-component>
      <contact-component variant="secondary"></contact-component>-->
    </b-list-group>
  </div>
</template>

<script>
export default {
  data() {
    return {
      conversations: []
    };
  },
  mounted() {
    this.getConversations();
  },
  methods: {
    getConversations() {
      axios.get("/api/conversations").then(res => {
        // console.log(res);
        this.conversations = res.data;
      });
    },
    selectConversation(conversation) {
        // console.log('Handle click conversation FIRED.', conversation);
        this.$emit('conversation-selected', conversation);
    }
  }
};
</script>