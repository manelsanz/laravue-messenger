<template>
	<b-container>
		<b-form class="m-3" enctype="multipart/form-data" method="post">
			<input type="hidden" name="_token" v-model="token">
			<input type="hidden" name="_method" value="PATCH">

			<b-form-group label="Email:">
				<b-form-input
					type="email"
					v-model="user.email"
					name="email"
					disabled
					placeholder="Correo electrónico"
				></b-form-input>
			</b-form-group>
			<b-form-group label="Nombre:">
				<b-form-input type="text" v-model="user.name" name="name" required placeholder="Tu nombre"></b-form-input>
			</b-form-group>

			<b-form-group label="Nueva contraseña:" description="* Rellenar sólo si se desea actualizar.">
				<b-form-input type="password" name="password" placeholder="Tu nueva contraseña"></b-form-input>
			</b-form-group>

			<b-form-group label="Imagen de perfil" description="* Rellenar sólo si se desea actualizar.">
				<b-img
					rounded="circle"
					:src="image"
					width="60"
					height="60"
					title="Imagen actual"
					alt="Imagen actual"
				/>

				<b-form-file name="image" placeholder="Selecciona una imagen nueva"/>
			</b-form-group>

			<b-button type="submit" variant="primary">Guardar cambios</b-button>
			<!-- <b-button type="reset" variant="danger">Reset</b-button> -->
		</b-form>
	</b-container>
</template>

<script>
export default {
	props: {
		user: Object,
		token: String
	},
	data() {
		return {};
	},
	computed: {
		image() {
			return `/users/${this.user.image}`;
		}
	}
};
</script>