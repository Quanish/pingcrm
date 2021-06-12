<template>
  <div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full w-full">
    <h1 class="mb-8 font-medium text-xl">
      <p class="text-black hover:text-indigo-600 font-medium">Новый клиент</p>
    </h1>
    <div class="bg-white rounded-xl overflow-hidden">
      <form @submit.prevent="store">
        <div class="px-0 py-0  flex flex-wrap">

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Директор
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form.name" :error="form.errors.name" class="border-b-2 w-full pb-1">
            </div> 
          </div>
          


            <div class="w-full flex mb-8">
              <div class="lg:w-1/4">
                <p class="font-medium leading-6">Компания
                  <span class="text-red-400">*</span> 
                </p>  
              </div>
            <div class="lg:w-3/4">
              <input type="text"  v-model="form.region" :error="form.errors.region" class="border-b-2 w-full pb-1">
            </div> 
            </div>

            <div class="w-full flex mb-8">
              <div class="lg:w-1/4">
                <p class="font-medium leading-6">Город
                  <span class="text-red-400">*</span> 
                </p>  
              </div>
            <div class="lg:w-3/4">
              <input type="text"  v-model="form.city" :error="form.errors.city" class="border-b-2 w-full pb-1">
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
  metaInfo: { title: 'Create Organization' },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      err: '',
      form: this.$inertia.form({
        name: null, 
        email: null,
        phone: null,
        address: null,
        city: null,
        region: null,
        country: null,
        postal_code: null,
        responsible: 1
      }),
    }
  },
  methods: {
    store() {
      this.err = ''
      if(this.form.name == null) {
        this.err = 'Заполните директора!'
        return null;
      }
      if(this.form.region == null) {
        this.err = 'Заполните компанию!'
        return null;
      }
      if(this.form.city == null) {
        this.err = 'Заполните город!'
        return null;
      }
      this.form.post(this.route('organizations.store'))
    },
  },
}
</script>
