<template>
  <div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full w-full">
    <h1 class="mb-8 font-medium text-xl">
      <p class="text-black hover:text-indigo-600 font-medium">Новый контакт</p>
    </h1>
    <div class="bg-white rounded-xl overflow-hidden">
      <form @submit.prevent="store">
        <div class="px-0 py-0  flex flex-wrap">

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Имя
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form2.first_name" :error="form2.errors.first_name" class="border-b-2 w-full pb-1">
            </div> 
          </div>
          
          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Фамилия
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form2.last_name" :error="form2.errors.last_name" class="border-b-2 w-full pb-1">
            </div> 
          </div>

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Email
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form2.email" :error="form2.errors.email" class="border-b-2 w-full pb-1">
            </div> 
          </div>

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Телефон
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form2.phone" :error="form2.errors.phone" class="border-b-2 w-full pb-1">
            </div> 
          </div>

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Адрес 
             </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form2.address" :error="form2.errors.address" class="border-b-2 w-full pb-1">
            </div> 
          </div>

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Город
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form2.city" :error="form2.errors.city" class="border-b-2 w-full pb-1">
            </div> 
          </div>

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Регион
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form2.region" :error="form2.errors.region" class="border-b-2 w-full pb-1">
            </div> 
          </div>

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Страна
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form2.country" :error="form2.errors.country" class="border-b-2 w-full pb-1">
            </div> 
          </div>

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Почтовый индекс
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form2.postal_code" :error="form2.errors.postal_code" class="border-b-2 w-full pb-1">
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
  props: ['organization_id'],
  remember: 'form',
  data() {
    return {
      err: '',
      form2: this.$inertia.form({
        first_name: null, 
        last_name: null,
        email: null,
        phone: null,
        address: null,
        city: null,
        region: null,
        country: null,
        postal_code: null,
        organization_id: this.organization_id
      }),
    }
  },
  methods: {
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
