<template>
  <div class="flex h-full">
      <chat-window
      height="100vh" 
        :current-user-id="currentUserId"
        :rooms="rooms"
        :messages="messages"
        :rooms-loaded="true"
        :send-message="sendMessage()"
        :text-messages="{
          ROOMS_EMPTY: 'Пустые комнаты',
          ROOM_EMPTY: 'Пустая комната',
          NEW_MESSAGES: 'Новые сообщения',
          MESSAGE_DELETED: 'Сообщения удалены',
          MESSAGES_EMPTY: 'Нет сообщений',
          CONVERSATION_STARTED: 'Переписка начата',
          TYPE_MESSAGE: 'Напишите что-нибудь...',
          SEARCH: 'Поиск',
          IS_ONLINE: 'Онлайн',
          LAST_SEEN: 'Последний вход',
          IS_TYPING: 'Печатает...'
        }"
      />
  </div>
</template>


<script>
import PersonCard from '@/Shared/PersonCard.vue'
import moment from 'moment'
import axios from 'axios'
import ChatWindow from 'vue-advanced-chat'
import 'vue-advanced-chat/dist/vue-advanced-chat.css'

export default {
  metaInfo: {title: 'Чат'},
  components: {
    PersonCard,
    ChatWindow
  },
  props: {
    //tasks: Object,
    
  },
  
  data() {
    return {
      loading: false,
        rooms: [

                
              {
                roomId: 1,
                roomName: 'Общий чат',
                avatar: '/img/logo.svg',
                unreadCount: 0,
                index: 0,
                lastMessage: {
                  content: 'Последнее сообщение',
                  senderId: 1234,
                  username: 'John Doe',
                  timestamp: '10:20',
                  saved: true,
                  distributed: true,
                  seen: true,
                  new: true
                },
          users: [
            {
              _id: 1234,
              username: 'John Doe',
              avatar: '/storage/avatars/kenny.jpg',
              status: {
                state: 'online',
                lastChanged: 'today, 14:30'
              }
            },
            {
              _id: 4321,
              username: 'John Snow',
              avatar: '/storage/avatars/dustin.jpg',
              status: {
                state: 'online',
                lastChanged: '14 July, 20:00'
              }
            }
          ],
          typingUsers: [ ]
        },
        {
          roomId: 2,
          roomName: 'Свободная группа',
          avatar: '/storage/avatars/kenny.jpg',
          unreadCount: 0,
          index: 0,
          lastMessage: {
            content: 'Что сегодня делаем после',
            senderId: 1234,
            username: 'John Doe',
            timestamp: '10:20',
            saved: true,
            distributed: true,
            seen: true,
            new: true
          },
          users: []
          }
        ],
        messages: [],
        messagesLoaded:true,
        currentUserId: this.$page.props.auth.user.id
      }
  },
  watch: {
    checked: {}
  },
  created() {
    
    axios.get('/chat')
    .then(response => {
      this.users = response.data.users
    })

  },
  methods: {
    sendMessage(e) {
      console.log(e)
    },
    date(date) {
      return moment(date).format('LL')
    },
    hour(date) {
      return moment(date).format('LT')
    },
  },
}
</script>

