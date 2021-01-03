<template>
    <div class="col-md-8 col-xl-9 pl-0 pr-0 chat">
        <div class="card" v-if="receiver">
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
                <div  v-for="message in messages" :key="message.id"> 
                    <div class="d-flex mb-4" :class="[message.type == 'sender' ? 'justify-content-end' : 'justify-content-start']">
                        <div class="img_cont_msg">
                            <img :src="'https://ui-avatars.com/api/?name='+(message.type == 'sender' ? authUser.name : receiver.name)" class="rounded-circle user_img_msg">
                        </div>
                        <div :class="[message.type == 'sender' ? 'msg_cotainer_send' : 'msg_cotainer']">
                        {{message.message}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="input-group">                    
                    <textarea name="message" v-model="newMessage" class="form-control type_msg" placeholder="Type your message..." ref="message" @keyup.enter="sendMessage" :disabled = "disable"></textarea>
                    <div class="input-group-append">
                        <span class="input-group-text send_btn" @click="sendMessage"><i class="fas fa-location-arrow"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['receiver','messages'],
    data() {
        return {
            newMessage: '',
            authUser : {},
            disable: false
        }
    },
    mounted() {
        this.authUser = this.$store.getters.getAuthUser;
    },
    methods : {
        toggleMenu() {
            $('.action_menu').toggle();
        },
        sendMessage() {
            this.disable = true;
            axios.post('/api/message', {receiverId: this.receiver.id, message: this.newMessage})
            .then(response =>  {
                this.newMessage = '';
                this.disable = false;
                this.messages.push(response.data.data);
                this.$nextTick(() => {
                    this.$refs.message.focus()
                })
            })
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