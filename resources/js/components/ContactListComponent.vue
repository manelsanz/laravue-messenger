<template>
	<b-list-group>
		<contact-component
			v-for="conversation in conversations"
			:key="`conversation_${conversation.id}`"
			:conversation="conversation"
			:selected="selectedConversationId === conversation.id ? true : false"
			@conversation-click="selectConversation(conversation)"
		></contact-component>
		<!-- <contact-component variant="dark"></contact-component>
      <contact-component variant></contact-component>
		<contact-component variant="secondary"></contact-component>-->
	</b-list-group>
</template>

<script>
export default {
	props: {
		conversations: Array
	},
	data() {
		return {
			selectedConversationId: null
		};
	},
	methods: {
		selectConversation(conversation) {
			// console.log('Handle click conversation FIRED.', conversation);
			this.selectedConversationId = conversation.id;
			this.$emit("conversation-selected", conversation);
		}
	}
};
</script>