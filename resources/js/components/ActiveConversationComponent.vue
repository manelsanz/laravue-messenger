<template>
  <b-row class="h-100">
    <b-col cols="8">
      <b-card
        no-body
        footer-bg-variant="light"
        footer-border-variant="dark"
        title="Conversación activa"
        class="h-100"
      >
        <b-card-body class="card-body-scroll">
          <message-conversation-component
            v-for="message in messages"
            :key="`message_${message.id}`"
            :from-me="message.from_me ? true : false"
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
        rounded="circle"
        blank
        width="60"
        height="60"
        blank-color="#777"
        alt="img"
        class="m-1"
      />
      <p>{{ contactName }}</p>
      <hr>
      <b-form-checkbox>Desactivar notificaciones</b-form-checkbox>
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
  props: {
    contactId: Number,
    contactName: String,
    messages: Array
  },
  data: function() {
    return {
      newMessage: ""
    };
  },
  mounted: function() {
    // this.getMessages();
  },
  methods: {
    postMessage() {
      const params = {
        to_id: this.contactId,
        content: this.newMessage
      };
      axios.post("/api/messages", params).then(res => {
        // console.log(res.data);
        if (res.data.success) {
          this.newMessage = "";
          // this.getMessages();
        }
      });
    },
    scrollToBottom() {
      const el = document.querySelector(".card-body-scroll");
      el.scrollTop = el.scrollHeight;
    }
  },
  updated() {
    this.scrollToBottom();
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
