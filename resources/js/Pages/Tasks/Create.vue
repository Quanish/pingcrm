<template>
  <div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full">
    <h1 class="mb-8 font-medium text-xl">
      <inertia-link class="text-black hover:text-indigo-600 " :href="route('tasks')">Новая задача</inertia-link>
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
              <input type="text" v-model="form.title" class="border-b-2 w-full pb-1">
            </div>  
          </div>
          
          <div class="w-full flex mb-8">
           
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Описание
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form.description" class="border-b-2 w-full pb-1">
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
                <datepicker v-model="form.deadline" :format="customFormatter" @selected="CallDateFunction" placeholder="27/05/2021"></datepicker>
              </div>
            </div>  
          </div>

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Ответственный
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4">
              <select class="border-b-2 w-full pb-1" v-model="form.user">
                <option :value="null" />
                <option v-for="data in users" :key="data.id" :value="data.id">{{ data.last_name }} {{ data.first_name }}</option>
              </select>
            </div>  
          </div>

          <!-- <select-input class="pr-6 pb-8 w-full lg:w-1/2" v-model="form.audition" :error="form.errors.user" label="Аудитор">
            <option :value="null" />
            <option v-for="data in select" :key="data.id" :value="data.id">{{ data.first_name }}</option> </select-input
          > -->
          <div class="w-full flex">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Заполните поле
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4 flex justify-end">
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
import Datepicker from 'vuejs-datepicker'
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
    type: String,
  },
  remember: 'form',
  data() {
    return {
      format: 'yyyy-MM-dd',
      disabledDates: {},
      date: null,
      disabledFn: {
        customPredictor(date) {
          if (date.getDate() % 3 === 0) {
            return true
          }
        },
      },
      users: [],
      form: this.$inertia.form({
        user_id: 1,
        deadline: moment().format('YYYY-MM-DD hh:mm:ss'),
        description: null,
        title: null,
        auditor_id: 1,
        type: null,
        urgent: false,
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
     this.form.type = this.type
     this.form.deadline = moment(this.form.deadline).format('YYYY-MM-DD hh:mm:ss')
      this.form.post(this.route('tasks.store'))
    },
    customFormatter(date) {
      return moment(date).format('YYYY-MM-DD hh:mm:ss')
    },
  },
}
</script>
