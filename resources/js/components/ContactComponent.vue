<template>
	<b-list-group-item :variant="variant" @click="$emit('conversation-click')">
		<b-row class="p-2" align-h="center">
			<b-col cols="12" md="3" class="text-center">
				<b-img
					rounded="circle"
					:src="conversation.contact_image"
					width="60"
					height="60"
					title="Imagen usuario"
					alt="Imagen usuario"
					class="m-1"
				/>
			</b-col>
			<b-col cols="6" align-self="center" class="d-none d-md-block">
				<p class="mb-1">
					<b-img
						v-show="conversation.online"
						rounded="circle"
						blank
						width="10"
						height="10"
						blank-color="green"
						alt="img"
					/>
					{{ conversation.contact_name }}
				</p>
				<p class="text-muted small mb-1">{{ conversation.last_message }}</p>
			</b-col>
			<b-col cols="3" class="d-none d-md-block">
				<p class="text-muted small">{{ lastTime }}</p>
			</b-col>
		</b-row>
	</b-list-group-item>
</template>

<script>
export default {
	props: {
		conversation: Object,
		selected: Boolean
	},
	computed: {
		lastTime() {
			return moment(this.conversation.last_time, "YYYY-MM-DD hh:mm:ss")
				.locale("es")
				.fromNow();
		},
		variant() {
			return this.selected ? 'secondary' : '';
		}
		// image() {
		// 	return `/users/${this.conversation.contact_image}`;
		// }
	}
};
</script>
