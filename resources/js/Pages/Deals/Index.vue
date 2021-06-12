<template>
  <div class="flex flex-col h-full">
  	<!-- верхняя панель-->
  	<div class=" relative flex justify-between place-items-center mb-10">
    	<h1 class="font-bold text-2xl">Сделки</h1>
		<button class="login_button rounded-full text-white h-8 w-1/5 flex justify-center items-center" @click="openCreateModal">
        <span>Новая&nbsp;сделка</span>
      </button>
    	<!-- <select class="  rounded-full text-white h-8 px-6 text-sm " v-bind:style="{ backgroundColor: color}">
    		<option>цель на квартал</option>
    		<option>цель на неделю</option>
    		<option>цель на месяц</option>
    	</select> -->
    	<div class="w-64 flex justify-start">

    	<!-- <div class="absolute -top-6">
    		<div class="absolute top-7 left-0 bg-gray-300 w-64 h-8 rounded-full">
    			
    		</div>
    		<div class="absolute top-7 left-0 bg-green-500 w-0 rounded-full flex justify-end">
    			<img class="h-8" src="img/user1.webp">
    			
    		</div>
    		<p class="absolute top-2 left-52 w-max   bg-gray-300 text-xs rounded-full px-1">5 000 000</p>
    		<p class="absolute top-16 left-0 w-max bg-green-500 text-white text-xs rounded-full px-1">0</p>
    	</div> -->
    </div>
    	<div ><img class="h-10" src="img/message.png" @click="$page.props.auth.sidebar = true"></div>
	</div>
	<!-- список сделок-->
	<div class="bg-white rounded-2xl  overflow-x-auto flex-auto">
    	<table class="w-full whitespace-nowrap">
    		<tr class="text-left font-bold border-b border-gray-200">

	            <th class="px-6 pt-4 pb-4 flex">
	            	<p class="font-bold">Номер</p>&nbsp;<p class="font-bold">сделки</p>
	            </th>
	            <th class="px-6 pt-4 pb-4">
	            	<p class="font-bold">Сумма</p>
	            </th>
	             <th class="px-6 pt-4 pb-4 pb-4">
	            	<p class="font-bold">Клиент</p>
	            </th>
				<td class="px-6 pt-3 pb-3">
               		<p class="font-bold">Ответственный</p>
               </td> 
	            <th class="px-6 pt-4 pb-4 pb-4">
	            	<p class="font-bold text-center">Статус</p>
	            </th>
	            <th class="px-6 pt-4 pb-4 pb-4">
	            	<p class="font-bold">Примечания</p>
	            </th>

	          
	        </tr>
	        <tr v-for="deal in test" class="hover:bg-gray-100 focus-within:bg-gray-100 mb-3 cursor-pointer" @click="openOrganization(deal.client.id)">
	       	   <td class="px-6 pt-3 pb-3 w-8">
	       	   		<p class="text-sm">№00000{{deal.id}} {{deal.title}}</p>
	       	   		<p class="text-2xs"> номер/ детали/ </p><p class="text-2xs">спецификация</p>
               </td>      
               <td class="px-6 pt-3 pb-3">
               		<p class="text-sm">{{deal.sum}} TG</p>
               </td>   
               <td class="px-6 pt-3 pb-3">
               		<p class="text-sm">{{deal.client.name}}</p>
               </td> 
			   <td class="px-6 pt-3 pb-3">
               		<person-card  v-if="deal.user != undefined" :src="'/storage/' + deal.user.photo_path" :fullname="deal.user.last_name + ' ' + deal.user.first_name" :job="deal.user.position.name"></person-card>
               </td> 
               <td class="px-6 pt-3 pb-3">
               	 <p class="text-sm rounded-full py-1  text-white text-center" :class="'bg-' + statuses[deal.status].color + '-500'">  
						{{ statuses[deal.status].name }}
				  </p>
               </td> 
               <td class="px-6 pt-3 pb-3">
               		<p class="text-sm">{{deal.comment}}</p>
               </td>       
             
	       	</tr>

   		</table>
   </div>


   <modal name="create">
      <create-deal :client="0" to="deal"></create-deal>
    </modal>


  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import createDeal from './Create.vue'
import PersonCard from '../../Shared/PersonCard.vue'
export default {
	metaInfo: { title: 'Сделки' },
	components: {
		createDeal,
PersonCard,
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
      		mytest: 'xxx',
			statuses: {
				0: {
					name: 'Отменена',
					color: 'indigo'
				},
				1: {
					name: 'Закрыта',
					color: 'green'
				},
				2: {
					name: 'Открыта',
					color: 'skyblue'
				},
				3: {
					name: 'Договор',
					color: 'orange'
				},
				4: {
					name: 'Оплата',
					color: 'orange'
				},
				5: {
					name: 'Доставка',
					color: 'orange'
				},
				6: {
					name: 'Обслуживание',
					color: 'orange'
				},

			}  
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
		openOrganization(id) {
			window.location = '/organizations/' + id + '/edit';
		}
	}
}
</script>
