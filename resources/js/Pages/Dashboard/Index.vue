<template>
<div>
    <div class="flex flex-row justify-between">
        <h1 class="mb-8 font-bold text-2xl">Добрый день, <span>{{ $page.props.auth.user.first_name}}</span>
            <span class="hidden md:inline">{{ $page.props.auth.user.last_name }}</span>!</h1>
        <img class="h-10" src="img/message.png">
    </div>
    <div class="flex flex-row justify-between">



        <div class="bg-white rounded-2xl  overflow-x-auto w-1/4  py-4 pb-0 mx-4 ml-0">
            <div class="flex justify-between items-center px-6 gap-2">
                <p class="font-medium text">Задачи</p>
                <div class="relative inline-flex">
                    <svg class="w-2 h-2 absolute  right-0 m-2  pointer-events-none fill-current text-white fill-current text-white"  viewBox="0 0 412 232">
                        <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" />
                    </svg>
                    <select v-on:change="changeItem($event)" class="text-white text-xs bg-blue-500 border border-gray-300 rounded-full text-gray-100 h-6 pl-5 pr-7 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                        <option>сегодня</option> 
                        <option>месяц</option>
                        <option>год</option>
                        <option>все время</option>
                    </select>
                </div>
                <p class="bg-blue-500 rounded-full text-white w-6 h-6 flex justify-center  items-center text-xs ">{{taskCounter}}</p>
            </div>
            <hr class="my-5 mx-6 mb-0">
            <div class="h-screen-2 overflow-y-auto px-6">
                <div v-for="task in mytasks">
                    <div>
                        <inertia-link class="py-4 flex items-center w-full justify-between focus:text-indigo-500" :href="route('tasks.show', task.id)">
                            <div class="flex flex-col text-sm">{{task.title}}
                                <p class="text-xs font-normal text-gray-300" style="font-size: 0.6rem">2 дня до дедлайна</p>
                            </div>
                            <p class="task-button-working rounded-full text-white text-xs flex px-2 py-1 items-center whitespace-nowrap font-light">{{task.status}}</p>
                            <icon v-if="task.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
                        </inertia-link>
                        <div v-if="task.status == 'ожидание'" class="w-full bg-green-500 rounded-full h-1"></div>
                        <div v-else-if="task.status = 'в работе'" class="w-full bg-yellow-800 rounded-full h-1"></div>
                        <div v-else-if="task.status = 'завершено'" class="w-full bg-green-500 rounded-full h-1"></div>
                        <div v-else-if="new Date(task.deadline) < Date.now()" class="w-full bg-red-500 rounded-full h-1"></div>
                        <div v-else class="w-full bg-indigo-500 rounded-full h-1"></div>
                    </div>
                </div>
            </div>
            <div class="flex">
                 <button class="my-4  w-full block mx-6 text-black items-center rounded-full h-8 px-7 text-xs leading-7 bg-gray-200 hover:bg-gray-300" @click="showCreateTaskModal">Новая задача</button>
            </div> 
           
        </div>




        <div class="bg-white rounded-2xl  overflow-x-auto w-1/4  py-4 pb-0 mx-4">
            <div class="flex justify-between items-center px-6 gap-2 ">
                <p class="font-medium text">Дела</p>
                <div class="relative inline-flex">
                    <svg class="w-2 h-2 absolute  right-0 m-2  pointer-events-none fill-current text-white" viewBox="0 0 412 232">
                        <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"  fill-rule="nonzero" />
                    </svg>
                    <select v-on:change="changeItem1($event)"  class="text-white bg-blue-500 border border-gray-300 rounded-full text-xs h-6 pl-5 pr-7 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                        <option>сегодня</option>
                        <option>месяц</option>
                        <option>год</option>
                        <option selected>все время</option>
                    </select>
                </div>
                <p class="bg-blue-500 rounded-full text-white w-6 h-6 flex justify-center  items-center text-xs ">{{workCounter}}</p>
            </div>
            <hr class="my-5 mx-6 mb-0">
            <div class="h-screen-2 overflow-y-auto px-6">
                <div v-for="project in myworks" class="flex justify-start gap-2">
                  <checkbox :label="project.title" :value="project.title" v-model="project.checked" />
                </div>
            </div>
            <div class="flex">
                 <button class="my-4  w-full block mx-6 text-black items-center rounded-full h-8 px-7 text-xs leading-7 bg-gray-200 hover:bg-gray-300">Добавить</button>
            </div> 
        </div>

        <div class="bg-white rounded-2xl  overflow-x-auto w-1/4  py-4 pb-0 mx-4">
            <div class="flex justify-between items-center px-6 gap-2 ">
                <p class="font-medium text">Встречи</p>
                <div class="relative inline-flex">
                    <svg class="w-2 h-2 absolute  right-0 m-2  pointer-events-none fill-current text-white" viewBox="0 0 412 232">
                        <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"  fill-rule="nonzero" /></svg>
                    <select v-on:change="changeItem2($event)" class="text-white bg-blue-500 border border-gray-300 rounded-full text-xs h-6 pl-5 pr-7 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                        <option>сегодня</option>
                        <option>месяц</option>
                        <option>год</option>
                        <option selected>все время</option>
                    </select>
                </div>
                <p class="bg-blue-500  rounded-full text-white w-6 h-6 flex justify-center  items-center text-xs ">{{meetCounter}}</p>
            </div>
            <hr class="my-5 mx-6 mb-0">
            <div class="h-screen-2 overflow-y-auto px-6">
                <div v-for="meeting in mymeet">
                    <!-- <p class="notification">{{meeting.description}}</p> -->
                </div>
                <div class="flex flex-row"><button v-on:click="create" class="mt-2  leading-normal">Добавить</button></div>
            </div>
        </div>

        <div class="bg-white rounded-2xl  overflow-x-auto w-1/4  py-4 pb-0 mx-4 mr-0">
            <div class="flex justify-start px-6">
                <p class="font-medium text h-7 leading-loose">События</p>  
            </div>
            <hr class="my-5 mx-6 mb-0">
            <div class="h-screen-2 overflow-y-auto px-6 pb-4">
                <div v-for="event in orderedEvents" class="mt-3">
                    <div class="border rounded-2xl px-5 py-4 flex flex-col">
                        <div class="flex flex-row justify-between mb-3">
                            <div class="flex flex-row">
                                <img class="h-8 border rounded-full" src="img/user1.webp">
                                <div class="flex flex-col  ml-2">
                                    <p>{{event.user.first_name}}</p>
                                    <p class="text-xs text-gray-300">Сотрудник</p>
                                </div>
                            </div>
                            <button class="rounded-full bg-gray-100 hover:bg-gray-200 flex justify-center items-center w-5 h-5">
                                <svg class="h-2 w-2 fill-current text-black-600" viewBox="0 0 311 311.07733"><path d="m16.035156 311.078125c-4.097656 0-8.195312-1.558594-11.308594-4.695313-6.25-6.25-6.25-16.382812 0-22.632812l279.0625-279.0625c6.25-6.25 16.382813-6.25 22.632813 0s6.25 16.382812 0 22.636719l-279.058594 279.058593c-3.136719 3.117188-7.234375 4.695313-11.328125 4.695313zm0 0"/><path d="m295.117188 311.078125c-4.097657 0-8.191407-1.558594-11.308594-4.695313l-279.082032-279.058593c-6.25-6.253907-6.25-16.386719 0-22.636719s16.382813-6.25 22.636719 0l279.058594 279.0625c6.25 6.25 6.25 16.382812 0 22.632812-3.136719 3.117188-7.230469 4.695313-11.304687 4.695313zm0 0"/></svg>
                            </button>
                        </div>
                        <p class="font text-sm">{{event.description}}</p>
                        <div class="flex flex-row  mt-3">
                            <inertia-link href="#" class="hover:bg-gray-200 rounded-full  px-3  py-1  mr-2 bg-gray-100 text-gray-400 h-6 leading-4 text-xs">Связаться
                            </inertia-link>
                            <template>
                                <inertia-link v-if="event.task !== null" :href="route('tasks.show',event.task.id)" class="hover:bg-gray-200 rounded-full px-3  py-1 bg-gray-100 text-gray-400 h-6 leading-4 text-xs">Перейти к задаче
                                </inertia-link>
                                <inertia-link v-else href="#" class="hover:bg-gray-200 rounded-full  px-3  py-1 bg-gray-100 text-gray-400 h-6 leading-4 text-xs">Перейти к задаче
                                </inertia-link>
                            </template>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <modal name="create_tasks">
      <create-task :users="null" :select="null"></create-task>
    </modal>



