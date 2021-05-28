<template>
	<div>
    <div class="flex flex-row justify-between">
      <div class="w-5/12 mb-5">
        <input type="text" class="border-b-2 border-gray-200 w-11/12 text-black font-medium bg-transparent text-lg" v-model="task.title">
      </div>
      
      <div class="flex flex-row gap-8 w-7/12 justify-between">
        <div class="flex flex-row gap-10"> 
          <div class="flex flex-col items-center">
            <p class="mb-3 font-medium">Статус</p>
            <div class="bg-indigo-500 py-1 px-8 text-sm text-white rounded-full font-normal">новый</div>
          </div>
          <div class="flex flex-col items-center"><p class="mb-5 font-medium">Старт</p>
            {{task.date_created}}
          </div>
          <div class="flex flex-col items-center"><p class="mb-5 font-medium">Дедлайн</p>
            {{task.deadline}}
          </div>
          <div class="items-center bg-gray-300 p-4 py-0 rounded-xl text-white text-center flex flex-col justify-center">
            <p class="mb-1 text">10 дней</p>
            <p class="text-sm text-sm">до дедлайна</p>
          </div>
        </div>

        <div>
          <img class="h-10" src="/img/message.png" />
        </div>
        
        
      </div>
      
      
    </div>
    <div class="flex flex-row gap-5">


    <div class="w-5/12 bg-white rounded-2xl p-5 mt-5  mh-calc">
      <div class="flex flex-col justify-between h-full">
        <div>
            <div class="flex gap-4 justify-around">
                <div class="w-1/2x">
                  <p class="font-medium text-base">Постановщик</p>
                </div>   
                <div class="w-1/2x">
                  <p class="font-medium text-base">Ответственный</p>
                </div>   
            </div>

            <hr class="mt-3 h-2 border-gray-200">

            <div class="flex gap-4 mt-4">
                <div class="w-1/2">
                  <person-card src="/img/user1.webp" name="Kuanish Aitimov" job="сотрудник" ></person-card>
                </div>   
                <div class="w-1/2">
                  <person-card src="/img/default-user.png" name="John Doe" job="сотрудник"></person-card>
                </div>   
            </div>
            
            <div class="border rounded-xl border-gray-200 mt-5 p-5">
              <p class="text-sm">{{task.description}}</p>
              <div class="flex justify-between mt-5">
                <form @submit.prevent="accept" class="flex flex-wrap w-full gap-3"> 
                  <button class="rounded-full bg-green-500 hover:bg-green-600 text-white h-6 px-7 text-xs leading-6 " type="submit">принять</button>
                  <button  @click="decline" class="rounded-full bg-gray-300 hover:bg-gray-200 h-6 px-7 text-xs leading-6 text-white ">отклонить</button>
                  <button class="rounded-full text-white h-6 px-7 text-xs leading-6 bg-indigo-600 hover:bg-indigo-500" @click="download">скачать</button>
                  <input type="hidden" v-model="form.status" value="в работе" />
                </form>
              </div>
              <hr class="mt-5">
              <div class="flex mt-6 mb-1">
                <div class="bg-red-500 rounded-full w-4 h4"></div>
                <p class="text-gray-600 font-normal ml-3 text-xs">срочно</p>
              </div>
            </div>
        </div>
        

          <div class="mt-10 flex flex-row leading-loose font-medium">Участники
            <img class="h-8 w-8 mr-3 ml-3 border rounded-full" src="/img/user1.webp"/>
            <img class="h-8 w-8 mr-3 border rounded-full relative -left-4" src="/img/default-user.png"/>
          </div>
      </div>


    </div>
    <form v-on:submit.prevent="addMessage" class="w-4/12 bg-white rounded-2xl p-5 mt-5  mh-calc">
    <div class="relative h-full flex flex-col justify-between ">
      <div class="flex flex-row justify-between">
        <p class="font-medium">Комментарии (0)</p>
        <p class="font-medium">Ссылки (0)</p>
        <p class="font-medium">Файлы (0)</p>
      </div>
      <hr class="mt-5">
      <div class="h-80">
        <div v-for="mess in messages">
          <div>{{mess.comment}}</div>
        </div>
      </div>
     
            <div class="relative w-full mt-auto">
              <svg class="absolute right-2 top-2.5 w-5 h-5 fill-current text-indigo-600 cursor-pointer" viewBox="0 0 448.011 448.011"><g><path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
            l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
            l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z"/></g></svg>
              <input class="p-4 h-10 border border-gray-200 rounded-lg w-full" v-model="comment" placeholder="Ваше сообщение...">
            </div>
    </div>
    </form> 
        

      <div class="w-3/12 bg-white rounded-2xl p-5 mt-5   mh-calc">
        <div class="flex flex-row justify-between"><p class="font-medium">Дела</p>
          <div class="flex flex-row gap-2">
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
            <p class="task-button rounded-full text-white w-6 h-6 flex pl-2 items-center text-xs">2</p>
          </div>
        </div>
        <hr class="mt-3">


      
      </div>
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
import axios from "axios";

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
    PersonCard
  },
  layout: Layout,
  props: {
    task: Object,
    user: Array,
    audition: Array,
    messages: Array,
  },
  remember: 'form',
  data() {
    return {
      message: "",
      form: this.$inertia.form({  
        status: this.task.status,
      }),
    }
  },
  methods: {
    addMessage(){
      this.message = "";
      this.form.post(this.route('tasks.message',{
        message:this.message,
        id: this.task.id,
      }));
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
    download(){
      alert("В работе");
    },
    decline(){
      alert("отклонить");
    },
    accept() {
        this.form.status = 'в работе';
        this.form.put(this.route('tasks.accept', this.task.id))
    },
  },
}
</script>
