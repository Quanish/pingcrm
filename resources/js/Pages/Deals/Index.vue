<template>
  <div>
  	<!-- верхняя панель-->
  	<div class=" relative flex justify-between place-items-center mb-10">
    	<h1 class="font-bold text-3xl">Сделки</h1>
    	<a class="  rounded-full pl-24 pr-24 text-white h-8" v-bind:style="{ backgroundImage: gradient}" :href="route('deals.create')">новая сделка</a>
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
    		<p class="absolute top-0 left-52 w-24   bg-gray-300 text-xs rounded-full p-1">5 000 000</p>
    		<p class="absolute top-16 left-12 w-24  bg-green-500 text-white text-xs rounded-full p-1">3 400 000</p>
    	</div>
    </div>
    	<div ><img class="h-10" src="img/message.png"></div>
	</div>
	<!-- список сделок-->
	<div class="bg-white rounded-md shadow overflow-x-auto">
    	<table class="w-full whitespace-nowrap">
    		<tr class="text-left font-bold">

	            <th class="px-6 pt-6 pb-4 flex">
	            	<p class="font-bold">№</p>&nbsp;<p class="font-normal">сделки</p>
	            </th>
	            <th class="px-6 pt-6 pb-4">
	            	<p class="font-normal">Сумма</p>
	            </th>
	             <th class="px-6 pt-6 pb-4">
	            	<p class="font-normal">Клиент</p>
	            </th>
	            <th class="px-6 pt-6 pb-4">
	            	<p class="font-normal">Контакты</p>
	            </th>
	            <th class="px-6 pt-6 pb-4">
	            	<p class="font-normal">Статус</p>
	            </th>
	            <th class="px-6 pt-6 pb-4">
	            	<p class="font-normal">Стадия</p>
	            </th>
	            <th class="px-6 pt-6 pb-4">
	            	<p class="font-normal">Примечания</p>
	            </th>

	          
	        </tr>
	        <tr v-for="deal in test" class="hover:bg-gray-100 focus-within:bg-gray-100 mb-3">

	       	   <td class="pl-5 w-8">
	       	   		<p>{{deal.deal_number}}</p>
	       	   		<p class="text-xs">Название заказа/ детали/ </p><p class="text-xs">спецификация</p>
               </td>      
               <td class="pl-5">
               		<p>{{deal.price}} tg</p>
               </td>   
               <td class="pl-5">
               		<p>{{deal.client}}</p>
               </td> 
               <td class="pl-5">
               		<p>{{deal.client}}</p>
               </td> 
               <td class="pl-5">
               	{{deal.status}}
               </td> 
               <td class="pl-5">
               		{{deal.stage}}
               </td> 
               <td class="pl-5">
               		<p>{{deal.comment}}</p>
               </td>       
             
	       	</tr>

   		</table>
   </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
	metaInfo: { title: 'Договоры' },
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
	}
}
</script>
