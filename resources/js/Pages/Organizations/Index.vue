<template>
  <div class="flex flex-col h-full">
    <div class="flex justify-between">
      <div class="flex flex-row gap-10">
        <h1 class="mb-8 font-bold text-2xl">Клиенты</h1>
        <button class="login_button rounded-full text-white text-sm h-8 px-12 flex justify-center items-center" @click="openCreateModal">
          <span>Добавить&nbsp;клиента</span>
        </button>
      </div>

      <img class="h-6 text-center" src="img/message.png" />
    </div>

    <div class="bg-white rounded-2xl  overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pt-4 px-6 pb-4 pt-4">Фио\Название</th>

          <th class="px-6 pb-4 pt-4">Контакты</th>

          <th class="px-6 pb-4 pt-4 text-center">Статус</th>

          <th class="px-6 pb-4 pt-4 text-center">Ответственный</th>

          <th class="px-6 pb-4 pt-4 text-center">Стадия</th>

          <th class="px-6 pb-4 pt-4 text-center">Договор</th>

          <th class="px-6 pb-4 pt-4 text-center">Примечания</th>
        </tr>
        <tr v-for="organization in organizations.data" :key="organization.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t py-3 px-6">
            <inertia-link class="py-1 flex items-center focus:text-indigo-500" :href="route('organizations.edit', organization.id)">
              {{ organization.name }}
              <icon v-if="organization.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>
          <td class="border-t py-3 px-6 ">
            <inertia-link class=" py-1 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              {{ organization.phone }}
            </inertia-link>
          </td>
          <td class="border-t py-3  items-center"> 
            <div class="flex justify-center">
              <inertia-link class="px-6 py-1  items-center leading-4 bg-gray-300 rounded-full h-6 text-center inline-block" :href="route('organizations.edit', organization.id)" tabindex="-1">
                {{ status[organization.status] }}
              </inertia-link>
            </div>
            
          </td>
          <td class="border-t py-3 px-6 w-px">
            <inertia-link class=" py-1 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>
                <person-card src="/img/user1.webp" name="John Doe" job="сотрудник"></person-card> 
              </div>
            </inertia-link>
          </td>
          <td class="border-t py-3 px-6 w-px">
            <inertia-link class="px-6 py-1 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>{{ stage[organization.stage] }}</div>
            </inertia-link>
          </td>
          <td class="border-t py-3 px-6 w-px">
            <inertia-link class="px-6 py-1 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>{{ agreement[organization.agreement] }}</div>
            </inertia-link>
          </td>
          <td class="border-t py-3 px-6 w-px">
            <inertia-link class="px-6 py-1 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>нет комментариев</div>
            </inertia-link>
          </td>
        </tr>
        <tr v-if="organizations.data.length === 0">
          <td class="border-t py-3 px-6 py-1" colspan="4">No organizations found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-4 paginate" :links="organizations.links" />

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

export default {
  metaInfo: { title: 'Organizations' },
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
  data() {
    return {
      agreement: ['не подписан', 'подписан'],
      stage: ['переговоры', 'подписание', 'закрыта'],
      status: ['новый', 'текущий', 'вероятный', 'постоянный'],
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },

  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    openCreateModal() {
      this.$modal.show('create')
    },
  },
}
</script>

<style scoped>

td div {
  font-size: 0.8em;
}
</style>
