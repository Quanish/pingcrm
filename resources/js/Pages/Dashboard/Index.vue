<template>
<div class="flex flex-col h-full">
    <div class="flex flex-row justify-between items-start">
        <h1 class="mb-8 font-bold text-2xl">Добрый день, <span>{{ $page.props.auth.user.first_name}}</span>
            <span class="hidden md:inline">{{ $page.props.auth.user.last_name }}</span>!</h1>
        <button ><img class="h-10" src="img/message.png" @click="$page.props.auth.sidebar = true"></button>
    </div>



    <div class="flex flex-row justify-between flex-auto overflow-y-hidden gap-4">


        

        <div class="bg-white rounded-2xl  overflow-x-auto w-1/4 pb-0 ml-0  overflow-y-hidden flex flex-col relative flex-auto shadow-sm">
            <div class="flex justify-between items-center px-6 gap-2 py-4 border-b border-gray-100">
                <p class="font-medium text">Задачи</p>
                <div class="relative inline-flex">
                    <svg class="w-2 h-2 absolute  right-0 m-2  pointer-events-none fill-current text-white fill-current text-white" viewBox="0 0 412 232">
                        <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" />
                    </svg>
                    <select v-model="sortTasksBy"  class="text-white text-xs bg-blue-500 rounded-full text-gray-100 h-6 pl-5 pr-7 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                        <option :value="1">свои</option> 
                        <option :value="2">порученные</option> 
                        <option :value="0">все</option>
                    </select>
                </div>
                <p class="bg-blue-500 rounded-full text-white w-6 h-6 flex justify-center  items-center text-xs ">{{ filteredTasks.length }}</p>
            </div>
            
            <div class="overflow-y-auto px-6 flex-auto pb-12 mb-2">
                <div v-for="task in filteredTasks" :key="task.id">
                    <div class="py-4 ">
                        <inertia-link class="flex items-start w-full justify-between focus:text-indigo-500" :href="route('tasks.show', task.id)">
                            <div class="flex flex-col text-sm font-medium">{{task.title}}
                                <p class="text-xs font-normal text-gray-300" style="font-size: 0.6rem">{{ computeDays(task.deadline) }} дня до дедлайна</p>
                            </div>
                            <p class="rounded-full text-white text-xs flex px-2 py-1 items-center whitespace-nowrap font-light" :class="'bg-' + statuses[task.status].color + '-500'">{{ statuses[task.status].name }}</p>
                            <icon v-if="task.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
                        </inertia-link>

                        <div v-if="computeDays(task.deadline) < 0  && task.status != 1" class="w-full bg-red-400 rounded-full h-1"></div>
                        <div v-else-if="computeDays(task.deadline) == 1 && task.status != 1" class="w-full bg-orange-400 rounded-full h-1"></div>
                        <div v-else-if="computeDays(task.deadline) == 0 && task.status != 1" class="w-full bg-yellow-400 rounded-full h-1"></div>
                        <div v-else-if="computeDays(task.deadline) > 1 && computeDays(task.deadline) < 4 && task.status != 1" class="w-full bg-yellow-400 rounded-full h-1"></div>
                        <div v-else class="w-full rounded-full h-1" :class="'bg-green-400'"></div>
                    </div>
                </div> 
            </div>
            <div class="flex absolute px-4 w-full bottom-0 bg-gradient-to-b from-transparent to-white">
                <button class="my-4  w-full block text-black items-center rounded-full h-8 px-7 text-xs leading-7 bg-gray-200 hover:bg-gray-300" @click="showCreateTaskModal(1)">Новая задача</button>
            </div> 
        </div>

        

        <subtasks :task_id="0" :items="subtasks" :class="'w-1/4 flex-auto shadow-sm'" ></subtasks>
        


        <div class="bg-white rounded-2xl  overflow-x-auto w-1/4 pb-0 overflow-y-hidden flex flex-col relative flex-auto shadow-sm">
            <div class="flex justify-between items-center px-6 gap-2 py-4 border-b border-gray-100">
                <p class="font-medium text">Встречи</p>
                <div class="relative inline-flex">
                    <svg class="w-2 h-2 absolute  right-0 m-2  pointer-events-none fill-current text-white" viewBox="0 0 412 232">
                        <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"  fill-rule="nonzero" /></svg>
                    <select v-on:change="changeItem2($event)" class="text-white bg-blue-500 rounded-full text-xs h-6 pl-5 pr-7 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                        <option>сегодня</option>
                        <option>месяц</option>
                        <option>год</option>
                        <option selected>все время</option>
                    </select>
                </div>
                <p class="bg-blue-500  rounded-full text-white w-6 h-6 flex justify-center  items-center text-xs ">{{meetCounter}}</p>
            </div>
         
            <div class=" overflow-y-auto px-6 flex-auto pb-12 mb-2">
                <div v-for="meeting in xmeetings">
                    <!-- <p class="notification">{{meeting.description}}</p> -->
                </div>
            </div>
        </div>


        <div class="bg-white rounded-2xl  overflow-x-auto w-1/4 pb-0 mr-0 overflow-y-hidden flex flex-col relative flex-auto shadow-sm">
            <div class="flex justify-between px-6 py-4 border-b border-gray-100 ">
                <p class="font-medium text h-7 leading-loose">События</p>  
                <p class="bg-blue-500 rounded-full text-white w-6 h-6 flex justify-center  items-center text-xs ">{{ orderedEvents.length }}</p>
            </div>
            <div class="flex-auto overflow-y-auto px-6 pb-4 flex-auto">
                <transition-group name="fade" tag="p">
                <div v-for="event in orderedEvents" class="mt-3"  :key="event.id">
                    <div class="border rounded-2xl px-5 py-4 flex flex-col hover:border-indigo-300 hover:shadow-sm">
                        <div class="flex flex-row justify-between mb-3">
                            <div class="flex flex-row">
                                <person-card :src="'/storage/' + event.user.photo_path" :fullname="event.user.last_name + ' ' + event.user.first_name" :job="event.user.position.name"></person-card>
                            </div>
                            <button class="rounded-full bg-gray-100 hover:bg-gray-200 flex justify-center items-center w-5 h-5" @click="closeEvent(event)">
                                <svg class="h-2 w-2 fill-current text-black-600" viewBox="0 0 311 311.07733"><path d="m16.035156 311.078125c-4.097656 0-8.195312-1.558594-11.308594-4.695313-6.25-6.25-6.25-16.382812 0-22.632812l279.0625-279.0625c6.25-6.25 16.382813-6.25 22.632813 0s6.25 16.382812 0 22.636719l-279.058594 279.058593c-3.136719 3.117188-7.234375 4.695313-11.328125 4.695313zm0 0"/><path d="m295.117188 311.078125c-4.097657 0-8.191407-1.558594-11.308594-4.695313l-279.082032-279.058593c-6.25-6.253907-6.25-16.386719 0-22.636719s16.382813-6.25 22.636719 0l279.058594 279.0625c6.25 6.25 6.25 16.382812 0 22.632812-3.136719 3.117188-7.230469 4.695313-11.304687 4.695313zm0 0"/></svg>
                            </button>
                        </div>
                        <p class="font text-2xs text-gray-300">{{event.created_at }}</p>
                        <p class="font text-sm">{{ event.text }}</p>
                        <div class="flex flex-row  mt-3">
                            <inertia-link href="#" class="hover:bg-gray-200 rounded-full  px-3  py-1  mr-2 bg-gray-100 text-gray-400 h-6 leading-4 text-xs">Связаться
                            </inertia-link>
                            <template>
                                <inertia-link v-if="event.task !== null" :href="route('tasks.show',event.task.id)" class="hover:bg-gray-200 rounded-full px-3  py-1 bg-gray-100 text-gray-400 h-6 leading-4 text-xs">Перейти
                                </inertia-link>
                                <inertia-link v-else href="#" class="hover:bg-gray-200 rounded-full  px-3  py-1 bg-gray-100 text-gray-400 h-6 leading-4 text-xs">Перейти
                                </inertia-link>
                            </template>
                        </div> 
                    </div>
                </div>
                </transition-group>
            </div>
        </div>
    </div>



    <modal name="create_tasks">
      <create-task :type="type"></create-task>
    </modal>

    



