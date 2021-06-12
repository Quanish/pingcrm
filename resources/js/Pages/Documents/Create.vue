<template>
  <form class="py-6 px-6 bg-white rounded-lg overflow-y-auto overflow-x-hidden h-full">
    <div class="mb-8 font-medium">
      Новый документ
    </div>
    <div class="space-y-4">
      <div class="flex">
        <p class="w-1/6">Название<span class="text-red-400">*</span></p>
        <input type="text" class="flex-auto border-b-2 w-full pb-1">
        <div class="w-6 relative">
            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" class="opacity-0  w-full pb-1">
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
            <div class="lg:w-3/4 flex justify-end">
              
              <button class="ml-3 text-sm leading-8 px-20 login_button rounded-full text-white h-8 w-auto flex justify-center items-center font-light"><span>Создать</span></button>
            </div>  
          </div>
      </div>
    </div>
      
  </form>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import Checkbox from '@/Shared/Checkbox2'
import Datepicker from 'vuejs-datepicker'
import moment from 'moment'
import axios from "axios";

export default {
  computedDate() {
    return date.toISOString().substring(0, 10)
  },
  name: 'CreateDocument',
  metaInfo: { title: 'Новый документ' },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    Datepicker,
    Checkbox
  },
  layout: Layout,
  props: {
    type: String,
  },


  methods: {


    customFormatter(date) {
      return moment(date).format('YYYY-MM-DD hh:mm:ss')
    },
  },
}
</script>
