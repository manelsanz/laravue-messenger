<template>
  <div>
    <b-container fluid style="height: calc(100vh - 56px);">
      <b-row no-gutters class="h-100">
        <b-col cols="4">
          <contact-list-component @conversation-selected="changeActiveConversation($event)"></contact-list-component>
        </b-col>

        <b-col cols="8">
          <active-conversation-component
            v-if="activeConversation"
            :contact-id="activeConversation.contact_id"
            :contact-name="activeConversation.contact_name"
            :messages="messages"
          ></active-conversation-component>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  props: {
    userId: Number
  },
  data() {
    return {
      activeConversation: null,
      messages: []
    };
  },
  mounted() {
    Echo.channel("exempleee").listen("MessageSent", data => {
      console.log(data);
      const message = data.message;
      message.from_me = this.userId == message.from_id;
      this.messages.push(message);
    });
  },
  methods: {
    changeActiveConversation(conversation) {
      // console.log("UEP IEP :D", conversation);
      if (
        this.activeConversation != null &&
        conversation.id == this.activeConversation.id
      ) { 
        return false;
      }
      this.activeConversation = conversation;
      this.getMessages();
    },
    getMessages() {
      axios
        .get(`/api/messages?contact_id=${this.activeConversation.contact_id}`)
        .then(res => {
          // console.log(res.data);
          this.messages = res.data;
        });
    }
  }
};
</script>