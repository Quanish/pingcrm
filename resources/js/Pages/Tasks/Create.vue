<template>
  <div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full">
    <h1 class="mb-8 font-medium text-xl">
      Новая задача
    </h1>
    <div class="ma">
      <form @submit.prevent="store">
        <div class="mt-4 flex flex-wrap">

          <div class="w-full flex mb-8">
           
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Название
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form.title" ref="title" class="border-b-2 w-full pb-1">
            </div>  
          </div>
          
          <div class="w-full flex mb-8">
           
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Описание
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form.description" ref="description" class="border-b-2 w-full pb-1">
            </div>  
          </div>


           <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Ответственный
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4">


              <v-select class="border-b-2 w-full pb-1"  :options="users" v-model="selectedUser" ref="user_id"></v-select>


            </div>  
          </div>

          
          <div class="w-full flex mb-8">
            
            <div class="lg:w-1/4">
              <p class="font-medium leading-6">Дедлайн
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4">
              <div class="border-b-2 w-full pb-1">
                
                <datepicker style="width: 100%;" v-model="form.deadline" type="datetime" placeholder="27/05/2021"></datepicker>
              </div>
            </div>  
          </div>

          <div class="w-full flex mb-8 items-center">
            <div class="lg:w-1/4">
              <button class="rounded-full bg-indigo-400 py-1 px-4 hover:bg-indigo-500 duration-300 flex items-center  relative">
                <img class="w-5" src="/images/attach.svg">
                <input type="file" id="file"  @input="form.file = $event.target.files[0]" class="opacity-0  w-full pb-1 h-full opacity-0  w-full pb-1 h-full absolute left-0 top-0">
                <p class="font-normal leading-6 text-black">Прикрепить файл</p>  
              </button>
            </div>  
            <div class="lg:w-3/4">
                <p v-if="form.file !== null">{{ form.file.name }}</p>
            </div>  
          </div>

          <div class="w-full flex">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Заполните поле
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4 flex justify-end items-center">
              <div class="text-red-500 font-medium mr-3">
                {{ err }}
              </div>
              <checkbox label="срочно" v-model="form.urgent" />
              <button class="ml-3 text-sm leading-8 px-20 login_button rounded-full text-white h-8 w-auto flex justify-center items-center font-light"><span>Создать</span></button>
            </div>  
          </div> 
          <input type="hidden" name="type" :value="type">
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import Checkbox from '@/Shared/Checkbox2'
import Datepicker from 'vue2-datepicker'
import 'vue2-datepicker/index.css'
import moment from 'moment'
import axios from "axios";

export default {
  computedDate() {
    return date.toISOString().substring(0, 10)
  },
  name: 'CreateTask',
  metaInfo: { title: 'Новая Задача' },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    Datepicker,
    Checkbox
  },
  layout: Layout,
  props: {
    type: Number,
  },
  remember: 'form',
  data() {
    return {
      file: null,
      format: 'yyyy-MM-dd',
      disabledDates: {},
      date: null,
      err: '',
      disabledFn: {
        customPredictor(date) {
          if (date.getDate() % 3 === 0) {
            return true
          }
        },
      },
      selectedUser: {},
      users: [],
      form: this.$inertia.form({
        user_id: null,
        deadline: moment().format('YYYY-MM-DD hh:mm:ss'),
        description: null,
        title: null,
        type: null,
        urgent: false,
        file: null,
      }),
    }
  },
  created() {
    axios.get('/tasks/create')
      .then(response => {
        this.users = response.data.users 
    })
  },
  methods: {
     upload(event) {
      this.file = event.target.files[0]; 
      console.log(this.file.name);
    },
    CallDateFunction(date) {
      if (date) {
        this.form.deadline = date.toISOString().substring(0, 10)

        const dateString = date.toISOString().substring(0, 10)
        console.log(dateString)
      } else {
        console.log('null date')
      }
    },
    store() {
      this.err = '';
      if(this.form.title === null) {
        this.$refs.title.focus();
        this.err = 'Заполните название!'
        return null;
      }
      if(this.form.description === null) {
        this.$refs.description.focus();
        this.err = 'Заполните описание!'
        return null;
      }
      if(this.selectedUser.code === undefined) {
        this.err ='Выберите ответственного!'
        return null;
      }


      this.form.type = this.type
      this.form.user_id = this.selectedUser.code
      this.form.deadline = moment(this.form.deadline).format('YYYY-MM-DD hh:mm:ss')
      this.form.post(this.route('tasks.store'))
    },
    customFormatter(date) {
      return moment(date).format('YYYY-MM-DD hh:mm:ss')
    },
  },
}
</script>
