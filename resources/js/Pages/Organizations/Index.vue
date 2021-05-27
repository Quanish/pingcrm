<template>
  <div>
    <div class="flex justify-between">
      <div class="flex flex-row gap-10">
        <h1 class="mb-8 font-bold text-2xl">Клиенты</h1>
        <button class="login_button rounded-full text-white text-sm h-8 px-12 flex justify-center items-center" @click="openCreateModal">
          <span>Добавить&nbsp;клиента</span>
        </button>
      </div>

      <img class="h-6 text-center" src="img/message.png" />
    </div>

    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pt-4 px-6 pb-4 pt-4">Фио\Название</th>

          <th class="px-6 pb-4 pt-4">Контакты</th>

          <th class="px-6 pb-4 pt-4">Статус</th>

          <th class="px-6 pb-4 pt-4">Ответственный</th>

          <th class="px-6 pb-4 pt-4">Стадия</th>

          <th class="px-6 pb-4 pt-4">Договор</th>

          <th class="px-6 pb-4 pt-4">Примечания</th>
        </tr>
        <tr v-for="organization in organizations.data" :key="organization.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t py-1">
            <inertia-link class="px-6 py-1 flex items-center focus:text-indigo-500" :href="route('organizations.edit', organization.id)">
              {{ organization.name }}
              <icon v-if="organization.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>
          <td class="border-t py-1">
            <inertia-link class="px-6 py-1 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              {{ organization.phone }}
            </inertia-link>
          </td>
          <td class="border-t py-1 items-center">
            <inertia-link class="px-6 py-1 flex items-center bg-gray-300 rounded-full h-6 text-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              {{ status[organization.status] }}
            </inertia-link>
          </td>
          <td class="border-t py-1 w-px">
            <inertia-link class="px-6 py-1 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div v-for="user in organization.responsible">
                <div class="flex justify-between gap-2"><img class="h-8" src="img/user1.webp" v-if="user.photo_path" /> <img class="h-8" src="img/default-user.png" v-else />{{ user.first_name }}</div>
              </div>
            </inertia-link>
          </td>
          <td class="border-t py-1 w-px">
            <inertia-link class="px-6 py-1 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>{{ stage[organization.stage] }}</div>
            </inertia-link>
          </td>
          <td class="border-t py-1 w-px">
            <inertia-link class="px-6 py-1 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>{{ agreement[organization.agreement] }}</div>
            </inertia-link>
          </td>
          <td class="border-t py-1 w-px">
            <inertia-link class="px-6 py-1 flex items-center" :href="route('organizations.edit', organization.id)" tabindex="-1">
              <div>нет комментариев</div>
            </inertia-link>
          </td>
        </tr>
        <tr v-if="organizations.data.length === 0">
          <td class="border-t py-1 px-6 py-1" colspan="4">No organizations found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="organizations.links" />

    <modal name="create">
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
import CreateClient from './Create.vue'

export default {
  metaInfo: { title: 'Organizations' },
  components: {
    Icon,
    Pagination,
    SearchFilter,
    CreateClient,
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
