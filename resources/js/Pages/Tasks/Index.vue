<template>
  <div class="flex flex-col h-full">
    <div class="flex flex-row justify-between">
      <h1 class="mb-4 font-bold text-2xl">Мои задачи</h1>
      <button class="login_button rounded-full text-white h-8 w-1/5 flex justify-center items-center" @click="openCreateModal">
        <span>Новая&nbsp;задача</span>
      </button>
      <div class="flex flex-row gap-2">

        <!-- <select v-on:change="changeDate($event)" class="login_button rounded-full text-sm text-white h-8 w-auto pr-2 pl-2 flex justify-center items-center bg-indigo-500">
          <option>сегодня</option>
          <option>месяц</option>
          <option>год</option>
          <svg class="w-2 h-2 fill-white md:ml-2" viewBox="0 0 961.243 599.998">
            <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
          </svg>
        </select> -->


        <p class="login_button rounded-full text-white w-8 h-8 flex justify-center items-center text-sm leading-6">{{ tasks.total }}</p>
      </div>
      <!-- <checkbox label="срочно" v-model="checked" @change="check($event)" /> -->
      <img class="h-10" src="img/message.png" @click="$page.props.auth.sidebar = true"/>
    </div>


    <div class="bg-white rounded-2xl  overflow-x-auto flex-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold border-b-2 border-gray-100">
          <th class="px-6 pt-4 pb-4">
            <select v-on:change="changeItem($event)" class="flex justify-between items-center text-black w-30 h-7 pl-2 pr-2 bg-gray-200 rounded-full text-sm font-normal">
              
              <svg class="w-2 h-2 fill-black md:ml-2 relative right-2"  viewBox="0 0 961.243 599.998">
                <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z" />
              </svg>
              <option>активные</option> 
              <option>просроченные</option>
              <option>завершенные</option>
            </select>
          </th>
          <th class="px-6 pt-6 pb-4 text-center">Статус</th>
          <th class="px-6 pt-6 pb-4 text-center">Старт</th>
          <th class="px-6 pt-6 pb-4 text-center">Дедлайн</th>
          <td class="px-6 pt-6 pb-4 pl-0 text-left">Постановщик</td>
          <td class="px-6 pt-6 pb-4 pl-0 text-left">Ответственный</td>  
        </tr>



        <tr v-for="task in tasks.data" class="hover:bg-gray-100 focus-within:bg-gray-100 mb-3">
          <td class="pl-5 pt-3 pb-3" v-if="task.title">
            <inertia-link :href="route('tasks.show', task.id)" class="block font- font-medium">
              {{ task.title }}
              <p class="text-2xs text-gray-400 mb-2 mt-1">{{ Math.round((new Date(task.deadline) - Date.now()) / (1000 * 3600 * 24)) }} дн. до дедлайна</p>

              <div v-if="computeDays(task.deadline) < 0" class="bg-red-500  h-1 w-96 mr-3 rounded-full"></div>
              <div v-else-if="task.status == 3" class="bg-yellow-400 h-1 w-96 mr-3 rounded-full"></div>
              <div v-else-if="task.status == 2" class="bg-green-400  h-1 w-96 mr-3 rounded-full"></div>
              <div v-else-if="task.status == 1" class="bg-gray-400  h-1 w-96 mr-3 rounded-full"></div>
              <div v-else class="bg-green-500  h-1 w-96 mr-3 rounded-full"></div>
            </inertia-link>
          </td>
          <td class="text-center pt-1 pb-1">
            <div class="flex justify-center items-center ">
              <p class="rounded-full text-white text-xs flex px-2 py-1 items-center whitespace-nowrap font-light" :class="'bg-' + statuses[task.status].color + '-500'">{{ statuses[task.status].name }}</p>
            </div>
            
          </td>
          
          <td class="px-6 pt-6 pb-4 text-center">
            <div class="flex flex-col gap-1">
              <div class="text-sm text-gray-500">
                {{ date(task.start) }}
              </div>
              <div class="text-sm text-gray-300">
                {{ hour(task.start) }}  
              </div>  
            </div>
          </td>

          <td class="px-6 pt-6 pb-4 text-center">
            <div class="flex flex-col gap-1">
              <div class="text-sm text-gray-500">
                {{ date(task.deadline) }}
              </div>
              <div class="text-sm text-gray-300">
                {{ hour(task.deadline) }}  
              </div>  
            </div>
          </td>

          <td>
            <person-card class="relative" :src="'/storage/' + task.auditor.photo_path" :fullname="task.auditor.name" :job="task.auditor.position.name" :hide="false"></person-card>
          </td>
          <td>
            <person-card class="relative" :src="'/storage/' + task.user.photo_path" :fullname="task.user.name" :job="task.user.position.name" :hide="false"></person-card>
          </td>
        </tr>




      </table>
    </div>

    <pagination class="mt-4 paginate" :links="tasks.links" />


    <modal name="create">
      <create-task :type="1"></create-task>
    </modal>
  </div>
