<template>
  <div>
    <b-container fluid style="height: calc(100vh - 56px);">
      <b-row no-gutters class="h-100">
        <b-col cols="4">
          <contact-form-component/>
          <contact-list-component/>
        </b-col>

        <b-col cols="8">
          <active-conversation-component v-if="activeConversation"/>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  props: {
    user: Object
  },
  mounted() {
    this.$store.commit("setUser", this.user);
    this.$store.dispatch("getConversations").then(() => {
      const conversationId = this.$route.params.conversationId;
      if (conversationId) {
        const conversation = this.$store.getters.getConversationById(
          conversationId
        );
        this.$store.dispatch("getMessages", conversation);
      }
    });

    Echo.private(`users.${this.user.id}`).listen("MessageSent", data => {
      console.log(data);
      const message = data.message;
      message.from_me = false;
      this.addMessage(message);
    });

    Echo.join("messenger")
      .here(users => {
        // console.log("online", users);
        users.forEach(user => {
          this.changeStatusContact(user, true);
        });
      })
      .joining(user => this.changeStatusContact(user, true))
      .leaving(user => this.changeStatusContact(user, false));
  },
  computed: {
    activeConversation() {
      return this.$store.state.activeConversation;
    }
  },
  methods: {
    changeStatusContact(user, status) {
      const index = this.$store.state.conversations.findIndex(conversation => {
        return conversation.contact_id == user.id;
      });
      // conversation.online = true;
      if (index >= 0)
        this.$set(this.$store.state.conversations[index], "online", status);
    },
    addMessage(message) {
      this.$store.commit("addMessage", message);
    }
    // changeActiveConversation(conversation) {
    //   // console.log("UEP IEP :D", conversation);
    //   if (
    //     this.activeConversation != null &&
    //     conversation.id == this.activeConversation.id
    //   ) {
    //     return false;
    //   }
    //   this.activeConversation = conversation;
    //   this.getMessages();
    // },
  }
};
</script>