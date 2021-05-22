<template>
  <div>
  	<!-- верхняя панель-->
  	<div class="flex justify-between place-items-center mb-8">
    	<h1 class="font-bold text-3xl">Сделки</h1>
    	<button class="rounded-full pl-24 pr-24 text-white h-8" v-bind:style="{ backgroundImage: gradient}">новая сделка</button>
    	<select class="rounded-full text-white h-8 pl-2 pr-2 " v-bind:style="{ backgroundColor: color}">
    		<option>цель на квартал</option>
    		<option>цель на неделю</option>
    		<option>цель на месяц</option>
    	</select>
    	<div>
    		<div class="absolute bg-green-500 h-8 pl-24 pr-24 rounded-full"></div>
    	</div>
    	<div>чат</div>
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
	            	<p class="font-normal">Статус</p>
	            </th>
	            <th class="px-6 pt-6 pb-4">
	            	<p class="font-normal">Стадия</p>
	            </th>
	            <th class="px-6 pt-6 pb-4">
	            	<p class="font-normal">Ответственный</p>
	            </th>
	            <th class="px-6 pt-6 pb-4">
	            	<p class="font-normal">Примечания</p>
	            </th>

	          
	        </tr>
	        <tr v-for="task in mytasks" class="hover:bg-gray-100 focus-within:bg-gray-100 mb-3">

	       	   <td class="pl-5" v-if="task.title">
               </td>      
               <td class="pl-5" v-if="task.title">
               </td>   
               <td class="pl-5" v-if="task.title">
               </td> 
               <td class="pl-5" v-if="task.title">
               </td> 
               <td class="pl-5" v-if="task.title">
               </td> 
               <td class="pl-5" v-if="task.title">
               </td> 
               <td class="pl-5" v-if="task.title">
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

	data () {
    	return {      	
			color: "#875FDA",
			color1: "#4A32E3",
			angle: '50',
		}
  	},
  	computed:{
		gradient(){
			return `linear-gradient(${this.angle}deg, ${this.color1}, ${this.color})`;
		}
	}
}
</script>
