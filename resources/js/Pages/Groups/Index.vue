<template>
  <div class="flex flex-col h-full">

    <modal name="create">
      <create-group></create-group>
    </modal>


    <div class="flex justify-between">
      <div class="flex flex-row gap-10">
        <h1 class="mb-8 font-bold text-2xl">Группы</h1>
        <button @click="openCreateModal" class="text-sm leading-8 px-20 login_button rounded-full text-white h-8 w-auto flex justify-center items-center font-light">
          <span>Новая &nbsp;группа</span>
        </button>
      </div>
      <img class="h-10" src="/img/message.png" />
    </div>



    <div class="rounded-2xl bg-white w-full  py-4 px-4 flex-auto">
      <div class="flex flex-row  gap-4" v-for="chunk in chunked">
        <div class="mb-4 w-1/3" v-for="article in chunk">
          <div class="border rounded-2xl p-5 pb-3 hover:shadow-md hover:border-blue-400">
            <div class="flex justify-between">
              <div class="flex justify-start gap-3">
                <img src="img/default-user.png" class="w-12 h-12" />
                <div class="flex flex-col text-sm font-medium text-black">
                  {{ article.name }}
                  <p class="text-sm text-black text-2xs font-normal" v-if="article.access == 1">закрытая группа</p>
                  <p class="text-sm text-black text-2xs font-normal" v-if="article.access == 2">открытая группа</p>
                  <p class="text-sm text-black text-2xs font-normal">{{ article.users.length }} участника (-ов)</p>
                </div>
              </div>
              <p v-if="article.id == 1" class="text-sm text-gray-300 text-2xs">admin</p>
            </div>
            <div class="mt-5 flex flex-wrap justify-end gap-3">
              <inertia-link :href="route('groups.show', article.id)" class="bg-blue-400 hover:bg-blue-500 text-white items-center rounded-full h-6 px-7 text-xs leading-6 mb-2 font-normal">Войти  в группу</inertia-link>
            </div>
          </div>
        </div>
      </div>
    </div>



  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import createGroup from './Create.vue'

function chunk(arr, len) {
  const chunks = []
  var i = 0
  const n = arr.length

  while (i < n) {
    chunks.push(arr.slice(i, (i += len)))
  }

  return chunks
}

export default {
  components: {
    TextInput,
    createGroup,
  },
  metaInfo: { title: 'Группы' },
  layout: Layout,
  props: {
    groups: Array,
  },
  data() {
    return {
      modal: false,
      form: this.$inertia.form({
        name: null,
        description: null,
      }),
      quit: {}
    }
  },
  computed: {
    chunked() {
      return chunk(this.groups, 3)
    },
  },
  methods: {
    create() {
      this.modal = false
      this.form.post(this.route('groups.store'))
    },
    openCreateModal() {
      this.$modal.show('create')
    },
    close() {
      this.modal = false
    },
    open() {
      this.modal = true
    },
    quit() {
      sebx
      this.$modal.hide('quit')
    }
  },
}
</script>