</div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Checkbox from '@/Shared/Checkbox'
import RadialProgressBar from 'vue-radial-progress'
import CreateTask from '../Tasks/Create.vue'
import _ from 'lodash'

export default {
    metaInfo: {
        title: 'Dashboard'
    },
    layout: Layout,
    data() {
        return {
            mytasks: [],
            myworks: [],
            mymeet: [],
            taskCounter: 0,
            workCounter: 0,
            meetCounter: 0,
            date: Date.now(),
            timestamp: "",
            completedSteps: 0,
            totalSteps: 10,
            projects: ['Озеленение', 'Гостиница', 'Ресторан', 'Ресторан']
        }
    },
    props: {
        tasks: Array,
        events: Array,
    },
    created() {
        var month = this.tasks;
        for (var i = month.length - 1; i >= 0; i--) {
            this.mytasks.push(month[i]);
            this.taskCounter++;
        } 
        var work = this.tasks.filter(x => x.type == 'дела');
        for (var i = work.length - 1; i >= 0; i--) {
            this.myworks.push(work[i]);
            this.workCounter++;
        }
        var meet = this.tasks.filter(x => x.type == 'встреча');
        for (var i = meet.length - 1; i >= 0; i--) {
            this.mymeet.push(meet[i]);
            this.meetCounter++;
        }
    },
    components: {
        RadialProgressBar,
        Checkbox,
        CreateTask
    },
    computed: {
        orderedEvents: function () {
            return _.orderBy(this.events, 'created_at','desc')
        }
    },
    methods: {
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
                case "сегодня":
                    this.myworks = this.tasks.filter(x => x.type == "дела" && new Date(x.deadline) > today && new Date(x.created_at) < today);
                    break;
                case "месяц":
                    this.myworks = this.tasks.filter(x => x.type == "дела" && new Date(x.deadline).getMonth() == today.getMonth() && new Date(x.created_at).getMonth() == today.getMonth());
                    break;
                case "год":
                    this.myworks = this.tasks.filter(x => x.type == "дела" && new Date(x.deadline).getFullYear() == today.getFullYear() && new Date(x.created_at).getFullYear() == today.getFullYear());
                    break;
                default:
                    this.myworks = this.tasks.filter(x => x.type == 'дела');
                    break;
            }
        },
        changeItem2: function changeItem2(event) {
            var today = new Date(Date.now());
            switch (String(event.target.value)) {
                case "сегодня":
                    this.mymeet = this.tasks.filter(x => x.type == "встреча" && new Date(x.deadline) > today && new Date(x.created_at) < today);
                    break;
                case "месяц":
                    this.mymeet = this.tasks.filter(x => x.type == "встреча" && new Date(x.deadline).getMonth() == today.getMonth() && new Date(x.created_at).getMonth() == today.getMonth());
                    break;
                case "год":
                    this.mymeet = this.tasks.filter(x => x.type == "встреча" && new Date(x.deadline).getFullYear() == today.getFullYear() && new Date(x.created_at).getFullYear() == today.getFullYear());
                    break;
                default:
                    this.mymeet = this.tasks.filter(x => x.type == 'встреча');
                    break;
            }
        },
        changeItem: function changeItem(event) {

            switch (String(event.target.value)) {
                case "месяц":
                    this.taskCounter = 0;
                    this.mytasks.splice(0);
                    var date = new Date();
                    date.setDate(date.getDate() + 30);
                    //this.mytasks.pop(0);
                    //console.log(this.mytasks.filter(x => new Date(x.deadline) < Date.now()))
                    var month = this.tasks.filter(x => new Date(x.deadline) < date);

                    for (var i = month.length - 1; i >= 0; i--) {
                        this.mytasks.push(month[i]);

                        this.taskCounter++;
                    }
                    console.log(this.mytasks);

                    break;
                case "год":
                    this.taskCounter = 0;
                    this.mytasks.splice(0);
                    var date = new Date();
                    date.setDate(date.getDate() + 300);
                    //this.mytasks.pop(0);
                    //console.log(this.mytasks.filter(x => new Date(x.deadline) < Date.now()))
                    var month = this.tasks;

                    for (var i = month.length - 1; i >= 0; i--) {
                        this.mytasks.push(month[i]);
                        this.taskCounter++;
                    }
                    console.log(this.mytasks);

                    break;
                case "сегодня":
                    this.taskCounter = 0;
                    this.mytasks.splice(0);
                    var date = Date.now();
                    //this.mytasks.pop(0);
                    //console.log(this.mytasks.filter(x => new Date(x.deadline) < Date.now()))
                    var month = this.tasks.filter(x => new Date(x.deadline) > date);

                    for (var i = month.length - 1; i >= 0; i--) {
                        this.mytasks.push(month[i]);
                        this.taskCounter++;
                    }
                    console.log(this.mytasks);

                    break;
                default:
                    this.taskCounter = 0;
                    this.mytasks.splice(0);

                    //this.mytasks.pop(0);
                    //console.log(this.mytasks.filter(x => new Date(x.deadline) < Date.now()))
                    var month = this.tasks;

                    for (var i = month.length - 1; i >= 0; i--) {
                        this.mytasks.push(month[i]);
                        this.taskCounter++;
                    }
                    console.log(this.mytasks);

            }
        },
        showCreateTaskModal() {
            this.$modal.show('create_tasks')
        },
    }
}
</script>
<style scoped>
.btn-check {
    border: 1.5px solid #999999;
}
</style>