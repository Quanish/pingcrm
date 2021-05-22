<template>
  <div>
      <div class="flex justify-between">
  <div class="flex flex-row gap-10">
    <h1 class="mb-8 font-bold text-2xl">Клиенты</h1>
        <inertia-link class="login_button rounded-full text-white h-8 w-auto pl-2 pr-2 flex justify-center items-center" :href="route('organizations.create')">
          <span>Добавить клиента</span>
        </inertia-link>
     </div>

        <img class="h-10" src="img/message.png">
   </div>
    
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Фио\Название</th>

          <th class="px-6 pt-6 pb-4">Контакты</th>

          <th class="px-6 pt-6 pb-4">Статус</th>

          <th class="px-6 pt-6 pb-4">Ответственный</th>

          <th class="px-6 pt-6 pb-4">Стадия</th>

          <th class="px-6 pt-6 pb-4">Договор</th>

          <th class="px-6 pt-6 pb-4">Примечания</th>

        </tr>
        <tr v-for="organization in organizations.data" :key="organization.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('organizations.edit', organization.id)">
              {{ organization.name }}
              <icon v-if="organization.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              {{ organization.phone }}
            </inertia-link>
          </td>
          <td class="border-t items-center">
            <inertia-link class="px-6 py-4 flex items-center bg-gray-300 rounded-full h-10" :href="route('organizations.edit', organization.id)" tabindex="-1">
              {{ status[organization.status] }}

            </inertia-link>
            
          </td>
          <td class="border-t w-px">
          <inertia-link class="px-6 py-4 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div v-for="user in organization.responsible"><div class="flex justify-between gap-2"><img class="h-8" src="img/user1.webp" v-if="user.photo_path">
              <img class="h-8" src="img/default-user.png" v-else>{{user.first_name}}</div></div>
            </inertia-link>
            
          </td>
          <td class="border-t w-px">
          <inertia-link class="px-6 py-4 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>{{stage[organization.stage]}}</div>
            </inertia-link>
            
          </td>
          <td class="border-t w-px">
          <inertia-link class="px-6 py-4 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>{{agreement[organization.agreement]}}</div>
            </inertia-link>
            
          </td>
          <td class="border-t w-px">
          <inertia-link class="px-6 py-4 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>нет комментариев</div>
            </inertia-link>
            
          </td>
        </tr>
        <tr v-if="organizations.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No organizations found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="organizations.links" />
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

export default {
  metaInfo: { title: 'Organizations' },
  components: {
    Icon,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    organizations: Object,
    filters: Object,
  },
  data() {
    return {
      agreement:['не подписан','подписан'],
      stage:['переговоры','подписание','закрыта'],
      status:['новый','текущий','вероятный','постоянный'],
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
  },
}
</script>
