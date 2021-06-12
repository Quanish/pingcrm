<template>
  <div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full w-full">
    <h1 class="mb-8 font-medium text-xl">
      <p class="text-black hover:text-indigo-600 font-medium">Новое действие</p>
    </h1>
    <div class="bg-white rounded-xl overflow-hidden">
      <form @submit.prevent="store">
        <div class="px-0 py-0  flex flex-wrap">

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
              <p class="font-medium leading-6"></p>  
            </div>
            <div class="lg:w-3/4">
              <datepicker v-model="form.date" :format="customFormatter" @selected="CallDateFunction" placeholder="27/05/2021"></datepicker>
            </div>
          </div>
          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Фамилия</p>  
            </div>
            <div class="lg:w-3/4">
              <input type="time" v-model="form.time">
            </div> 
          </div>

       

        </div>
         <div class="w-full flex">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Заполните поле
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4 flex justify-end gap-3 items-center">
              <div class="text-red-500 font-medium">{{ err }}</div>
              <button class="ml-3 text-sm leading-8 px-20 login_button rounded-full text-white h-8 w-auto flex justify-center items-center font-light"><span>Создать</span></button>
            </div>  
          </div>
     
      </form>
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
      form2: this.$inertia.form({
        type: null, 
        date: null, 
        time: null, 
        organization_id: this.organization_id
      }),
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

      this.err = ''
      let count = 0;
      
      if(this.form2.first_name == null) count++
      if(this.form2.last_name == null) count++
      if(this.form2.email == null) count++
      if(this.form2.phone == null) count++
      if(this.form2.address == null) count++
      if(this.form2.city == null) count++
      if(this.form2.region == null) count++
      if(this.form2.country == null) count++
      if(this.form2.postal_code == null) count++

      if(count == 9) {
        this.err = 'Заполните одно из полей!'
        return null;
      }
      
      this.$modal.hide('create-contact')

      this.$inertia.post('/add-contact', this.form2)

      
    },
  },
}
</script>
