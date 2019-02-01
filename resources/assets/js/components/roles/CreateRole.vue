<template>
  <div>
    <h1>Crear Rol</h1>
    <form @submit.prevent="addRole">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Nombre:</label>
            <input type="text" class="form-control" v-model="role.name">
            <span v-if="errors.name" :class="['label label-danger']">{{ errors.name[0] }}</span>
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
          role:{},
          errors:{}
        }
    },
    methods: {
      addRole(){
        let uri = 'http://localhost:8000/api/roles/create';
           this.axios.post(uri, this.role).then((response) => {
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