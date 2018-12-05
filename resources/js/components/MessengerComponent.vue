<template>
	<div>
		<b-container fluid style="height: calc(100vh - 56px);">
			<b-row no-gutters class="h-100">
				<b-col cols="4">
					<b-form class="my-3 mx-2">
						<b-form-input
							v-model="querySearchContact"
							class="text-center"
							type="text"
							placeholder="Buscar un contacto..."
						></b-form-input>
					</b-form>
					<contact-list-component
						:conversations="conversationsFiltered"
						@conversation-selected="changeActiveConversation($event)"
					></contact-list-component>
				</b-col>

				<b-col cols="8">
					<active-conversation-component
						v-if="activeConversation"
						:contact-id="activeConversation.contact_id"
						:contact-name="activeConversation.contact_name"
						:messages="messages"
						@message-created="addMessage($event)"
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
			messages: [],
			conversations: [],
			querySearchContact: ""
		};
	},
	mounted() {
		this.getConversations();

		Echo.private(`users.${this.userId}`).listen("MessageSent", data => {
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
		conversationsFiltered() {
			return this.conversations.filter(conversation =>
				conversation.contact_name.toLowerCase().includes(this.querySearchContact.toLowerCase())
			);
		}
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
		},
		addMessage(message) {
			const conversation = this.conversations.find(conversation => {
				return (
					conversation.contact_id == message.from_id ||
					conversation.contact_id == message.to_id
				);
			});

			const author = message.from_me ? "Tú" : conversation.contact_name;
			conversation.last_message = `${author}: ${message.content}`;
			conversation.last_time = message.created_at;

			if (
				this.activeConversation != null &&
				(this.activeConversation.contact_id == message.from_id ||
					this.activeConversation.contact_id == message.to_id)
			) {
				this.messages.push(message);
			}
		},
		getConversations() {
			axios.get("/api/conversations").then(res => {
				// console.log(res);
				this.conversations = res.data;
			});
		},
		changeStatusContact(user, status) {
			const index = this.conversations.findIndex(conversation => {
				return conversation.contact_id == user.id;
			});
			// conversation.online = true;
			if (index >= 0) this.$set(this.conversations[index], "online", status);
		}
	}
};
</script>