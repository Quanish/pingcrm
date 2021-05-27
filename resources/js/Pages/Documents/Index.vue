<template>
  <div>
  	<!-- верхняя панель-->
  	<div class=" relative flex  place-items-center mb-10">
    	<h1 class="font-bold text-2xl w-2/12">Документы</h1>
		<div class="w-10/12 flex justify-between">
			<button class="ml-5  rounded-full pl-24 pr-24 text-white h-8" v-bind:style="{ backgroundImage: gradient}">новый документ</button>
			<div class="w-64 flex justify-start"></div>
    	<div ><img class="h-10" src="/img/message.png"></div>
		</div>
    	
    	
    	
	</div>

	<!--панель офиса-->
	<div class="flex gap-6">
	<div class="w-2/12 bg-white rounded-2xl h-auto p-6">
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

		<div class="mt-20">
			<div class="flex h-6 justify-start gap-4 mt-3"><img class="y-3" src="/img/icons/Word.png" /><p class="pt-1 text-sm">Текстовые</p></div>
			<div class="flex h-6 justify-start gap-4 mt-3"><img class="y-3" src="/img/icons/PPT.png" /><p class="pt-1 text-sm">Презентации</p></div>
			<div class="flex h-6 justify-start gap-4 mt-3"><img class="y-3" src="/img/icons/PDF.png" /><p class="pt-1 text-sm">PDF файлы</p></div>
			<div class="flex h-6 justify-start gap-4 mt-3"><img class="y-3" src="/img/icons/Excel.png" /><p class="pt-1 text-sm">Таблицы</p></div>
			<div class="flex h-6 justify-start gap-4 mt-3"><img class="y-3" src="/img/icons/PIC.png" /><p class="pt-1 text-sm">Изображения</p></div>
			<div class="flex h-6 justify-start gap-4 mt-3"><img class="y-3" src="/img/icons/Star.png" /><p class="pt-1 text-sm">Избранные</p></div>
			<div class="flex h-6 justify-start gap-4 mt-3 text-sm">Все</div>
			<div class="flex h-6 justify-start gap-4 mt-3 mb-3 w-full">
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
	            	<p class="font-strong">Проект или сделка</p>
	            </th>
	             <th class="pb-4">
	            	<p class="font-strong">Дата</p>
	            </th>
	            <th class="pb-4">
	            	<p class="font-strong">Примечания</p>
	            </th>
	            <th class="pb-4">
	            	<p class="font-strong"></p>
	            </th>
	          
	        </tr>
	        <tr class="text-center hover:bg-gray-100 focus-within:bg-gray-100 mb-3">
	        	<td class="">
					<div class="flex">
						<p class="text-sm">Название документа</p>
					</div>
               </td>  
	       	   <td class="w-8">
	       	   		<p class="text-sm">Презентация для клиента</p>
	       	   		
               </td>      
               <td class="">
               		<p class="text-sm">10 / 05 / 2021</p>
               </td> 
               <td class="">
               		<p class="text-sm">Комментарии</p>
               </td> 
               <td class="">
               		<button class="rounded-full text-white h-6 pl-3 pr-3 flex" v-bind:style="{ backgroundColor: color}">
               			<icon name="download" class="w-4 pt-1" />
               			<p class="ml-1 mt-0.5 text-sm">скачать</p>
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
