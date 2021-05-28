<template>
  <div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full">
    <h1 class="mb-8 font-medium text-xl">
      <inertia-link class="text-black hover:text-indigo-600 font-medium" >Новая группа</inertia-link>
    </h1>
    <div class="bg-white rounded-xl overflow-hidden">
      <form @submit.prevent="store">
        <div class="px-0 py-0  flex flex-wrap">

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Название
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form.group_name"  :error="form.errors.name" class="border-b-2 w-full pb-1">
            </div> 
          </div>

          <div class="w-full flex mb-8">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Описание
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4">
              <input type="text" v-model="form.description" :error="form.errors.name" class="border-b-2 w-full pb-1">
            </div> 
          </div>
        </div>
            
         <div class="w-full flex">
            <div class="lg:w-1/4">
             <p class="font-medium leading-6">Заполните поле
                <span class="text-red-400">*</span> 
              </p>  
            </div>
            <div class="lg:w-3/4 flex justify-end">
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
  metaInfo: { title: 'Создать группу' },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        group_name: null,
        description: null,
      }),
    }
  },
  methods: {
    store() {
      this.form.post(this.route('groups.store'))
    },
  },
}
</script>
