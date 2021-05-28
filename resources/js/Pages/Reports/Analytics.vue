<template>
	<div>
		  	Аналитика
  	<div class="grid grid-cols-2 gap-4 bg-white rounded-lg mt-8 p-6">
	  	<div class="border-2 rounded-lg  p-5">	
	  		<div class="flex justify-between">Продажи<button class="border-2 w-24 border-black rounded-full p-1">неделя</button><button class="border-2 w-24 border-black rounded-full p-1">месяц</button><button class="border-2  w-24 border-black rounded-full p-1">квартал</button><button class="border-2  w-24 border-black rounded-full p-1">год</button></div>
	  		<br>
	  		<SalesChart />
	  	</div>
	  	<div class="border-2 rounded-lg">
	  		<div class="flex justify-between p-5">Клиенты<button class="border-2 w-24 border-black rounded-full p-1">неделя</button><button class="border-2 w-24 border-black rounded-full p-1">месяц</button><button class="border-2  w-24 border-black rounded-full p-1">квартал</button><button class="border-2  w-24 border-black rounded-full p-1">год</button></div>
	  		<ClientChart />
  		</div>
  		<div class="border-2 rounded-lg p-5">Распределение сделок по менеджерам
  			<div class="flex justify-between">
  				<div class="rounded-full bg-green-500 w-30 h-30"></div>
  				<div v-for="user in users" class="h-30 overflow-scroll grid grid-cols-1">
  					<div>
  						<div class="rounded-full bg-green-500 h-1 mr-2 p-1"></div><p>{{user.first_name}}</p>
  					</div>
  				</div>
  				<div class="p-5 grid grid-cols-1 gap-2">
  					<button class="border-2 w-24 border-black rounded-full p-1">неделя</button><button class="border-2 w-24 border-black rounded-full p-1">месяц</button><button class="border-2  w-24 border-black rounded-full p-1">квартал</button><button class="border-2  w-24 border-black rounded-full p-1">год</button>
  				</div>
  			</div>
  		</div>
  		<div class="border-2 rounded-lg p-5">Рейтинг продаж услуг\товаров</div>
  	</div>
		
	</div>
</template>
<script>
import SalesChart from '@/Shared/SalesChart'
import ClientChart from '@/Shared/ClientChart'
import Layout from '@/Shared/Layout'


export default{
	layout: Layout,
	components:{
		SalesChart,
		ClientChart,
	},
	props:{
		users:Array
	}
}	

</script>