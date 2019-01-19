import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        messages: [],
        activeConversation: null,
        conversations: [],
        querySearchContact: '',
        // newMessage: '',
        user: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        newMessagesList(state, messages) {
            state.messages = messages;
        },
        addMessage(state, message) {
            const conversation = state.conversations.find(conversation => {
                return (
                    conversation.contact_id == message.from_id ||
                    conversation.contact_id == message.to_id
                );
            });

            const author = message.from_me ? "Tú" : conversation.contact_name;
            conversation.last_message = `${author}: ${message.content}`;
            conversation.last_time = message.created_at;

            if (
                state.activeConversation != null &&
                (state.activeConversation.contact_id == message.from_id ||
                    state.activeConversation.contact_id == message.to_id)
            )
                state.messages.push(message);

        },
        selectConversation(state, conversation) {
            state.activeConversation = conversation;
        },
        newQuerySearchContact(state, value) {
            state.querySearchContact = value;
        },
        newConversationsList(state, conversations) {
            state.conversations = conversations;
        },
    },
    actions: {
        getMessages(context, conversation) {
            axios.get(`/api/messages?contact_id=${conversation.contact_id}`)
                .then(res => {
                    context.commit("selectConversation", conversation);
                    context.commit("newMessagesList", res.data);
                });
        },
        getConversations(context) {
            return axios.get("/api/conversations").then(res => {
                context.commit('newConversationsList', res.data);
            });
        },
        postMessage(context, newMessage) {
            const params = {
                to_id: context.state.activeConversation.contact_id,
                content: newMessage
            };
            axios.post("/api/messages", params).then(res => {
                // console.log('post message ok', res.data);
                if (res.data.success) {
                    newMessage = "";
                    const message = res.data.message;
                    message.from_me = true;
                    // this.$emit("message-created", message);
                    // this.getMessages();
                    context.commit('addMessage', message);
                }
            });
        },
        postNotificationStatus(context, status) {
            const params = {
                id: context.state.activeConversation.id,
                listen_notifications: status
            };
            axios.post("/api/conversations/notify", params).then(res => {
                console.log('post notification from store ok', res.data);
                
                if (res.data.success) {

                    const conversation = context.state.activeConversation;
                    conversation.listen_notifications = status ? 1 : 0;

                    context.commit('selectConversation', conversation);
                }
            });
        },

    },
    getters: {
        conversationsFiltered(state) {
            return state.conversations.filter(conversation =>
                conversation.contact_name
                    .toLowerCase()
                    .includes(state.querySearchContact.toLowerCase())
            );
        },
        getConversationById(state) {
            return function (id) {
                return state.conversations.find(conversation => conversation.id == id);
            }
        }
    },
});