<template>
  <div class="bg-white rounded-2xl  overflow-x-auto  pb-0 overflow-y-hidden flex flex-col relative flex-auto">


      <div class="flex justify-between items-center px-6 gap-2 py-4 border-b border-gray-100 ">
          <p class="font-medium text">Дела</p>
          <div class="relative inline-flex">
              <svg class="w-2 h-2 absolute  right-0 m-2  pointer-events-none fill-current text-white" viewBox="0 0 412 232">
                  <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z"  fill-rule="nonzero" />
              </svg>
              <select v-on:change="sortBy($event)" class="text-white bg-blue-500 border border-gray-300 rounded-full text-xs h-6 pl-5 pr-7 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                  <option>по сроку</option>
                  <option>по срочности</option>
                  <option>просроченные</option>
                  <option selected>все время</option>
              </select>
          </div>
          <p class="bg-blue-500 rounded-full text-white w-6 h-6 flex justify-center  items-center text-xs ">{{ items.length }}</p>
      </div>
     
      <div class="overflow-y-auto px-6 flex-auto pb-12 mb-2">
          <div v-for="subtask in items" class="flex justify-start gap-2 ">
              
            <div class="w-full">
             
              <div @click="showDescription(subtask.description, subtask.title, subtask.title, subtask.deadline)" v-if="computeDays(subtask.deadline) <= 1" class="flex justify-between rounded-full bg-red-500">
                <checkbox :label="subtask.title" :value="subtask.title" />
                  <p class="text-xs ml-30 pt-3">{{computeDays(subtask.deadline)}} дн.</p>
                </div>

              <div @click="showDescription(subtask.description, subtask.title, subtask.title, subtask.deadline)" v-else-if="computeDays(subtask.deadline) <= 3" class="flex justify-between rounded-full bg-yellow-500"><checkbox :label="subtask.title" :value="subtask.title" /><p class="text-xs ml-30 pt-3">{{computeDays(subtask.deadline)}} дн.</p></div>

              <div @click="showDescription(subtask.description, subtask.title, subtask.title, subtask.deadline)" v-else class="flex justify-between"><checkbox :label="subtask.title" :value="subtask.title" /><p class="text-xs ml-30 pt-3">{{computeDays(subtask.deadline)}} дн.</p></div>
              <p class="text-xs">Задача: {{subtask.title}}</p>
               
            </div>
          </div>
      </div>


      <div class="flex absolute px-4 w-full bottom-0 bg-gradient-to-b from-transparent to-white">
          <button @click="showCreateSubtaskModal(subtask)" class="my-4  w-full block text-black items-center rounded-full h-8 px-7 text-xs leading-7 bg-gray-200 hover:bg-gray-300">Добавить</button>
      </div>
      




      <modal name="subtask_description" class="p-5">
          <div class="p-5">
              <div class="flex justify-between">
                  <h6 class="flex">{{title}} <p class="text-gray-400 pl-2 pr-2">подзадача к</p> {{tasktitle}}</h6><p>{{deadline}} дн.</p>
              </div>
              <div class="border-2 border-rounded-lg border-color-black h-20 p-3 mt-3 rounded-lg">
                  
                  <p class="text-sm">{{description}}</p>
              </div>
              <checkbox label="отметить как выполнено" />
          </div>
      </modal>

      <modal name="subtask">
        <create-subtask :task_id="task_id"></create-subtask>
      </modal>

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
import createSubtask from './CreateSubtask.vue'
import axios from "axios";

export default {
  name: 'Subtasks',
  metaInfo: { title: 'Дела' },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    Datepicker,
    createSubtask,
    Checkbox
  },
  layout: Layout,
  props: {
    items: Array,
    task_id: {
      type: Number,
      default: 0
    },
  },
  data() {
    return {
      format: 'yyyy-MM-dd',
      tasktitle: '',
      title: '',
      description: '',
      deadline: 0,
      disabledDates: {},
    }
  },
  created() {
    // axios.get('/tasks/create')
    //   .then(response => {
    //     this.users = response.data.users 
    // })
  },
  methods: {
    customFormatter(date) {
      return moment(date).format('YYYY-MM-DD hh:mm:ss')
    },
    sortBy(e) {
      
    },
    computeDays(deadline){
        var difference = Math.abs(new Date(deadline) - Date.now());
        var days = difference/(1000 * 3600 * 24)
        return Math.round(days);
    },
    showDescription(description,title,tasktitle,deadline){
        this.deadline = this.computeDays(deadline);
        this.title = title;
        this.tasktitle = tasktitle;
        this.description = description;
        this.$modal.show('subtask_description');
      },
    showCreateSubtaskModal(){
        this.$modal.show('subtask');
    },
    hideCreateSubtaskModal() {
      this.$modal.hide('subtask');
    }
  },
}
</script>
