<template>
    <div class="col-md-8 col-xl-9 pl-0 pr-0 chat">
        <div class="card">
            <div class="card-header msg_head">
                <div class="d-flex bd-highlight">
                    <div class="img_cont">
                        <img :src="'https://ui-avatars.com/api/?name='+receiver.name" class="rounded-circle user_img">
                        <span class="online_icon"></span>
                    </div>
                    <div class="user_info">
                        <span>Chat with {{receiver.name}}</span>
                    </div>
                </div>
                <span id="action_menu_btn" @click="toggleMenu"><i class="fas fa-ellipsis-v"></i></span>
                <div class="action_menu">
                    <ul>
                        <li @click="logout"><i class="fas fa-user-circle"></i> Logout</li>
                    </ul>
                </div>
            </div>
            <div class="card-body msg_card_body">
                <div> 
                    <div class="d-flex mb-4 justify-content-start">
                        <div class="img_cont_msg">
                            <img :src="'https://ui-avatars.com/api/?name=Demo+User'" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                        Hello World!
                        </div>
                    </div>
                    <div class="d-flex mb-4 justify-content-end">
                        <div class="img_cont_msg">
                            <img :src="'https://ui-avatars.com/api/?name=Demo+User'" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer_send">
                        Hello World!
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="input-group">
                    
                    <textarea name="message" class="form-control type_msg" placeholder="Type your message..."></textarea>
                    <div class="input-group-append">
                        <span class="input-group-text send_btn" ><i class="fas fa-location-arrow"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['receiver'],
    methods : {
        toggleMenu() {
            $('.action_menu').toggle();
        },   
        logout() {
            axios
            .post('/api/auth/logout')
            .then(response =>  {
                console.log('Logged out');
                this.$store.dispatch('resetAuthUserDetail');
                this.$router.push('/login')
            })
            .catch(error => {
                console.log('Not logged out');
                console.log(error);
            });
        },   
    }
}
</script>