<template>
    <div class="col-md-8 col-xl-9 pl-0 pr-0 chat">
        <loading :active='loading' :is-full-page="fullpage" :loader='loader'/>
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
            <div class="card-body msg_card_body" v-chat-scroll="{always: false}">
                <div  v-for="message in messages" :key="message.id"> 
                    <div class="d-flex mb-4" :class="[message.type == 'sender' ? 'justify-content-end' : 'justify-content-start']">
                        <div class="img_cont_msg">
                            <img :src="'https://ui-avatars.com/api/?name='+(message.type == 'sender' ? authUser.name : receiver.name)" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer" :class="[message.type == 'sender' ? 'message-send' : 'message-receive']">
                        {{message.message}}
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="card-footer position-relative">
                <div class="wishper" v-if="typing">
                    <p class="typing">{{receiver.name}} is typing...</p>
                </div>
                <div class="input-group">
                    <textarea name="message" v-model="newMessage" @keydown="isTyping" class="form-control type_msg" placeholder="Type your message..." ref="message" @keyup.enter="sendMessage" :disabled = "disableTextArea"></textarea>
                    <div class="input-group-append">
                        <span class="input-group-text send_btn" @click="sendMessage"><i class="fas fa-location-arrow"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
    props: ['receiver','messages', 'loading', 'typing'],
    data() {
        return {
            newMessage: '',
            authUser : {},
            fullpage: false,
            loader: 'bars',
            disableTextArea: false
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
            this.disableTextArea = true;
            axios.post('/api/message', {receiverId: this.receiver.id, message: this.newMessage})
            .then(response =>  {
                this.newMessage = '';
                this.disableTextArea = false;
                this.messages.push(response.data.data);
                this.$nextTick(() => {
                    this.$refs.message.focus()
                })
            })
        },
        isTyping() {
            echo.private('chat-'+this.receiver.id).whisper('typing', {
                user: this.authUser,
                typing: true
            });
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
    },
    components: {
        Loading
    }
}
</script>