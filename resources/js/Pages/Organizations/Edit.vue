<template>
  <div class="flex flex-col h-full">
    <div class="">
      <h1 class="mb-8 font-bold text-2xl text-black font-medium ">
        Редактировать клиента
      </h1>
    </div>
    <div class="flex flex-auto overflow-hidden gap-4">
      <div class="w-6/12 pr-3 bg-white overflow-y-auto rounded-2xl">
        <div class="bg-white mh-calc rounded-2xl">
            <div class="bg-white rounded-2xl  overflow-hidden ">
            <form @submit.prevent="update">
              <div class="p-4  flex flex-wrap">

                <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full " label="ФИО" />
                <text-input v-model="form.region" :error="form.errors.region" class="pr-6 pb-8 w-full " label="Организация" />

                <text-input v-model="form.postal_code" :error="form.errors.postal_code" class="pr-6 pb-8 w-full " label="Должность" />
                <text-input v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full " label="Почта" />
                <text-input v-model="form.phone" :error="form.errors.phone" class="pr-6 pb-8 w-full " label="Контакты" />
                <text-input v-model="form.address" :error="form.errors.address" class="pr-6 pb-8 w-full " label="Адрес" />
                <text-input v-model="form.city" :error="form.errors.city" class="pr-6  w-full " label="Город" />
                <!-- <select v-model="form.responsible" :error="form.errors.responsible" class="pr-6 pb-8 w-full " label="Ответственный">
                  
                </select> -->
              </div>
              <div class="p-4 py-4 border-t border-gray-100 flex items-center">
                <loading-button :loading="form.processing" class="btn-indigo  rounded-full  mr-4" type="submit">Изменить</loading-button>
                <loading-button :loading="form.processing" class="btn-indigo bg-red-500 rounded-full" @click="destroy">Удалить организацию</loading-button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="w-6/12 bg-white overflow-y-auto rounded-2xl">
        <div class="  p-4">
              <h2 class=" font-bold text-2xl">Комментарии</h2>
              <div v-if="!comments.length">
                Комментариев пока нет!
              </div>
              <div v-for="comment in comments" class="mt-3">
                <div>{{comment.user.first_name}}</div>
                <div>{{comment.comment}}</div>
              </div>
              <div class="">
                <form @submit.prevent="comment">
                  <!-- <text-input id="message" class="pr-6 pb-8 lg:w-9/12" /> -->
                  <loading-button type="submit" class="btn-indigo rounded-full mt-3">Оставить комментарий</loading-button>
                </form>
              </div>
              
        </div>
      </div>
    </div>
    
   
    

  </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'



export default {
  metaInfo() {
    return { title: this.form.name }
  },
  components: {
    Icon,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    organization: Object,
    comments: Array,
    users: Array,
  },
  data:{
    message:"",
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: this.organization.name,
        email: this.organization.email,
        phone: this.organization.phone,
        address: this.organization.address,
        city: this.organization.city,
        region: this.organization.region,
        country: this.organization.country,
        postal_code: this.organization.postal_code,
        responsible: this.organization.responsible,
      }),
    }
  },
  methods: {
    comment(){
      this.form.post(this.route('organizations.comment',{
        message: message.value.toString(),
        id:this.organization.id
      }))
    },
    update() {
      this.form.put(this.route('organizations.update', this.organization.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this organization?')) {
        this.$inertia.delete(this.route('organizations.destroy', this.organization.id))
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this organization?')) {
        this.$inertia.put(this.route('organizations.restore', this.organization.id))
      }
    },
  },
}
</script>
