<template>
  <div class="flex flex-col h-full">
  	<!-- верхняя панель-->
  	<div class=" relative flex justify-between place-items-center mb-10">
    	<h1 class="font-bold text-3xl">Сделки</h1>
		<button class="login_button rounded-full text-white h-8 w-1/5 flex justify-center items-center" @click="openCreateModal">
        <span>Новая&nbsp;сделка</span>
      </button>
    	<select class="  rounded-full text-white h-8 pl-2 pr-2 " v-bind:style="{ backgroundColor: color}">
    		<option>цель на квартал</option>
    		<option>цель на неделю</option>
    		<option>цель на месяц</option>
    	</select>
    	<div class="w-64 flex justify-start">

    	<div class="absolute -top-6">
    		<div class="absolute top-7 left-0 bg-gray-300 w-64 h-8 rounded-full">
    			
    		</div>
    		<div class="absolute top-7 left-0 bg-green-500 w-24 rounded-full flex justify-end">
    			<img class="h-8" src="img/user1.webp">
    			
    		</div>
    		<p class="absolute top-0 left-52 w-max   bg-gray-300 text-xs rounded-full px-1">5 000 000</p>
    		<p class="absolute top-16 left-12 w-max bg-green-500 text-white text-xs rounded-full px-1">3 400 000</p>
    	</div>
    </div>
    	<div ><img class="h-10" src="img/message.png"></div>
	</div>
	<!-- список сделок-->
	<div class="bg-white rounded-2xl  overflow-x-auto flex-auto">
    	<table class="w-full whitespace-nowrap">
    		<tr class="text-left font-bold border-b-2 border-gray-100">

	            <th class="px-6 pt-4 pb-4 flex">
	            	<p class="font-bold">Номер</p>&nbsp;<p class="font-bold">сделки</p>
	            </th>
	            <th class="px-6 pt-4 pb-4">
	            	<p class="font-bold">Сумма</p>
	            </th>
	             <th class="px-6 pt-4 pb-4 pb-4">
	            	<p class="font-bold">Клиент</p>
	            </th>
	            <th class="px-6 pt-4 pb-4 pb-4">
	            	<p class="font-bold">Контакты</p>
	            </th>
	            <th class="px-6 pt-4 pb-4 pb-4">
	            	<p class="font-bold">Статус</p>
	            </th>
	            <th class="px-6 pt-4 pb-4 pb-4">
	            	<p class="font-bold">Стадия</p>
	            </th>
	            <th class="px-6 pt-4 pb-4 pb-4">
	            	<p class="font-bold">Примечания</p>
	            </th>

	          
	        </tr>
	        <tr v-for="deal in test" class="hover:bg-gray-100 focus-within:bg-gray-100 mb-3">

	       	   <td class="px-6 pt-6 pb-4 w-8">
	       	   		<p class="text-sm">{{deal.deal_number}}</p>
	       	   		<p class="text-2xs">Название заказа/ детали/ </p><p class="text-xs">спецификация</p>
               </td>      
               <td class="px-6 pt-6 pb-4">
               		<p class="text-sm">{{deal.price}} tg</p>
               </td>   
               <td class="px-6 pt-6 pb-4">
               		<p class="text-sm">{{deal.client}}</p>
               </td> 
               <td class="px-6 pt-6 pb-4">
               		<p class="text-sm">{{deal.client}}</p>
               </td> 
               <td class="px-6 pt-6 pb-4">
               	 <p class="text-sm">{{deal.status}}</p>
               </td> 
               <td class="px-6 pt-6 pb-4">
               		<p class="text-sm">{{deal.stage}}</p>
               </td> 
               <td class="px-6 pt-6 pb-4">
               		<p class="text-sm">{{deal.comment}}</p>
               </td>       
             
	       	</tr>

   		</table>
   </div>


   <modal name="create">
      <create-deal></create-deal>
    </modal>


  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import createDeal from './Create.vue'
export default {
	metaInfo: { title: 'Сделки' },
	components: {
		createDeal,
	},
	layout: Layout,
  props:{
    test: Array,
  },
	data () {
    	return {      	
			color: "#875FDA",
			color1: "#4A32E3",
			angle: '50',
      mytest: 'fuck',
		}
  	},
  	computed:{
		gradient(){
			return `linear-gradient(${this.angle}deg, ${this.color1}, ${this.color})`;
		}
	},
	methods: {
		openCreateModal() {
      this.$modal.show('create')
    },
	}
}
</script>
