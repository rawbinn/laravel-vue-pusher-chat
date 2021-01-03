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
    .login-block{
        float:left;
        width:100%;
        padding : 50px 0;
    }
    .register-box:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .register-box {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
    }
    .banner-sec {
        background:url(https://static.pexels.com/photos/33972/pexels-photo.jpg)  no-repeat left bottom; background-size:cover; min-height:500px;
        padding:0;
    }
    .container{
        background:#fff; 
    }
    .carousel-inner {
        border-radius:0 10px 10px 0;
    }
    .carousel-caption {
        text-align:left; left:5%;
    }
    .login-sec{
        padding: 50px 30px;
        position:relative;
    }
    .login-sec .copy-text {
        position:absolute; 
        width:80%; 
        bottom:20px; 
        font-size:13px; 
        text-align:center;
    }
    .login-sec .copy-text i {
        color:#FEB58A;
    }
    .login-sec .copy-text a {
        color:#E36262;
    }
    .login-sec>div:after {
        content:" ";
        width:100px;
        height:5px; 
        background:#537eff; 
        display:block;
        margin-top:20px;
        border-radius:3px;
        margin-left:auto;
        margin-right:auto
    }
    .btn-login {
        background: #537eff; 
        color:#fff; 
        font-weight:600;
    }
    .banner-text {
        width:70%; 
        position:absolute; 
        bottom:40px; 
        padding-left:20px;
    }
    .banner-text h2 {
        color:#fff; 
        font-weight:600;
    }
    .banner-text h2:after {
        content:" "; 
        width:100px; 
        height:5px; 
        background:#FFF; 
        display:block;     
        margin-top:20px; 
        border-radius:3px;
    }
    .banner-text p {
        color:#fff;
    }
</style>