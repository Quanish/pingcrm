<template>
  <div>
  	<!-- верхняя панель-->
  	<div class="mb-8 flex justify-between items-center">
    	<h1 class="font-bold text-2xl">Отчеты</h1>
    	<button class="  rounded-full pl-24 pr-24 text-white h-8" v-bind:style="{ backgroundImage: gradient}">новый отчет</button>
    	
    	<div class="w-64 flex justify-start">
    </div>
    	<div ><img class="h-10" src="img/message.png"></div>
	</div>

	<!--панель офиса-->
	<div class="flex gap-6">
	<div class="w-2/12 bg-white rounded-md shadow h-auto p-6">
		<div class="relative">
		  <input type="search" class="text-white absolute left-0 w-full shadow rounded-full border-0 p-2" v-bind:style="{ backgroundColor: color1}" >
		  <div class="absolute right-0 pin-r pin-t mt-3 mr-4 text-purple-lighter">
		  	<svg version="1.1" class="h-4 text-white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 52.966 52.966" style="enable-background:new 0 0 52.966 52.966;fill: white;" xml:space="preserve">
		    	<path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21
		        c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279
		        C52.074,52.304,52.086,51.671,51.704,51.273z M21.983,40c-10.477,0-19-8.523-19-19s8.523-19,19-19s19,8.523,19,19
		        S32.459,40,21.983,40z"  />

			</svg>

		  </div>
		</div>

		<div class="mt-12 ml-10">

			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">По клиентам</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">По сделкам</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">По проектам</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">По сотрудникам</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">По отделу</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">Избранные</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><img class="w-4 h-7 -ml-8 pt-3"src="img/icons/Star.png" /><p class="pt-3">Все</p></div>
			<div class="flex h-4 justify-start gap-4 mt-3 text-sm"><p class="pt-3">Аналитика</p></div>
			

		</div>
		<button type="text" class="rounded-full  w-full mt-20 flex justify-center items-center text-white h-8" v-bind:style="{ backgroundImage: gradient}" name="">Шаблоны</button>
	</div>
	<!-- список документов-->
	<div class="w-10/12 bg-white rounded-md shadow h-auto p-6">
    	<table class="w-full whitespace-nowrap">
    		<tr class="text-center font-bold">

	            <th class="px-6 pt-6 pb-4 flex">
	            	<p class="font-strong">Название</p>
	            </th>
	           
	             <th class="px-6 pt-6 pb-4">
	            	<p class="font-strong">Дата</p>
	            </th>
	            <th class="px-6 pt-6 pb-4">
	            	<p class="font-strong">Создатель</p>
	            </th>
	            <th class="px-6 pt-6 pb-4">
	            	<p class="font-strong">Примечания</p>
	            </th>
	             <th class="px-6 pt-6 pb-4">
	            	<p class="font-strong"></p>
	            </th>

	          
	        </tr>
	        <tr v-for="report in reports" class="hover:bg-gray-100 focus-within:bg-gray-100 mb-3">
	        	<td class=" flex justify-start items-center">
	       	   		<img class="w-4 h-4 mr-2"src="img/icons/Star.png" />
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

export default {
	metaInfo: { title: 'Документы' },
	layout: Layout,
	components: {
	    Icon,
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
  	computed:{
		gradient(){
			return `linear-gradient(${this.angle}deg, ${this.color1}, ${this.color})`;
		}
	}
}
</script>
