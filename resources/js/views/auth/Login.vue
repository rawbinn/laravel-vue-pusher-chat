<template>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo text-center">
                    <img src="images/logo.jpg" alt="logo">
                    </div>
                    <h6 class="font-weight-light text-center">Sign in to continue.</h6>
                    <form class="form-horizontal pt-3" method="POST" @submit.prevent="submit">
                        <div class="form-group">
                            <input type="text" v-model="data.email" class="form-control" id="email" placeholder="Your Email" name="email" value="" autocomplete="off" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" v-model="data.password" class="form-control" id="password" placeholder="Enter Password" name="password" autocomplete="off" required>
                        </div>
                        <div class="mt-3 text-center">
                            <button class="btn btn-block btn-black btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                            <p class="mt-2">OR</p>
                            <router-link to="/register">Register</router-link>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            data : {
                email : '', 
                password: ''
            },
        }
    },
    methods: {
        submit() {
             axios
            .post('/api/auth/login', this.data)
            .then(response => {
                console.log('Logged in');
                localStorage.setItem('auth_token',response.data.token);
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('auth_token');
                this.$store.dispatch('setAuthStatus');
                this.$store.dispatch('setAuthUserDetail',response.data.user);
                this.$router.push({ path: '/' });
                
            })
            .catch(error => {
                console.log('Not logged in');
                if(error.response) toastr.error(error.response.data.message)
            });
        },
    }
}
</script>

<style>
    
</style>