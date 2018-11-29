<template>
  <b-row class="h-100">
    <b-col cols="8">
      <b-card
        footer-bg-variant="light"
        footer-border-variant="dark"
        title="Conversación activa"
        class="h-100"
      >
        <message-conversation-component v-for="message in messages" :key="`message_${message.id}`" :from-me="false">
            {{ message.content }}
        </message-conversation-component>

        <div slot="footer">
          <b-form class="mb-0">
            <b-input-group>
              <b-form-input type="text" placeholder="Escribe a tu amigo..."></b-form-input>
              <b-input-group-append>
                <b-button variant="primary">Enviar</b-button>
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
      <p>Usuario seleccionado</p>
      <hr>
      <b-form-checkbox>Desactivar notificaciones</b-form-checkbox>
    </b-col>
  </b-row>
</template>

<script>
export default {
  data: function() {
    return {
      messages: []
    };
  },
  mounted: function() {
    axios.get("/api/messages").then(res => {
      console.log(res.data);

      this.messages = res.data;
    });
  }
};
</script>
