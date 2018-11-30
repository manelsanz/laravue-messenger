<template>
  <b-row class="h-100">
    <b-col cols="8">
      <b-card
        footer-bg-variant="light"
        footer-border-variant="dark"
        title="Conversación activa"
        class="h-100"
      >
        <message-conversation-component
          v-for="message in messages"
          :key="`message_${message.id}`"
          :from-me="message.from_me"
        >{{ message.content }}</message-conversation-component>

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

<script>
export default {
  props: {
    contactId: Number,
    contactName: String
  },
  data: function() {
    return {
      messages: [],
      newMessage: ""
    };
  },
  mounted: function() {
    this.getMessages();
  },
  methods: {
    getMessages() {
      axios.get(`/api/messages?contact_id=${this.contactId}`).then(res => {
        // console.log(res.data);
        this.messages = res.data;
      });
    },
    postMessage() {
      const params = {
        to_id: this.contactId,
        content: this.newMessage
      };
      axios.post("/api/messages", params).then(res => {
        // console.log(res.data);
        if (res.data.success) {
          this.newMessage = "";
          this.getMessages();
        }
      });
    }
  },
  watch: {
    contactId(value) {
      console.log(`contact_id => ${this.contactId}`);
      this.getMessages();
    }
  }
};
</script>
