<template>
  <b-list-group>
    <contact-component
      v-for="conversation in conversationsFiltered"
      :key="`conversation_${conversation.id}`"
      :conversation="conversation"
      :selected="isSelected(conversation)"
      @conversation-click="selectConversation(conversation)"
    ></contact-component>
    <!-- <contact-component variant="dark"></contact-component>
      <contact-component variant></contact-component>
    <contact-component variant="secondary"></contact-component>-->
  </b-list-group>
</template>

<script>
export default {
  methods: {
    selectConversation(conversation) {
      // console.log('Handle click conversation FIRED.', conversation);
      // this.selectedConversationId = conversation.id;
      // this.$emit("conversation-selected", conversation);
      this.$router.push(`/chat/${conversation.id}`, () => {
        this.$store.dispatch("getMessages", conversation);
      });
    },
    isSelected(conversation) {
      if (this.selectedConversation)
        return this.selectConversation.id == conversation.id;
      return false;
    }
  },
  computed: {
    selectedConversation() {
      return this.$store.state.activeConversation;
    },
    conversationsFiltered() {
      return this.$store.getters.conversationsFiltered;
    }
  }
};
</script>