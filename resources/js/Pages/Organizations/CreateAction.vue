<template>
  <div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full w-full">
    <h1 class="mb-8 font-medium text-xl">
      <p class="text-black hover:text-indigo-600 font-medium">Новое действие</p>
    </h1>
    <div class="bg-white rounded-xl overflow-hidden">
      
      <div class="px-0 py-0  flex flex-wrap">

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
              <p class="font-medium leading-6">Тип</p>  
            </div>
            <div class="lg:w-3/4">
              <div v-if="type == 1">
                Звонок
              </div>
              <div v-if="type == 2">
                Встреча
              </div>
            </div>
          </div>

        </div>

        <div class="px-0 py-0  flex flex-wrap">

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
              <p class="font-medium leading-6">Дата</p>  
            </div>
            <div class="lg:w-3/4 border-b border-gray-200">
              <datepicker style="width: 100%;" v-model="date" type="datetime" placeholder="13-06-2021 15:20"></datepicker>
            </div>
          </div>

        </div>
         <div class="w-full flex">
            <div class="lg:w-1/4">
           
            </div>
            <div class="lg:w-3/4 flex justify-end gap-3 items-center">
              <div class="text-red-500 font-medium">{{ err }}</div>
              <button @click="store" class="ml-3 text-sm leading-8 px-20 login_button rounded-full text-white h-8 w-auto flex justify-center items-center font-light"><span>Создать</span></button>
            </div>  
          </div>

       </div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import Datepicker from 'vue2-datepicker'
import 'vue2-datepicker/index.css'
import axios from 'axios'
import moment from 'moment'


export default {
  metaInfo: { title: 'CreateContact' },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    Datepicker,
  },
  layout: Layout,
  props: ['organization_id', 'type'],
  remember: 'form',
  data() {
    return {
      err: '',
      date: null,
      time: null,
    }
  },
  methods: {
    CallDateFunction(date) {
      if (date) {
        this.form.date = date.toISOString().substring(0, 10)
      }
    },
    
    store() {

      axios.post('/add-action', {
        id: this.organization_id,
        type: this.type,
        date:  moment(this.date).format('YYYY-MM-DD hh:mm:ss'),
      })
      .then(response => {
        this.$notify({
            group: 'foo',
            title: 'Успешно',
            type: 'success',
            duration: 5000,
            text: response.data.msg
        });
        this.$modal.hide('create-action')
      })

      return null;
      this.err = ''
      let count = 0;
      

      if(count == 9) {
        this.err = 'Заполните одно из полей!'
        return null;
      }
      


      this.$modal.hide('create-contact')


      
    },
  },
}
</script>
