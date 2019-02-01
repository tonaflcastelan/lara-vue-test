<template>
	<div>
		<h1>Editar Usuario</h1>
		<form @submit.prevent="updateUser">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label>Imagen de perfil</label>
					<img v-bind:src="'/uploads/' +user.profile" :style="{width: '200px'}">
				</div>
				</div>
			</div>
			<div class="form-group">
            	<label>Imagen:</label>
            	<input type="file" class="form-control" v-on:change="onImageChange">
          	</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label>Nombre:</label>
					<input type="text" class="form-control" v-model="user.name">
					<span v-if="errors.name" :class="['label label-danger']">{{ errors.name[0] }}</span>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label>E-mail:</label>
					<input type="text" class="form-control" v-model="user.email">
					<span v-if="errors.email" :class="['label label-danger']">{{ errors.email[0] }}</span>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label>Password:</label>
					<input type="password" class="form-control" v-model="user.password">
					<span v-if="errors.password" :class="['label label-danger']">{{ errors.password[0] }}</span>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label>Role:</label>
					<select v-model="user.role_id">
						<option value="0" class="form-control">Selecciona un rol</option>
						<option v-for="role in roles" v-bind:value="role.id">{{ role.name }}</option>
					</select>
					<span v-if="errors.role_id" :class="['label label-danger']">{{ errors.role_id[0] }}</span>
				</div>
				</div>
			</div>
			<div class="form-group">
				<button class="btn btn-primary">Actualizar</button>
			</div>
		</form>
	</div>
</template>

<script>
    export default {
		data() {
			return {
				user: {},
				roles:[],
				errors: {}
			}
		},
		created() {
			let uri = `http://localhost:8000/api/users/${this.$route.params.id}/edit`;
			this.axios.get(uri).then((response) => {
				this.user = response.data;
			});

			let uris = 'http://localhost:8000/api/roles';
				this.axios.get(uris).then(response => {
				console.log(response.data);
				this.roles = response.data;
        	});
		},
		methods: {
			onImageChange(e){
                console.log(e.target.files[0]);
                this.image = e.target.files[0];
            },
			updateUser() {

				let uri = `http://localhost:8000/api/users/update/${this.$route.params.id}`;
				const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                console.log(this.user.name);
		        let formData = new FormData();
		        formData.append('name', this.user.name);
		        formData.append('email', this.user.email);
		        formData.append('password', this.user.password);
		        formData.append('role_id', this.user.role_id);

		        formData.append('image', this.image);

		        console.log(formData);
				
				this.axios.post(uri, formData, config).then((response) => {
					this.$router.push({name: 'users'});
				}).catch(error => {
                if (error.response && error.response.status == 422) {
                      this.errors = error.response.data;
                      console.log(this.errors);
                  }
              
                /*error => this.status = error.response.data.status;
                console.log(error.response.data);
                console.log(error.response.status);*/
            	});
			}
		}
    }
</script>