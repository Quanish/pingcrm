<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('tasks')">Задачи</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
        {{ form.first_name }} {{ form.last_name }} 
    </h1>
    <trashed-message v-if="task.deleted_at" class="mb-6" >
      This task has been deleted.
    </trashed-message>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input class="pr-6 pb-8 w-full lg:w-1/2" v-model="form.title" :error="form.errors.title" label="Название" />
          <select-input class="pr-6 pb-8 w-full lg:w-1/2" v-model="form.user" :error="form.errors.user" label="Ответсвенный" >
                              <option :value="null" />
                              <option v-for='data in users' :key="data.id" :value="data.id">{{ data.first_name }}</option>
          </select-input><br>
           <datepicker :value="task.deadline" @selected="CallDateFunction" class="pr-6 pb-8 w-full lg:w-1/2" placeholder="Дедлайн"></datepicker>

          <text-input class="pr-6 pb-8 w-full lg:w-2/2" v-model="form.description"  label="Описание" />
           <select-input class="pr-6 pb-8 w-full lg:w-1/2"  v-model="form.audition" :error="form.errors.user" label="Аудитор" >
                              <option :value="null" />
                              <option v-for='data in users' :key="data.id" :value="data.id">{{ data.first_name }}</option>
          </select-input><br>
        </div>
         <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!task.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Удалить задачу</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Обновить задачу</loading-button>
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
import TrashedMessage from '@/Shared/TrashedMessage'
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';


export default {
  metaInfo() {
    return {
      title: `${this.form.first_name} ${this.form.last_name}`,
    }
  },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
    Datepicker,
  },
  layout: Layout,
  props: {
    task: Object,
    current_user: Object,
    users: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        first_name: this.current_user.first_name,
        last_name: this.current_user.last_name,
        user: this.task.user,
        title: this.task.title,
        audition: this.task.audition,
        description: this.task.description,
        deadline: this.task.deadline,
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
    update() {
      this.form.put(this.route('tasks.update', this.task.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this task?')) {
        this.$inertia.delete(this.route('tasks.destroy', this.task.id))
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this task?')) {
        this.$inertia.put(this.route('tasks.restore', this.task.id))
      }
    },
  },
}
</script>
