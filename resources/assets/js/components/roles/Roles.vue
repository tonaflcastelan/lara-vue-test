<template>
  <div>
      <h1>Roles</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'createrole' }" class="btn btn-primary">Crear Rol</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="role in roles" :key="role.id">
                    <td>{{ role.id }}</td>
                    <td>{{ role.name }}</td>
                    <td><router-link :to="{name: 'editrole', params: { id: role.id }}" class="btn btn-primary">Editar</router-link></td>
                    <td><button class="btn btn-danger" @click.prevent="deleteRole(role.id)">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
  </div>
</template>

<script>
  export default {
      data() {
        return {
          roles: []
        }
      },
      created() {
      let uri = 'http://localhost:8000/api/roles';
      this.axios.get(uri).then(response => {
      	console.log(response.data);
        this.roles = response.data;
      });
    },
    methods: {
      deleteRole(id)
      {
        let uri = `http://localhost:8000/api/roles/delete/${id}`;
        this.axios.delete(uri).then(response => {
          this.roles.splice(this.roles.indexOf(id), 1);
        });
      }
    }
  }
</script>