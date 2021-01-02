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
                    <h6 class="font-weight-light text-center mt-2">Sign in to continue.</h6>
                    <form class="form-horizontal pt-3" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" placeholder="Your Email" name="email" value="" autocomplete="off" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" autocomplete="off" required>
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
    
}
</script>

<style>
    .auth-form {
        background: #fff;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
    }
    .auth-form:hover{
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .auth form .form-group .form-control {
        background: #fff;
    }
    .brand-logo img {
        border-radius: 10px;
        width: 60px
    }
    .btn-black{
        background: #282f3a;
        color: #fff;
    }
    .btn:hover{
        color:#fff;
    }
    .page-body-wrapper.full-page-wrapper {
        width: 100%;
        min-height: 100vh;
        padding-top: 0;
    }
    .container-scroller {
        overflow: hidden;
    }
    .container-fluid, .container-sm, .container-md, .container-lg, .container-xl {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    .page-body-wrapper {
        min-height: calc(100vh - 70px);
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        flex-direction: row;
        padding-left: 0;
        padding-right: 0;
        padding-top: 70px;
    }
    .page-body-wrapper.full-page-wrapper {
        width: 100%;
        min-height: 100vh;
        padding-top: 0;
    }
    .content-wrapper {
        background: #ededed;
        padding: 2.68rem 2.5rem;
        width: 100%;
        -webkit-flex-grow: 1;
        flex-grow: 1;
    }
    .auth form .form-group .form-control{
            border-radius: 0;
        font-size: .9375rem;
    }
</style>