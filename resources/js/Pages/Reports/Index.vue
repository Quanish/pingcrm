<template>
  <div>
  	<!-- верхняя панель-->
  	<div class="mb-8 flex items-center">
    	<h1 class="font-bold text-2xl w-2/12">Отчеты</h1>
		<div class="w-10/12 flex justify-between">
    	<button class="  rounded-full pl-24 pr-24 text-white h-8 ml-5" v-bind:style="{ backgroundImage: gradient}">новый отчет</button>
    	<div class="w-64 flex justify-start">
    </div>
    </div>
    	<div ><img class="h-10" src="img/message.png"></div>
	</div>

	<!--панель офиса-->
	<div class="flex gap-6">
	<div class="w-2/12 bg-white rounded-2xl  h-auto p-6">
		<div class="relative">
		  <input type="search" class="text-white absolute left-0 w-full shadow rounded-full border-0 p-1 pl-4 pr-8 text-sm font-normal" v-bind:style="{ backgroundColor: color1}" >
		  <div class="absolute right-1 pin-r pin-t mt-2 mr-2 text-purple-lighter">
		  	<svg  class="h-3 text-white fill-current" viewBox="0 0 52.966 52.966">
		    	<path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21
		        c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279
		        C52.074,52.304,52.086,51.671,51.704,51.273z M21.983,40c-10.477,0-19-8.523-19-19s8.523-19,19-19s19,8.523,19,19
		        S32.459,40,21.983,40z"  />
			</svg>
		  </div>
		</div>

		<div class="mt-12 ">

			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">По клиентам</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">По сделкам</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">По проектам</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">По сотрудникам</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">По отделу</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">Избранные</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">Все</p></div>
			<a :href="route('reports.analytics')" class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">Аналитика</p></a>
			
			<div class="flex justify-start gap-4 mt-8 mb-3 w-full">
				<button class="w-full block text-black items-center rounded-full h-8 px-7 text-xs leading-7 bg-gray-200 hover:bg-gray-300">Шаблоны</button>
			</div>
		</div>
		
	</div>
	<!-- список документов-->
	<div class="w-10/12 bg-white rounded-2xl  h-auto p-6">
    	<table class="w-full whitespace-nowrap">
    		<tr class="text-center font-bold">

	            <th class="pb-4 flex">
	            	<p class="font-strong">Название</p>
	            </th>
	           
	             <th class="pb-4">
	            	<p class="font-strong">Дата</p>
	            </th>
	            <th class="pb-4">
	            	<p class="font-strong">Создатель</p>
	            </th>
	            <th class="pb-4">
	            	<p class="font-strong">Примечания</p>
	            </th>
	             <th class="pb-4">
	            	<p class="font-strong"></p>
	            </th>

	          
	        </tr>
	        <tr v-for="report in reports" class="hover:bg-gray-100 focus-within:bg-gray-100 mb-3">
	        	<td class=" flex justify-start items-center">
	       	   		<div>

		       	   		<p>{{report.name}}</p>
		       	   		<p class="text-xs">Краткое описание отчета/ какие показатели </p>
		       	   	</div>
               </td>  
               <td>
               		<p>{{report.date}}</p>
               </td> 
	       	   <td>
	       	   		<div class="bg-gray-100 w-full rounded-full h-8 flex"><img class="h-8 pr-3" :src="'storage/'+report.user.photo_path"><div><p>{{report.user.first_name}}</p><p class="text-xs">должность</p>
	       	   		</div>
	       	   		</div>
	       	   		<td>
	       	   		<person-card src="/img/user1.webp" name="Kuanish Aitimov" job="сотрудник" ></person-card>

	       	   		

               </td>      
              
               
               <td class="text-center">

               		<p>{{report.comment}}</p>
               </td> 
               <td>
               		<button class="rounded-full text-white h-8 pl-3 pr-3 flex" v-bind:style="{ backgroundColor: color1}">
               			<icon name="download" class="w-6 pt-1" />
               			<a :href="'storage/'+report.file" download class="mt-2 ml-2">скачать</a>
               			


               		</button>
               </td> 
               
                   
             
	       	</tr>

   		</table>
   </div>
   </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'
import PersonCard from '@/Shared/PersonCard.vue'


export default {
	metaInfo: { title: 'Отчеты' },
	layout: Layout,
	components: {
	    Icon,
		PersonCard,
		
	  },
	 props:{
	 	reports: Array,
	 },
	data () {
    	return {      	
			color: "#875FDA",
			color1: "#4A32E3",
			angle: '50',
			icon: "download",

		}
  	},
  	created:{
  		do(){
  			alert(SalesChart);
  		}
  	},
  	computed:{
		gradient(){
			return `linear-gradient(${this.angle}deg, ${this.color1}, ${this.color})`;
		}
	}
}
</script>
