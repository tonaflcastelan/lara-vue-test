<template>
  <div>
    <h1>Crear Usuario</h1>
    <form @submit.prevent="addUser">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Nombre:</label>
            <input type="text" class="form-control" v-model="user.name">
            <span v-if="errors.name" :class="['label label-danger']">{{ errors.name[0] }}</span>
          </div>
          <div class="form-group">
            <label>E-mail:</label>
            <input type="text" class="form-control" v-model="user.email">
            <span v-if="errors.email" :class="['label label-danger']">{{ errors.email[0] }}</span>
          </div>
          <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" v-model="user.password">
            <span v-if="errors.password" :class="['label label-danger']">{{ errors.password[0] }}</span>
          </div>
          <div class="form-group">
            <label>Rol:</label>
            <select v-model="user.role_id">
            <option value="0" class="form-control">Selecciona un rol</option>
             <option v-for="role in roles" v-bind:value="role.id">{{ role.name }}</option>
             </select>
             <span v-if="errors.role_id" :class="['label label-danger']">{{ errors.role_id[0] }}</span>
          </div>
          <div class="form-group">
            <label>Imagen:</label>
            <input type="file" class="form-control" v-on:change="onImageChange">
          </div>
        </div>
        </div>
        <br />
        <div class="form-group">
          <button class="btn btn-primary">Crear</button>
        </div>
    </form>
  </div>
</template>

<script>
    export default {
        data(){
        return {
          user:{},
          image: '',
          roles:[],
          errors: {}
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
      onImageChange(e){
                console.log(e.target.files[0]);
                this.image = e.target.files[0];
            },
      addUser(){
        let uri = 'http://localhost:8000/api/users/create';
        const config = {
          headers: { 'content-type': 'multipart/form-data' }
        }

        let formData = new FormData();
        let name;
        if (this.user.name === undefined || this.user.name === null) {
          formData.append('name', '');
        } else {
          formData.append('name', this.user.name);
        }

        if (this.user.email === undefined || this.user.email === null) {
          formData.append('email', '');
        } else {
          formData.append('email', this.user.email);
        }
        
        if (this.user.password === undefined || this.user.password === null) {
          formData.append('password', '');
        } else {
          formData.append('password', this.user.password);
        }

        if (this.user.role_id === undefined || this.user.role_id === null) {
          formData.append('role_id', '');
        } else {
          formData.append('role_id', this.user.role_id);
        }

        formData.append('image', this.image);

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