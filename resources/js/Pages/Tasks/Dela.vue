<template>
  <div class="py-4 px-4 shadow overflow-y-auto overflow-x-hidden h-full">
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('tasks')">Новое дело</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Создать
    </h1>
    <div class="bg-white rounded-md   max-w-3xl max-h-4x4">
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input class="pr-6 pb-8 w-full lg:w-1/2" v-model="form.title"  label="Название" />
          <select-input class="pr-6 pb-8 w-full lg:w-1/2" v-model="form.user" :error="form.errors.user" label="Ответсвенный" >
                              <option :value="null" />
                              <option v-for='data in select' :key="data.id" :value="data.id">{{ data.first_name }}</option>
          </select-input><br>
          

            <div class="rounded-md border-solid border-2 border-gray-200 pb-4 mb-8 mr-10 lg:w-1/2"><datepicker :value="date" :format="customFormatter" @selected="CallDateFunction"  placeholder="Дедлайн"></datepicker></div>

             
          
          <text-input class="pr-6 pb-8 w-full lg:w-2/2" v-model="form.description"  label="Описание" />
          <select-input class="pr-6 pb-8 w-full lg:w-1/2" v-model="form.audition" :error="form.errors.user" label="Аудитор" >
                              <option :value="null" />
                              <option v-for='data in select' :key="data.id" :value="data.id">{{ data.first_name }}</option>
          </select-input><br>
          <text-input class="pr-6 pb-8 w-full lg:w-2/2" v-model="form.type"  label="Тип" />
          
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">

          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Создать дело</loading-button>
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
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';


export default {
  computedDate () {
    return date.toISOString().substring(0, 10);
  },
  metaInfo: { title: 'Новая Задача' },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    Datepicker,
  },
  layout: Layout,
  props: {
    users: Array,
    select: Array,
  },
  remember: 'form',
  data() {
    return {
      format: "yyyy-MM-dd",
      disabledDates: {},
      date: null,
      disabledFn: {
        customPredictor(date) {
          if (date.getDate() % 3 === 0) {
            return true;
          }
        }
      },
      form: this.$inertia.form({
        user: null,
        deadline: null,
        description: null,
        title: 'дела',
        audition: null,
        type: null,
      }),
    }
  },
  methods: {
    CallDateFunction(date){
      if (date) {
        this.form.deadline = date.toISOString().substring(0, 10);

        const dateString = date.toISOString().substring(0, 10);
        console.log(dateString);
      } else {
        console.log('null date');
      }
    },
    store() {
      this.form.post(this.route('tasks.store'))
    },
    customFormatter(date) {
      return moment(date).format('YYYY-MM-DD, h:mm:ss');
    },
  },
}
</script>
