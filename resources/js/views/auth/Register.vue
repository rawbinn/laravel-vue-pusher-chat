<template>
<section class="login-block">
    <div class="container register-box">
        <div class="row">
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>Laravel Vue Pusher Chata</h2>
                                    <p>Realtime chat using Laravel framework, Vue.js and Pusher to send and receive realtime messages.<br> By Rawbinn Shrestha</p>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 login-sec">
                <div class="text-center mb-3 brand-logo">
                    <img src="images/logo.jpg" alt="logo">
                </div>
                <form class="login-form" method="post" @submit.prevent="submit">
                    <div class="form-group">
                        <label for="fullname" class="text-uppercase">FullName</label>
                        <input type="text" v-model="data.name" id="fullname" class="form-control" placeholder="FullName" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-uppercase">Email</label>
                        <input type="email" v-model="data.email" id="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                    <label for="password" class="text-uppercase">Password</label>
                    <input type="password" v-model="data.password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-check">
                        <router-link to="/login">Back to Log in</router-link>
                        <button type="submit" class="btn btn-login float-right">Register</button>
                    </div>
                </form>
                
            </div>
            
        </div>
    </div>
</section>
</template>

<script>
export default {
    data() {
        return {
            data : {
                name: '',
                email: '',
                password: ''
            }
        }
    },
    methods: {
        submit(){
             return axios.post('/api/auth/register', this.data)
             .then(response => response.data)
             .then(response =>  {
                console.log('Logged in');
                toastr.success(response.message);
                this.$router.push('/login');
            }).catch(error => {
                console.log('Not logged in');
                toastr.error(error.response.data.message);
            });
        },
    }
}
</script>

<style>
</style>