<template>
  <div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full w-full">
    <h1 class="mb-8 font-medium text-xl">
      <p class="text-black hover:text-indigo-600 font-medium">Новое действие</p>
    </h1>
    <div class="bg-white rounded-xl overflow-hidden">
     
        <div class="px-0 py-0  flex flex-wrap">

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
              <p class="font-medium leading-6">Дата</p>  
            </div>
            <div class="lg:w-3/4">
              <datepicker v-model="date"  @selected="CallDateFunction" placeholder="27/05/2021"></datepicker>
            </div>
          </div>
          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Время</p>  
            </div>
            <div class="lg:w-3/4">
              <input type="time" v-model="time">
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

export default {
  metaInfo: { title: 'CreateContact' },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
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

      // axios.post('/add-contact', {
      //   id: this.organization.id,
      //   contact: this.contact
      // })
      // .then(response => {
         
      // })

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