</template>


<script>
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import createTask from './Create.vue'
import PersonCard from '@/Shared/PersonCard.vue'
import Checkbox from '@/Shared/Checkbox2'
import _ from 'lodash'
import moment from 'moment'

export default {
  metaInfo: { title: 'Задачи' },
  components: {
    Icon,
    Pagination,
    SearchFilter,
    Checkbox,
    createTask,
    PersonCard
  },
  layout: Layout,
  props: {
    tasks: Object,
    filters: Object,
  },
  
  data() {
    return {
      mytasks: [],
      counter: 0,
      checked: false,
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
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
  watch: {
    form: {
      handler: throttle(function () {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('tasks', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
    checked: {}
  },
  created() {
    console.log(this.tasks)
  },
  methods: {
    computeDays(deadline) {
      var difference = new Date(deadline) - Date.now()
      var days = difference / (1000 * 3600 * 24)
      return Math.round(days)
    },
    date(date) {
      return moment(date).format('LL')
    },
    hour(date) {
      return moment(date).format('LT')
    },
    changeDate: function changeDate(date) {
      var today = Date.now()
      switch (String(event.target.value)) {
        case 'сегодня':
          this.mytasks.splice(0)
          this.mytasks = this.tasks.filter((x) => new Date(x.deadline) > today && new Date(x.created_at) < today)
          break
        case 'месяц':
          this.mytasks.splice(0)
          this.mytasks = this.tasks.filter((x) => new Date(x.deadline).getMonth() == today.getMonth() && new Date(x.created_at).getMonth() == today.getMonth())
          break
        case 'год':
          this.mytasks.splice(0)
          this.mytasks = this.tasks.filter((x) => new Date(x.deadline).getFullYear() == today.getFullYear() && new Date(x.created_at).getFullYear() == today.getFullYear())
          break
      }
    },
    changeItem: function changeItem(event) {
      switch (String(event.target.value)) {
        case 'просроченные':
          this.mytasks.splice(0)
          this.mytasks = this.tasks.filter((x) => new Date(x.deadline) < Date.now())
          break
        case 'завершенные':
          this.mytasks.splice(0)
          this.mytasks = this.tasks.filter((x) => x.status == 'завершено')
          break
        case 'активные':
          this.mytasks.splice(0)
          this.mytasks = this.tasks.filter((x) => x.status == 'в работе')
          break
        case 'предстоящие':
          break
        default:
          this.mytasks.splice(0)
          this.mytasks = this.tasks
          break
      }
    },
    check(event) {
      if (this.checked) {
        this.sort()
      } else {
        this.desort()
      }
    },
    openCreateModal() {
      this.$modal.show('create')
    },
    desort() {
      this.mytasks = _.orderBy(this.mytasks, 'created_at')
    },
    sort() {
      this.mytasks = _.orderBy(this.mytasks, 'deadline')
    },
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>

