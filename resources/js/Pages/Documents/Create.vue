<template>
  <form class="py-6 px-6 bg-white rounded-lg overflow-y-auto overflow-x-hidden h-full" @submit.prevent="store">
    <div class="mb-8 font-medium">
      Новый документ
    </div>
    <div class="space-y-4">
      <div class="flex">
        <p class="w-1/6">Название<span class="text-red-400">*</span></p>
        <input type="text" class="flex-auto border-b-2 w-full pb-1" v-model="form.name">
        <div class="w-6 relative">
            <input type="file" id="file"  @input="form.file = $event.target.files[0]" class="opacity-0  w-full pb-1">
            <img src="/img/download.svg" class="absolute right-0 top-0 w-6 h-6 pointer-events-none	" />
        </div>
        

      </div>


      </div>
      <div class="mt-4">
        <div class="w-full flex justify-between">
            <div class="lg:w-1/4"> 
             <p class="font-medium leading-6">Заполните поле
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4 flex justify-end items-center">
              <div class="text-red-500 font-medium mr-3">
                {{ err }}
              </div>
              <button class="ml-3 text-sm leading-8 px-20 login_button rounded-full text-white h-8 w-auto flex justify-center items-center font-light"><span>Создать</span></button>
            </div>  
          </div>
      </div>
    </div>
      
  </form>
</template>

<script>
import moment from 'moment'
import axios from "axios";

export default {
  name: 'CreateDocument',
  metaInfo: { title: 'Новый документ' },
  components: {
    
  },
  props: {},
  remember: 'form',
  data() {
    return {
      err: '',
      name: null,
      file: null,
      disabledDates: {},
      form: this.$inertia.form({
        name: null,
        file: null,
      }),
    }
  },

  methods: {

    store() {
      this.err = '';
      if(this.form.name === null) {
        this.err = 'Заполните название!'
        return null;
      }

      if(this.form.file === null) {
        this.err = 'Выберите файл!'
        return null;
      }

      this.$modal.hide('create')
      this.form.post(this.route('documents.store'))
      
    },
  },
}
</script>
