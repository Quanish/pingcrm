<template>
	<div>
  <div class="flex flex-row justify-between">
    <div>
      <h1 class="mb-8 font-bold text-2xl">{{task.title}}</h1>
      <hr class="bg-gray-300 h-1"></hr>
    </div>
    <div class="flex flex-row gap-8">
      <div class="flex flex-col"><p class="mb-5">Статус</p>
        <p class="flex justify-between items-center text-gray-500 w-30 h-6 pl-2 pr-2 bg-gray-100 rounded-full">активные 
                <svg class="w-2 h-2 fill-black md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
                    <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
                  </svg>
              </p>
      </div>
      <div class="items-center"><p class="mb-5">Старт</p>
        {{task.date_created}}
      </div>
      <div class="items-center"><p class="mb-5">Дедлайн</p>
        {{task.deadline}}
      </div>
      <div class="items-center"><p class="mb-5">10 дней</p>
        <p>до дедлайна</p>
      </div>
    </div>
      
      <img class="h-10" src="/img/message.png" />
    </div>
    <div class="flex flex-row gap-5">
    <div class="w-2/5 bg-white rounded-lg p-5 mt-5">
      <div>
        <div class="flex flex-row justify-center gap-40">  <p>Поставщик</p><p>Ответственный</p></div>
        <hr class="mt-5 h-2">
        <div class="flex justify-center gap-40 mt-5">
          <div class="flex flex-row">
            <img class="h-8 w-8 mr-3" src="/img/user1.webp"/><div class="flex flex-col"><p>Kuanish Aitimov</p><p class="text-sm text-gray-400">сотрудник</p></div>
          </div>
          <div class="flex flex-row">
            <img class="h-8 w-8 mr-3" src="/img/default-user.png"/><div class="flex flex-col"><p>John Doe</p><p class="text-sm text-gray-400">менеджер</p></div>
          </div>

          <person-card></person-card>
        </div>
        <div class="border-2 rounded-md mt-5 p-5">
          <p>{{task.description}}</p>
          <div class="flex justify-between mt-5">
            <form @submit.prevent="accept">
              <button class="rounded-full  task-button text-white h-6 px-7 text-xs leading-6" @click="download">скачать</button>
              <button class="rounded-full bg-green-300 text-white h-6 px-7 text-xs leading-6 " type="submit">принять</button>
              <button  @click="decline" class="rounded-full bg-gray-300 h-6 px-7 text-xs leading-6 text-white ">отклонить</button>
              <input type="hidden" v-model="form.status" value="в работе" />
            </form>
          </div>
          <hr class="mt-5">
          <div class="flex flex-row mt-5">
            <div class="bg-red-400 rounded-full w-4 h4"></div>
            <p class="text-gray-300 ml-3">срочно</p>
          </div>
        </div>

          <div class="mt-10 flex flex-row">Участники
            <img class="h-8 w-8 mr-3 ml-3" src="/img/user1.webp"/>
            <img class="h-8 w-8 mr-3" src="/img/default-user.png"/>
          </div>
      </div>


    </div>
    <form v-on:submit.prevent="addMessage" class="w-2/5 bg-white rounded-lg p-5 mt-5">
      <div class="flex flex-row justify-between"><p>Комментарии(0)</p><p>Ссылки(0)</p><p>файлы(0)</p></div>
      <hr class="mt-5">
      <div class="h-60">
        <div v-for="mess in messages">
          <div>{{mess.comment}}</div>
        </div>
      </div>
      <text-input v-model="message"/>
    </form >

      <div class="w-1/5 bg-white rounded-lg p-5 mt-5">
        <div class="flex flex-row justify-between"><p>Дела</p>
          <div class="flex flex-row gap-2">
            <p class="task-button rounded-full text-white h-6 w-auto flex justify-center items-center">сегодня 
              <svg class="w-2 h-2 fill-white md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
                  <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
                </svg>
            </p>
            <p class="task-button rounded-full text-white w-6 h-6 flex pl-2 items-center">2</p>
          </div>
        </div>
      <hr class="mt-5">
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
