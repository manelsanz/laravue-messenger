<template>
  <b-row class="h-100">
    <b-col cols="8">
      <b-card no-body footer-bg-variant="light" footer-border-variant="dark" class="h-100">
        <b-card-body class="card-body-scroll">
          <message-conversation-component
            v-for="message in messages"
            :key="`message_${message.id}`"
            :from-me="!!message.from_me"
            :image="message.from_me ? myImage : activeConversation.contact_image"
          >{{ message.content }}</message-conversation-component>
        </b-card-body>

        <div slot="footer">
          <b-form @submit.prevent="postMessage" class="mb-0" autocomplete="off">
            <b-input-group>
              <b-form-input v-model="newMessage" type="text" placeholder="Escribe a tu amigo..."></b-form-input>
              <b-input-group-append>
                <b-button type="submit" variant="primary">Enviar</b-button>
              </b-input-group-append>
            </b-input-group>
          </b-form>
        </div>
      </b-card>
    </b-col>

    <b-col cols="4">
      <b-img
        :src="activeConversation.contact_image"
        rounded="circle"
        width="60"
        height="60"
        alt="img"
        class="m-1"
      />
      <p>{{ activeConversation.contact_name }}</p>
      <hr>
      <b-form-checkbox
        :checked="notificationStatus"
        @change="postNotificationStatus"
      >Desactivar notificaciones</b-form-checkbox>
    </b-col>
  </b-row>
</template>

<style>
.card-body-scroll {
  max-height: calc(100vh - 63px);
  overflow-y: auto;
}
</style>


<script>
export default {
  data: function() {
    return {
      newMessage: ""
    };
  },
  updated() {
    this.scrollToBottom();
  },
  methods: {
    postNotificationStatus(status) {
      this.$store.dispatch("postNotificationStatus", status);
    },
    postMessage() {
      this.$store.dispatch("postMessage", this.newMessage).then(() => {
        this.newMessage = "";
      });
    },
    scrollToBottom() {
      const el = document.querySelector(".card-body-scroll");
      el.scrollTop = el.scrollHeight;
    }
  },
  computed: {
    messages() {
      return this.$store.state.messages;
    },
    activeConversation() {
      return this.$store.state.activeConversation;
    },
    notificationStatus() {
      return this.activeConversation.listen_notifications ? true : false;
    },
    myImage() {
      return `/users/${this.$store.state.user.image}`;
    }
  }
  // watch: {
  //   messages() {
  //     setTimeout(() => {
  //       this.scrollToBottom();
  //     }, 100);
  //   }
  // }
  // watch: {
  //   contactId(value) {
  //     console.log(`contact_id => ${this.contactId}`);
  //     this.getMessages();
  //   }
  //}
};
</script>
