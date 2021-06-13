<template>
  <div class="flex flex-col h-full">
    <div class="flex flex-row justify-between gap-5">
      <div class="w-5/12 mb-5 pr-2">
        <div class="px-4">
          <input type="text" class="w-full text-black font-medium bg-transparent text-lg mr-2 mb-2" v-model="task.title" />
          <div v-if="computeDays(task.deadline) < 0 && task.status != 1" class="w-full bg-red-400 rounded-full h-1 mr-2"></div>
          <div v-else-if="computeDays(task.deadline) == 1 && task.status != 1" class="w-full bg-orange-400 rounded-full h-1 mr-2"></div>
          <div v-else-if="computeDays(task.deadline) == 0 && task.status != 1" class="w-full bg-yellow-400 rounded-full h-1 mr-2"></div>
          <div v-else-if="computeDays(task.deadline) > 1 && computeDays(task.deadline) < 4 && task.status != 1" class="w-full bg-yellow-400 rounded-full h-1 mr-2"></div>
          <div v-else class="w-full rounded-full h-1" :class="'bg-green-400'"></div>
        </div>
        
      </div>

      <div class="flex flex-row gap-8 w-7/12 justify-between">
        <div class="flex flex-row gap-10">
          <div class="flex flex-col items-center">
            <p class="mb-3 font-medium">Статус</p>
            <div class="py-1 px-8 text-sm text-white rounded-full font-normal" :class="'bg-' +statuses[task.status].color + '-500'">
              
               {{ statuses[task.status].name }}
              
            </div>
          </div>
          <div class="flex flex-col items-center">
            <p class="mb-5 font-medium">Создано</p>
            <div class="text-gray-500 text-sm">{{ date(task.created_at) }} {{ hour(task.created_at) }}</div>
          </div>
          <div class="flex flex-col items-center">
            <p class="mb-5 font-medium">Дедлайн</p>
            <div class="text-gray-500 text-sm">{{ date(task.deadline) }} {{ hour(task.deadline) }}</div>
          </div>
          <div class="items-center bg-red-500 p-4 py-0 rounded-xl text-white text-center flex flex-col justify-center relative -top-1" v-if="computeDays(task.deadline) < 0">
            <p class="mb-1 text">  {{ computeDays(task.deadline) }} день</p>
            <p class="text-sm text-sm">просрочена</p>  
          </div>
          <div class="items-center bg-yellow-500 p-4 py-0 rounded-xl text-white text-center flex flex-col justify-center relative -top-1" v-else-if="computeDays(task.deadline) == 0">
            <p class="mb-1 text">  Дедлайн</p>
            <p class="text-sm text-sm">сегодня</p>  
          </div>
          <div class="items-center bg-green-500 p-4 py-0 rounded-xl text-white text-center flex flex-col justify-center relative -top-1" v-else>
            <p class="mb-1 text">  {{ computeDays(task.deadline) }} дней</p>
            <p class="text-sm text-sm">до дедлайна</p>
          </div>
        </div>

        <div>
          <img class="h-10" src="/img/message.png" @click="$page.props.auth.sidebar = true"/>
        </div>
      </div>
    </div>

    <div class="flex flex-row gap-5 flex-auto overflow-y-hidden"> 
      <div class="w-5/12 bg-white rounded-2xl p-5 mt-2 flex-auto overflow-y-auto">
        <div class="flex flex-col justify-between h-full">
          <div>
            <div class="flex gap-4 justify-around border-gray-100 pb-3 border-b">
              <div class="w-1/2x">
                <p class="font-medium text-base">Постановщик</p>
              </div>
              <div class="w-1/2x">
                <p class="font-medium text-base">Ответственный</p>
              </div>
            </div>

            <div class="flex gap-4 mt-4">
              <div class="w-1/2">
                <person-card :id="task.auditor.id" :src="'/storage/' + task.auditor.photo_path" :fullname="task.auditor.name" :job="task.auditor.position.name"></person-card>
              </div>
              <div class="w-1/2">
                <person-card :id="task.user.id" :src="'/storage/' + task.user.photo_path" :fullname="task.user.name" :job="task.user.position.name"></person-card>
              </div>
            </div> 

            <div class="border rounded-xl border-gray-200 mt-5 p-5 hover:border-blue-400">
              <p class="text-sm">{{ task.description }}</p>




              <div class="flex justify-between mt-5">

                  

                <template v-if="(task.status == 0 && $page.props.auth.user.id != task.auditor.id) || (task.status == 0 && task.user.id == task.auditor.id)">   
                  
                  <form @submit.prevent="accept(2)" class="flex flex-wrap w-full gap-3">
                    <button class="rounded-full bg-green-400 hover:bg-green-500 text-white h-6 px-7 text-sm leading-6" type="submit">принять</button>
                    <!-- <button class="rounded-full text-white h-6 px-7 text-sm leading-6 bg-indigo-600 hover:bg-indigo-500" @click="download">скачать</button> -->
                  </form>

                </template>  

                <template v-if="(task.status == 2 && task.user.id == $page.props.auth.user.id) || (task.status == 2 && task.user.id == task.auditor.id)">  
                  
                  <form @submit.prevent="accept(3)" class="flex flex-wrap w-full gap-3">
                    <button class="rounded-full bg-green-400 hover:bg-green-500 text-white h-6 px-7 text-sm leading-6" type="submit">завершить</button>
                  </form>
 
                </template>  

      

                <template v-if="(task.status == 3 && task.auditor.id == $page.props.auth.user.id) || (task.status == 3 && task.user.id == task.auditor.id)">  
                  
                  <div class="flex flex-wrap w-full gap-3">
                    <form @submit.prevent="accept(1)" >
                      <button class="rounded-full bg-green-400 hover:bg-green-500 text-white h-6 px-7 text-sm leading-6" type="submit">принять и завершить</button>
                    </form>

                    <form @submit.prevent="accept(2)" >
                      <button class="rounded-full bg-gray-400 hover:bg-gray-500 text-white h-6 px-7 text-sm leading-6" type="submit">на доработку</button>
                    </form>
                  </div>
                  

                </template>  
          


              </div>


              <div class="flex mt-6 mb-1" v-if="task.urgent">
                <div class="bg-red-500 rounded-full w-4 h4"></div>
                <p class="text-gray-600 font-normal ml-3 text-xs" >срочно</p>
              </div>
            </div>
          </div>
          <div v-if="task.file">
            <div class="font-medium mb-3">Прикрепленные файлы</div>
            <a  :href="'/storage/'+task.file.path" download class="rounded-full p-2 px-4 bg-indigo-400 hover:bg-indigo-500 text-sm text-white font-normal">{{task.file.name}}</a>
          </div>
          <div class="mt-10 pb-3 flex flex-row leading-loose font-medium">
            <span class="mr-3">Участники</span>  
            <person-card :id="task.auditor.id" class="relative" :src="'/storage/' + task.auditor.photo_path" :fullname="task.auditor.name" :job="task.auditor.position.name" :hide="true"></person-card>
            <person-card :id="task.user.id" class="relative -left-1" :src="'/storage/' + task.user.photo_path" :fullname="task.user.name" :job="task.user.position.name" :hide="true"></person-card>
          </div>
        </div>
      </div>



      
      <div class="w-4/12 bg-white rounded-2xl p-5 mt-2 flex-auto">
        <div class="relative h-full flex flex-col justify-between">
          <div class="flex flex-row justify-between border-b border-gray-100 pb-4">
            <p class="font-medium">Комментарии ({{coms.length }})</p>
          </div>

          
          <div class="flex-auto overflow-y-auto">
            <div v-for="com in coms" class="my-3">


              <div v-if="$page.props.auth.user.id != com.user.id">
                <person-card :id="com.user.id" class="relative" :src="'/storage/' + com.user.photo_path" :fullname="com.user.name" :job="com.user.position.name" :hide="false"></person-card>
                
                <div class="flex flex-col gap-2 border border-gray-200 rounded-xl p-2 mt-2 w-9/12">
                  <div class="text-2xs text-gray-300">
                    {{ date(com.created_at) }}
                  </div>
                  <div class="text-sm text-black">
                      {{ com.text }}
                  </div>
                </div>
                
              </div>

              <div v-else class="flex flex-row justify-end items-start gap-2"> 
                
                <div class="flex flex-col gap-2 border border-gray-200 rounded-xl p-2 w-9/12">
                  <div class="text-2xs text-gray-300">
                    {{ date(com.created_at) }}
                  </div>
                  <div class="text-sm text-black">
                      {{ com.text }}
                  </div>
                </div>
                <person-card :id="com.user.id" class="relative" :src="'/storage/' + com.user.photo_path" :fullname="com.user.name" :job="com.user.position.name" :hide="true"></person-card>
                
              </div>




            </div>
          </div>

          <div class="relative w-full mt-auto">
            <svg class="absolute right-2 top-2.5 w-5 h-5 fill-current text-indigo-600 cursor-pointer" viewBox="0 0 448.011 448.011" @click="addComment">
              <g>
                <path
                  d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
              l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
              l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z"/>
              </g>
            </svg>
            <input class="p-4 h-10 border border-gray-200 rounded-lg w-full" v-model="comment" placeholder="Ваше сообщение..."  v-on:keyup.13="addComment"/>
          </div>
        </div>
      </div>
 
     
      <subtasks :task_id="task.id" :items="subtasks" :class="'w-3/12 flex-auto mt-2'"></subtasks>
     
    </div>

     
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'
import PersonCard from '@/Shared/PersonCard.vue'
import axios from 'axios'
import Subtasks from '../Tasks/Subtasks.vue'
import moment from 'moment'

