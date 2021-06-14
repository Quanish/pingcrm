<template>
	<div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full">
		<form @submit.prevent="store">
		<div class="bg-white w-full">
			<div >
				<div class="flex justify-between">
				<h1 class="mb-4 font-medium text-xl">
					<inertia-link class="text-black hover:text-indigo-600 font-medium">Редактировать сделку</inertia-link>
				</h1>
				</div> 
				<div class="flex flex-wrap m8 mb-3 justify-start">

					<div class="w-3/12 space-y-6 mt- py-2">
						<p>Название</p>
					</div>
					<div class="w-9/12 space-y-4 pl-5 py-2">
						<input type="text" class="border-b-2 w-full pb-1"  v-model="deal.name">		
					</div>

					<div class="w-3/12 space-y-6 pt-3 py-2 pr-2">
						<p>Сумма</p>
					</div>
					<div class="w-3/12 space-y-4 pl-5 py-2">
						<input type="number" min="0" class="border-b-2 w-full pb-1" v-model="deal.sum" >	
					</div>
					<div class="w-3/12 space-y-6 pt-3 py-2 pr-2 flex justify-end">
						<p>Тип</p>
					</div>
					<div class="w-3/12 space-y-4 pl-5 py-2">
						<select v-model="deal.type" class="border-b-2 w-full pb-1" >
							<option value="1">Услуга</option>
							<option value="2">Товар</option>
						</select>
					</div>
					<div class="w-3/12 space-y-6 mt- py-2">
						<p>Примечания</p>
					</div>
					<div class="w-9/12 space-y-4 pl-5 py-2">
						<input type="text" class="border-b-2 w-full pb-1" v-model="deal.comment">	
					</div>
					
					
				</div>
			</div>
		</div>
		<div class="w-full flex mt-3 items-center py-2">
            <div class="lg:w-1/4">
				<button class="rounded-full bg-indigo-400 py-1 px-4 hover:bg-indigo-500 duration-300 flex items-center  relative">
					<img class="w-5" src="/images/attach.svg">
					<input type="file" id="file"  @input="form.file = $event.target.files[0]" class="opacity-0  w-full pb-1 h-full opacity-0  w-full pb-1 h-full absolute left-0 top-0">
					<p class="font-normal leading-6 text-black">Прикрепить файл</p>  
				</button>
            </div>
            <div class="lg:w-3/4 flex justify-between items-center">
				<p v-if="form.file !== null">{{ form.file.name }}</p>
				<div class="text-red-500 font-medium mr-3">
                {{ err }}
              </div>
               <label  class="bg-transparent text-blue rounded-lg tracking-wide uppercase">
               
                  <div v-if="file">{{form.file}}</div>
               
                
                
				
              </label>
              <button class="ml-3 text-sm leading-8 px-20 login_button rounded-full text-white h-8 w-auto flex justify-center items-center font-light"><span>Обновить</span></button>
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
	
	props: ['deal'],
	data() {
    return {
    	file: null,
    	name1: this.name,
		err: '',
		clients: [],
		title: '',
        client_id: null,
        sum: 0,
        comment: null,
        type: 1,
      form: this.$inertia.form({
        title: '',
        deal_id: this.deal.id,
        sum: 0,
        comment: null,
        type: 1,
    	file : null,
      }),
    }
  },
  created() {
  	console.log(this.deal);
    axios.get('/deals/create')
      .then(response => {
        this.clients = response.data  
    })
  },
  methods: {
    store() {

		console.log(this.form.file);
		/*
		this.err = '';
		if(this.title === null) {
			this.err = 'Заполните название!'
			return null;
		}
		
		if(this.sum === 0) {
			this.err ='Укажите сумму!'
			return null;
		}

		if(this.client == 0) {
			if(this.client_id === null) {
				this.err ='Выберите клиента!'
				return null;
			}	

			this.form.client_id = this.client_id.id
		} else {
			this.form.client_id = this.client
		}
		*/

		this.form.title = this.deal.name
		this.form.sum = this.deal.sum
		this.form.comment = this.deal.comment
		this.form.type = this.deal.type

		this.$modal.hide('edit-deal')
		this.$modal.hide('edit')
      	this.form.post(this.route('deals.update'))
    },
  },
}

</script>