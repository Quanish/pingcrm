<template>
  <div class="flex flex-col h-full">
    <div class="flex justify-between">
      <div class="flex flex-row gap-10">
        <h1 class="mb-8 font-bold text-2xl">Клиенты</h1>
        <button class="login_button rounded-full text-white text-sm h-8 px-12 flex justify-center items-center" @click="openCreateModal">
          <span>Добавить&nbsp;клиента</span>
        </button>
      </div>
      <div>
        <select class="rounded-full text-white h-8 px-6 text-sm bg-indigo-500 login_button" @change="changeStatus" v-model="select1">
          <option value="0">Все клиенты</option>
          <option value="3">Вероятные</option>
          <option value="2">Постоянные</option>
          <option value="1">Новые</option>
        </select>
      </div>
      <img class="h-10 text-center" src="/img/message.png" @click="$page.props.auth.sidebar = true" />
    </div>

    <div class="bg-white rounded-2xl  overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pt-4 px-6 pb-4 pt-4">Клиент</th>

          <th class="px-6 pb-4 pt-4">Директор</th>

          <th class="px-6 pb-4 pt-4 text-center">Статус</th>

          <th class="px-6 pb-4 pt-4 text-center">Ответственный</th>

          <th class="px-6 pb-4 pt-4 text-center">Примечания</th>
        </tr>


        <tr v-for="organization in clients.data" :key="organization.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t py-3 px-6">
            <inertia-link class="py-1 flex text-sm font-normal text-sm items-center focus:text-indigo-500" :href="route('organizations.edit', organization.id)">
              {{ organization.name }}
              <icon v-if="organization.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>
          <td class="border-t py-3 px-6 ">
            <inertia-link class=" py-1 flex text-sm font-normal items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              {{ organization.region }}
            </inertia-link>
          </td>
          <td class="border-t py-3  items-center"> 
            <div class="flex justify-center">
              <inertia-link class="px-6 py-1  text-sm font-normal items-center leading-4  rounded-full h-6 text-center inline-block" :class="'bg-' + statuses[organization.status].color + '-500'" :href="route('organizations.edit', organization.id)" tabindex="-1">
                {{ statuses[organization.status].name }}
              </inertia-link>
            </div>
            
          </td>
          <td class="border-t py-3 px-6 w-px">

            <inertia-link class=" py-1 flex text-sm font-normal items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div v-if="organization.responsible !== null">
                <person-card class="relative" :src="'/storage/' + organization.responsible.photo_path" :fullname="organization.responsible.name" :job="organization.responsible.position.name" :hide="false"></person-card>
              </div>
              <div v-else class="w-10 h-10">

              </div>
            </inertia-link>


          </td>

          <td class="border-t py-3 px-6 w-px">
            <inertia-link class="px-6 py-1 flex items-center text-sm font-normal" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>нет комментариев</div>
            </inertia-link>
          </td>
        </tr>
        <tr v-if="clients.data.length === 0">
          <td class="border-t py-3 px-6 py-1 text-sm font-normal" colspan="4">Ничего не найдено</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-4 paginate" :links="clients.links" />

    <modal name="create" class="w-full">
      <create-client></create-client>
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
import PersonCard from '@/Shared/PersonCard.vue'
import CreateClient from './Create.vue'
import axios from 'axios'

export default {
  metaInfo: { title: 'Клиенты' },
  components: {
    Icon,
    Pagination,
    SearchFilter,
    CreateClient,
    PersonCard
  },
  layout: Layout,
  props: {
    organizations: Object,
    filters: Object,
  },
  created() {
    this.clients = this.organizations
  },
  data() {
    return {
      clients: [],
      select1: 0,
      agreement: ['не подписан', 'подписан'],
      stage: ['переговоры', 'подписание', 'закрыта'],
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
      statuses: {
          0: {
              name: 'Без статуса',
              color: 'gray'
          },
          1: {
              name: 'Новый',
              color: 'skyblue'
          },
          2: {
              name: 'Постоянный',
              color: 'green'
          },
          3: {
              name: 'Вероятный',
              color: 'orange'
          },
      }
    }
  },

  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    openCreateModal() {
      this.$modal.show('create')
    },
    changeStatus() {
      axios.post('/organizations/status', {
        status: this.select1,
      }).then(response => {
        this.clients = response.data
      })
    }
  },
}
</script>

<style scoped>


</style>
