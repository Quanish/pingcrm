<template>
	<div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full">
		<form @submit.prevent="store">
		<div class="bg-white w-full">
			<div >
				<div class="flex justify-between">
				<h1 class="mb-4 font-medium text-xl">
					<inertia-link class="text-black hover:text-indigo-600 font-medium">Новая сделка</inertia-link>
				</h1>
					<!-- <div class="flex justify-end gap-3 rounded-full p-3 bg-gray-200 h-10"><p>№</p><p >MT-01234568</p></div> -->
				</div> 
				<div class="flex flex-wrap m8 mb-3 justify-start">

					<div class="w-3/12 space-y-6 mt-3 py-2">
						<p>Название</p>
					</div>
					<div class="w-9/12 space-y-4 pl-5 py-2">
						<input type="text" class="border-b-2 w-full pb-1" v-model="title">		
					</div>
					<div class="w-3/12 space-y-6 mt-3 py-2">
						<p>Клиент</p>
					</div>
					<div class="w-9/12 space-y-4 pl-5 py-2">
						<v-select class="border-b-2 w-full pb-1" label="name" :options="clients" v-model="client_id"></v-select>
					</div>
					<div class="w-3/12 space-y-6 pt-3 py-2 pr-2">
						<p>Сумма</p>
					</div>
					<div class="w-3/12 space-y-4 pl-5 py-2">
						<input type="number" min="0" class="border-b-2 w-full pb-1" v-model="sum">	
					</div>
					<div class="w-3/12 space-y-6 pt-3 py-2 pr-2 flex justify-end">
						<p>Тип</p>
					</div>
					<div class="w-3/12 space-y-4 pl-5 py-2">
						<select v-model="type" class="border-b-2 w-full pb-1">
							<option value="1">Услуга</option>
							<option value="2">Товар</option>
						</select>
					</div>
					<div class="w-3/12 space-y-6 mt-3 py-2">
						<p>Примечания</p>
					</div>
					<div class="w-9/12 space-y-4 pl-5 py-2">
						<input type="text" class="border-b-2 w-full pb-1" v-model="comment">	
					</div>
					
					
				</div>
			</div>
		</div>
		<div class="w-full flex mt-3 ">
            <div class="lg:w-1/4">
             <!-- <p class="font-medium leading-6">Заполните поле
                <span class="text-red-400">*</span> 
              </p>   -->
            </div>
            <div class="lg:w-3/4 flex justify-end items-center">
				<div class="text-red-500 font-medium mr-3">
                {{ err }}
              </div>
              <button class="ml-3 text-sm leading-8 px-20 login_button rounded-full text-white h-8 w-auto flex justify-center items-center font-light"><span>Создать</span></button>
            </div>  
          </div> 
		 </form>
	</div>
</template>
<script type="text/javascript">
import Layout from '@/Shared/Layout'
import axios from "axios";

export default {
	metaInfo: { title: 'Сделки' },
	layout: Layout,
	data() {
    return {
		err: '',
		clients: [],
		title: '',
        client_id: null,
        sum: 0,
        comment: null,
        type: 1,
      form: this.$inertia.form({
        title: '',
        client_id: null,
        sum: 0,
        comment: null,
        type: 1,
      }),
    }
  },
  created() {
    axios.get('/deals/create')
      .then(response => {
        this.clients = response.data  
    })
  },
  methods: {
    store() {
		
		
		this.err = '';
		if(this.title === null) {
			this.err = 'Заполните название!'
			return null;
		}
		
		if(this.sum === 0) {
			this.err ='Укажите сумму!'
			return null;
		}

		this.form.title = this.title
		this.form.client_id = this.client_id
		this.form.sum = this.sum
		this.form.comment = this.comment
		this.form.type = this.type


      this.form.post(this.route('deals.store'))
    },
  },
}

</script>