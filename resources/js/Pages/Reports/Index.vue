<template>
  <div class="flex flex-col h-full">
  	<!-- верхняя панель-->
  	<div class="mb-8 flex items-center">
    	<h1 class="font-bold text-2xl w-2/12">Отчеты</h1>
		<div class="w-10/12 flex justify-between">
    	
    	<div class="w-64 flex justify-start">
    </div>
    </div>
    	<div ><img class="h-10" src="img/message.png"></div>
	</div>

	<!--панель офиса-->
	<div class="flex gap-6 flex-auto overflow-y-hidden">
		<div class="w-2/12 bg-white rounded-2xl  h-auto p-6 overflow-y-auto shadow-sm">
		

			<div class="flex flex-col gap-4">

				<div class="flex h-4 justify-start  font-medium text-sm cursor-pointer hover:text-indigo-500" @click="showPage(1)"><p class="-3">Планы</p></div>
				<div class="flex h-4 justify-start  font-medium text-sm cursor-pointer hover:text-indigo-500" @click="showPage(2)"><p class="-3">По сделкам</p></div>
				<div class="flex h-4 justify-start  font-medium  text-sm cursor-pointer hover:text-indigo-500" @click="showPage(3)" ><p class="">По звонкам</p></div>
				<div class="flex h-4 justify-start font-medium text-sm cursor-pointer hover:text-indigo-500" @click="showPage(4)"><p class="">По встречам</p></div>
				<div class="flex h-4 justify-start font-medium text-sm cursor-pointer hover:text-indigo-500" @click="showPage(5)"><p class="">По отделу</p></div>
				
				
			</div>
			
		</div>
		<!-- список документов-->
		<div class="w-10/12 bg-white rounded-2xl  h-full p-6 overflow-y-auto shadow-sm flex flex-col">
			
			<div class="border-1 rounded-lg mb-5 flex flex-col h-full" v-if="show == 1">
				Планы	
			</div>
			<div class="border-1 rounded-lg mb-5 flex flex-col h-full" v-if="show == 2">	
				
				<div class="flex justify-between">
					<div>
						Продажи
					</div>
					<div class="flex gap-4">
						<button class="border-1 w-24 border-black rounded-full p-1 ">неделя</button>
						<button class="border-2 w-24 border-black rounded-full p-1">месяц</button>
						<button class="border-2  w-24 border-black rounded-full p-1">квартал</button>
						<button class="border-2  w-24 border-black rounded-full p-1">год</button>
					</div>
					
				</div>
			
				<SalesChart class="flex-auto flex flex-col"/>
			</div>




			<div class="border-1 rounded-lg" v-if="show == 3">
				<div class="flex justify-between p-5">Клиенты<button class="border-1 w-24 border-black rounded-full p-1">неделя</button><button class="border-2 w-24 border-black rounded-full p-1">месяц</button><button class="border-2  w-24 border-black rounded-full p-1">квартал</button><button class="border-2  w-24 border-black rounded-full p-1">год</button></div>
				<ClientChart />
			</div>

			<div class="border-1 rounded-lg" v-if="show == 4">
				4
			</div>

			<div class="border-1 rounded-lg" v-if="show == 5">
				5
			</div>
		</div>
   </div>

    <modal name="create">
      <create-report></create-report>
    </modal>

  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'
import PersonCard from '@/Shared/PersonCard.vue'
import SalesChart from '@/Shared/SalesChart'
import ClientChart from '@/Shared/ClientChart'
import createReport from './Create.vue'
export default {
	metaInfo: { title: 'Отчеты' },
	layout: Layout,
	components: {
	    Icon,
		PersonCard,
		SalesChart,
		ClientChart,
		createReport
	  },
	 props:{
	 	reports: Array,
	 },
	data () {
    	return {    
			show: 1,  	
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
	},
	methods: {
			openCreateModal() {
			this.$modal.show('create')
		},
		showPage(k) {
			this.show = k;
		}
	}
}
</script>
