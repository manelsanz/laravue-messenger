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
          ></active-conversation-component>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      activeConversation: null
    };
  },
  mounted() {},
  methods: {
    changeActiveConversation(conversation) {
      //   console.log('UEP IEP :D', conversation);
      this.activeConversation = conversation;
    }
  }
};
</script>