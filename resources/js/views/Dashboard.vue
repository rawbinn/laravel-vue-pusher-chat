<template>
    <div class="row ml-0 mr-0 justify-content-center">
        <div class="col-md-4 col-xl-3 pr-0 pl-0 chat">
        <div class="card mb-sm-3 mb-md-0 contacts_card green">
            <div class="card-header">
                <div class="input-group">
                    <h1>Laravel Vue Pusher Chat</h1>
                </div>
            </div>
            <div class="card-body contacts_body">
                <ul class="contacts">
                    <li v-for="user in users" :key="user.id" @click="loadChatUser(user)" :class="{'active':user.id == receiver.id}">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img :src="'https://ui-avatars.com/api/?name='+user.name" class="rounded-circle user_img">
                            </div>
                            <div class="user_info">
                                <span>{{user.name}}</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                <p>Designed & Developed by <a href="https://rawbinn.com">Rawbinn Shrestha</a></p>
            </div>
        </div>
    </div>
	<Message :receiver = 'receiver' :messages = 'messages' :loading = 'loading' :typing = 'typing'/>
    </div>
</template>

<script>
	import Message from "./message/Message";
	import Echo from "laravel-echo";

	export default {
		data() {
			return {
				users: [],
				messages: [],
				receiver: {},
				authUser: {},
				typing: false,
				loading: true
			}
		},
		mounted() {
            this.getUsers();
			this.authUser = this.$store.getters.getAuthUser;
			window.echo = new Echo({
				broadcaster: 'pusher',
				key: process.env.MIX_PUSHER_APP_KEY,
				cluster: process.env.MIX_PUSHER_APP_CLUSTER,
				forceTLS: false,
				auth: {
					headers: {
						Authorization: "Bearer " + localStorage.getItem('auth_token'),
						Accept: "application/json",
					},
				},
			});
			this.listen();
		},
		methods: {
			async getUsers() {
				this.loading = true;
				await axios.get('/api/users')
				.then(response => response.data)
				.then(response => {
					this.loading = false;
					if(response.data.length == 0) {
						toastr.warning('Users not found!!!')
						return
					}
                    this.users = response.data;
                    this.receiver = this.users[0];
					this.loadChatUser(this.users[0]);
				})
				.catch(error => {
					console.log(error);
					
					if(error.response){
						if(error.response.status == 401) {
							this.logout();
							return
						}
						toastr.error(error.response.data.message);
					}
				});
            },
            
            loadChatUser(receiver) {
				this.loading = true;
				this.receiver = receiver;
				axios.get('/api/'+receiver.id+'/messages')
				.then(response => response.data)
				.then(response => {
					this.loading = false;
					this.messages = response.data
				})
				.catch(error => {
					console.log(error);
					if(error.response && error.response.status == 401) {
						this.logout();
					}
				});
			},
			
			listen() {
				let _this = this;
				echo.private('chat-'+this.authUser.id)
				.listen('MessageSent', (e) => {
					if(e.sender.id == this.receiver.id) {
						this.messages.push(e.message)
					}
				}).listenForWhisper('typing', (e) => {
					if(this.receiver.id == e.user.id) {
						this.typing = true
					}
					setTimeout(function() {
						_this.typing = false
					}, 1000);
				});
			},

			logout() {
                this.$store.dispatch('resetAuthUserDetail');
                this.$router.push('/login')
			}
		},
		components : {
			Message
		}
	}
</script>

<style>
</style>