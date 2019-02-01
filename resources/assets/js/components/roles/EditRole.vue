<template>
	<div>
		<h1>Editar Rol</h1>
		<form @submit.prevent="updateRole">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label>Nombre del rol:</label>
					<input type="text" class="form-control" v-model="role.name">
					<span v-if="errors.name" :class="['label label-danger']">{{ errors.name[0] }}</span>
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
				role: {},
				errors: {}
			}
		},
		created() {
			let uri = `http://localhost:8000/api/roles/${this.$route.params.id}/edit`;
			this.axios.get(uri).then((response) => {
				this.role = response.data;
			});
		},
		methods: {
			updateRole() {
				let uri = `http://localhost:8000/api/roles/update/${this.$route.params.id}`;
				this.axios.put(uri, this.role).then((response) => {
					this.$router.push({name: 'roles'});
				}).catch(error => {
                if (error.response && error.response.status == 422) {
                      this.errors = error.response.data;
                      console.log(this.errors);
                  }
              });
			}
		}
    }
</script>