<template>
    <div>
        <div class="alert alert-danger" v-if="error">
            <p>Hubo un error, no se puede loguear con las credenciales</p>
        </div>
        <form autocomplete="off" @submit.prevent="login">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
            </div>
            <button type="submit" class="btn btn-default">Log In</button>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                email: null,
                password: null,
                error: false
            }
        },

        mounted(){
        },

        methods: {
            login(){
                var app = this
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    }, 
                    success: function () {},
                    error: function (resp) {
                        console.log(resp)
                    },
                    rememberMe: true,
                    redirect: '/dashboard',
                    fetchUser: true,
                });             
            },
        }
    }   
</script>
