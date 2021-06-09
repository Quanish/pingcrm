<template>
  <div class="flex flex-col h-full">
    <div class="flex justify-between gap-3 flex-wrap">
      <h1 class="mb-8 font- text-2xl text-black font-medium ">
        Карточка клиента
      </h1>
      <div>

        <button class="text-white hover:bg-indigo-400 mr-2 bg-indigo-500 rounded-lg p-2" @click="update">
          <svg class="fill-current w-4 h-4" viewBox="0 0 512.007 512.007"><g><path d="m511.927 126.537c-.279-2.828-1.38-5.666-3.315-8.027-.747-.913 6.893 6.786-114.006-114.113-2.882-2.882-6.794-4.395-10.612-4.394-9.096 0-329.933 0-338.995 0-24.813 0-45 20.187-45 45v422c0 24.813 20.187 45 45 45h422c24.813 0 45-20.187 45-45 .001-364.186.041-339.316-.072-340.466zm-166.927-96.534v98c0 8.271-6.729 15-15 15h-19v-113zm-64 0v113h-139c-8.271 0-15-6.729-15-15v-98zm64 291h-218v-19c0-8.271 6.729-15 15-15h188c8.271 0 15 6.729 15 15zm-218 161v-131h218v131zm355-15c0 8.271-6.729 15-15 15h-92c0-19.555 0-157.708 0-180 0-24.813-20.187-45-45-45h-188c-24.813 0-45 20.187-45 45v180h-52c-8.271 0-15-6.729-15-15v-422c0-8.271 6.729-15 15-15h52v98c0 24.813 20.187 45 45 45h188c24.813 0 45-20.187 45-45v-98h2.787l104.213 104.214z"/></g></svg>
        </button>

        <button class="text-white hover:bg-red-400  bg-red-500 rounded-lg p-2" @click="destroy">
          <svg class="fill-current w-4 h-4" viewBox="0 0 512 512"><g><path d="m424 64h-88v-16c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16h-88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283c1.221 25.636 22.281 45.717 47.945 45.717h242.976c25.665 0 46.725-20.081 47.945-45.717l13.823-290.283h8.744c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zm-216-16c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zm-128 56c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40c-4.931 0-331.567 0-352 0zm313.469 360.761c-.407 8.545-7.427 15.239-15.981 15.239h-242.976c-8.555 0-15.575-6.694-15.981-15.239l-13.751-288.761h302.44z"/><path d="m256 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/><path d="m336 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/><path d="m176 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/></g></svg>
        </button>
        
      </div>
    </div>
    <div class="flex flex-auto overflow-hidden gap-4">
      <div class="w-4/12  bg-white overflow-y-auto rounded-2xl">
        <div class="bg-white rounded-2xl overflow-hidden p-4">
          <h2 class=" font-medium text mb-8">Основная информация</h2>
        
          <form @submit.prevent="update">
            <div class="flex flex-wrap  text-sm">

              <text-input v-model="form.name" :error="form.errors.name" :col="false" class="pr-6 pb-8 w-full " label="ФИО" />
              <text-input v-model="form.region" :error="form.errors.region" :col="false" class="pr-6 pb-8 w-full " label="Организация" />

              <text-input v-model="form.postal_code" :error="form.errors.postal_code" :col="false" class="pr-6 pb-8 w-full " label="Должность" />
              <text-input v-model="form.email" :error="form.errors.email" :col="false" class="pr-6 pb-8 w-full " label="Почта" />
              <text-input v-model="form.phone" :error="form.errors.phone" :col="false" class="pr-6 pb-8 w-full " label="Контакты" />
              <text-input v-model="form.address" :error="form.errors.address" :col="false" class="pr-6 pb-8 w-full " label="Адрес" />
              <text-input v-model="form.city" :error="form.errors.city" :col="false" class="pr-6  w-full " label="Город" />
            </div>
          </form>
        </div>
      </div>
      <div class="w-8/12 overflow-y-auto flex flex-col gap-4">

        <div class="flex flex-2 gap-4 flex-auto">

          <div class="w-6/12 bg-white overflow-y-auto rounded-2xl p-4">
            <div class="flex justify-between items-center mb-8">
              <h2 class=" font-medium text ">Контакты</h2>
              <button class="text-sm text-skyblue-400 hover: text-skyblue-500">+ Новый контакт</button>
            </div>
          </div>

          <div class="w-6/12 bg-white overflow-y-auto rounded-2xl p-4">
            <div class="flex justify-between items-center mb-8">
              <h2 class=" font-medium text ">Сделки</h2>
              <button class="text-sm text-skyblue-400 hover: text-skyblue-500">+ Новая сделка</button>
            </div>
          </div>

        </div>


        <div class="flex flex-1">
          <div class="w-full bg-white overflow-y-auto rounded-2xl p-4">
            <div class="flex justify-between items-center mb-8">
              <h2 class=" font-medium text ">Комментарии</h2>
            </div>
            <div class="">
              <div v-if="!comments.length">Комментариев пока нет!</div>
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
