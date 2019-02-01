<template>
  <div>
      <h1>Usuarios</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'createuser' }" class="btn btn-primary">Crear Usuario</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>E-mail</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role.name }}</td>
                    <td><router-link :to="{name: 'edituser', params: { id: user.id }}" class="btn btn-primary">Editar</router-link></td>
                    <td><button class="btn btn-danger" @click.prevent="deleteUser(user.id)">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
  </div>
</template>

<script>
  export default {
      data() {
        return {
          users: []
        }
      },
      created() {
      let uri = 'http://localhost:8000/api/users';
      this.axios.get(uri).then(response => {
      	console.log(response.data);
        this.users = response.data;
      });
    },
    methods: {
      deleteUser(id)
      {
        let uri = `http://localhost:8000/api/users/delete/${id}`;
        this.axios.delete(uri).then(response => {
          this.users.splice(this.users.indexOf(id), 1);
        });
      }
    }
  }
</script>