</div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Checkbox from '@/Shared/Checkbox'
import Chat from '@/Shared/Chat'
import RadialProgressBar from 'vue-radial-progress'
import CreateTask from '../Tasks/Create.vue'
import Subtasks from '../Tasks/Subtasks.vue'
import PersonCard from '@/Shared/PersonCard.vue'
import axios from "axios";
import moment from "moment";
import _ from 'lodash'
import { hasBgRendering } from '@fullcalendar/vue'

export default {
    metaInfo: {
        title: 'Dashboard'
    },
    
    layout: Layout,
    data() {
        return {
            deadline: "",
            title: "",
            tasktitle: "",
            sortTasksBy: 0,
            description: "",
            myworks: this.tasks.filter(x => x.subtask != ''),
            xmeetings: [],
            taskCounter: 0,
            workCounter: 0,
            meetCounter: 0,
            filteredTasks: [],
            date: Date.now(),
            timestamp: "",
            completedSteps: 0,
            totalSteps: 10,
            type: 1,
            projects: ['Озеленение', 'Гостиница', 'Ресторан', 'Ресторан'],
            statuses: {
                0: {
                    name: 'Новый',
                    color: 'indigo'
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
    props: {
        tasks: Array,
        meetings: Array,
        events: Array,
        subtasks: Array,
    },
    created() {
        var month = this.tasks;

        this.filteredTasks = this.tasks

        for (var i = month.length - 1; i >= 0; i--) {
            this.taskCounter++;
        } 
    
        var meet = this.tasks.filter(x => x.type == 2);
        for (var i = meet.length - 1; i >= 0; i--) {
            this.xmeetings.push(meet[i]);
            this.meetCounter++;
        }
    },
    components: {
        RadialProgressBar,
        Checkbox,
        CreateTask,
        Subtasks,
        PersonCard,
        Chat
    },
    watch: {
        sortTasksBy: function (val) {
            if(val == 0) {
                this.filteredTasks = this.tasks
            }
            if(val == 1) {
                this.filteredTasks = this.tasks.filter((el, index) => {
                    return el.user_id === this.$page.props.auth.user.id && el.user_id !== el.auditor_id
                })
            }
            if(val == 2) {
                this.filteredTasks = this.tasks.filter((el, index) => {
                    return el.auditor_id === this.$page.props.auth.user.id
                }) 
            }
        }
    },
    computed: {
        orderedEvents: function () {
            console.log(this.events);
            return _.orderBy(this.events, 'created_at','desc')

        },
    },
    methods: {
      showDescription(description,title,tasktitle,deadline){
        this.deadline = this.computeDays(deadline);
        this.title = title;
        this.tasktitle = tasktitle;
        this.description = description;
        this.$modal.show('subtask_description');
      },
      computeDays(deadline){
          var difference = new Date(deadline) - Date.now()
          var days = difference/(1000 * 3600 * 24)
          return Math.round(days);
      },
        create() {
            this.$inertia.get(this.route('tasks.create'))
        },
        checkDeadline(date) {
            if (date > this.date) {
                return true;
            } else {
                this.index -= 1;
                return false;
            }
        },
        changeItem1: function changeItem1(event) {
            var today = new Date(Date.now());
            switch (String(event.target.value)) {
                case "по сроку":
                    this.myworks = _.orderBy(this.tasks, 'id','desc');
                    break;
                case "по срочности":
                    this.myworks = _.orderBy(this.tasks, 'id','asc');
                    break;
                case "просроченные":
                    
                    break;
                default:
                    
                    break;
            }
        },
        changeItem2: function changeItem2(event) {
            var today = new Date(Date.now());
            switch (String(event.target.value)) {
                case "сегодня":
                    this.xmeetings = this.tasks.filter(x => x.type == "встреча" && new Date(x.deadline) > today && new Date(x.created_at) < today);
                    break;
                case "месяц":
                    this.xmeetings = this.tasks.filter(x => x.type == "встреча" && new Date(x.deadline).getMonth() == today.getMonth() && new Date(x.created_at).getMonth() == today.getMonth());
                    break;
                case "год":
                    this.xmeetings = this.tasks.filter(x => x.type == "встреча" && new Date(x.deadline).getFullYear() == today.getFullYear() && new Date(x.created_at).getFullYear() == today.getFullYear());
                    break;
                default:
                    this.xmeetings = this.tasks.filter(x => x.type == 'встреча');
                    break;
            }
        },
        showCreateTaskModal(type) {
            this.type = type
            this.$modal.show('create_tasks')
        },
        closeEvent(event) {
            let index = this.events.indexOf(event);
            if(index > -1) this.events.splice(index, 1)
            
            axios.post('/events/seen', {
                id: event.id
            })
            .then(response => {
                console.log(event.id);
            })

            
        }
    }
}
</script>



<style scoped>

.fade-enter-active {
  animation: fade .4s reverse;
}
.fade-leave-active {
  animation: fade .4s ;
}
@keyframes fade {
  0% {
    opacity: 1;
    transform: translateX(0)
  }
  50% {
    opacity: 0;
  }
  100% {
    opacity: 0;
    transform: translateX(100%)
  }
}


.btn-check {
    border: 1.5px solid #999999;
}
</style>