export default {
  metaInfo() {
    return {
      title: `Задача`,
    }
  },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
    PersonCard,
    Subtasks 
  },
  layout: Layout,
  props: {
    task: Object,
    comments: Array,
    subtasks: Array,
  },
  remember: 'form',
  data() {
    return {
      comment: '',
      coms: {},
      form: this.$inertia.form({
       
      }),
      statuses: {
        0: {
          name: 'Новый',
          color: 'gray'
        },
        1: {
          name: 'Завершен',
          color: 'green'
        },
        2: {
          name: 'Выполняется',
          color: 'skyblue'
        },
        3: {
          name: 'На проверке',
          color: 'orange'
        },
      }
    }
  },
  created() {
    
    this.coms = this.comments
  },
  methods: {
    date(date) {
      return moment(date).format('LL')
    },
    hour(date) {
      return moment(date).format('LT')
    },
    computeDays(deadline) {
      var difference = new Date(deadline) - Date.now()
      var days = difference / (1000 * 3600 * 24)
      return Math.round(days)
    },

    showCreateSubtaskModal() {
      this.$modal.show('subtask')
    },

    addComment() {
      
      axios.post('/tasks/comment', {
        text: this.comment,
        id: this.task.id,
      }).then(response => {

        console.log(response.data)
        this.coms.push(response.data)
      })
      
      this.comment = ''
    },

    changeItem: function changeItem(event) {
      switch (String(event.target.value)) {
        case 'месяц':
          this.taskCounter = 0
          this.mytasks.splice(0)
          var date = new Date()
          date.setDate(date.getDate() + 30)
          //this.mytasks.pop(0);
          //console.log(this.mytasks.filter(x => new Date(x.deadline) < Date.now()))
          var month = this.tasks.filter((x) => new Date(x.deadline) < date)

          for (var i = month.length - 1; i >= 0; i--) {
            this.mytasks.push(month[i])

            this.taskCounter++
          }

          break
        case 'год':
          this.taskCounter = 0
          this.mytasks.splice(0)
          var date = new Date()
          date.setDate(date.getDate() + 300)
          //this.mytasks.pop(0);
          //console.log(this.mytasks.filter(x => new Date(x.deadline) < Date.now()))
          var month = this.tasks

          for (var i = month.length - 1; i >= 0; i--) {
            this.mytasks.push(month[i])
            this.taskCounter++
          }

          break
        case 'сегодня':
          this.taskCounter = 0
          this.mytasks.splice(0)
          var date = Date.now()
          //this.mytasks.pop(0);
          //console.log(this.mytasks.filter(x => new Date(x.deadline) < Date.now()))
          var month = this.tasks.filter((x) => new Date(x.deadline) > date)

          for (var i = month.length - 1; i >= 0; i--) {
            this.mytasks.push(month[i])
            this.taskCounter++
          }

          break
        default:
          this.taskCounter = 0
          this.mytasks.splice(0)

          var month = this.tasks

          for (var i = month.length - 1; i >= 0; i--) {
            this.mytasks.push(month[i])
            this.taskCounter++
          }
          
      }
    },

    download() {
      alert('В работе')
    },

    decline() {
      alert('отклонить')
    },

    accept(status) {
     
      this.form.put(this.route('tasks.accept',
        {
        task: this.task.id,
        status: status
      }))
    },

    

  },
}
</script>
