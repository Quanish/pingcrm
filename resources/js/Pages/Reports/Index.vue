<template>
  <div class="flex flex-col h-full">
  	<!-- верхняя панель-->
  	<div class="mb-8 flex items-center">
    	<h1 class="font-bold text-2xl w-2/12" @click="$page.props.auth.sidebar = true">Отчеты</h1>
		<div class="w-10/12 flex justify-between">
    	
    	<div class="w-64 flex justify-start">
    </div>


	<div class=" mr-4 ml-4 flex gap-4 items-center">
		<div class="font-medium text-black">По сотрудникам</div>
		<v-select placeholder="tets" class="border-b-2 w-80 pb-1 rounded-full text-white h-8 px-6 text-sm bg-gray-200 " :options="users" v-model="selectedUser" ref="user_id"></v-select>
    </div>

	  
    </div>
    	<div ><img class="h-10" src="img/message.png" @click="$page.props.auth.sidebar = true"></div>
	</div>

	<!--панель офиса-->
	<div class="flex gap-6 flex-auto overflow-y-hidden">
	
		<!-- список документов-->
		<div class="w-full bg-white rounded-2xl  h-full p-6 overflow-y-auto shadow-sm flex flex-col">
			
			<div class="border-1 rounded-lg mb-5 flex flex-col h-full" v-if="show == 1">
					

				<div class="text-black font-medium mb-4">Планы на месяц</div>

				<div class="flex flex-wrap">


					<div class="w-6 md:w-1/2 xl:w-full p-0 flex flex-col gap-4 mb-5 pr-3">
						<div class="w-full md:w-1/2 xl:w-full p-0">
						<!--Metric Card-->
						<div class="bg-white border rounded shadow-ss p-4">
							<div class="flex flex-row items-center">
								<div class="flex-shrink pr-4">
									<div class="rounded p-3 bg-green-600"><i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i></div>
								</div>
								<div>
									<h5 class="font-bold uppercase text-gray-500">Сумма сделок</h5>
								</div>
								<div class="flex-1 text-right md:text-center">
									
									<h3 class="font-bold text-xl">{{ this.sum }} из 5 000 000</h3>
								</div>
								<div>
									<div class="text-3xl font-bold text-indigo-500">
										{{ parseFloat(this.sum / 5000000 * 100).toFixed(0) }}%
									</div>
								</div>
							</div>
						</div>
						<!--/Metric Card-->
					</div>
					
					
					<div class="w-full md:w-1/2 xl:w-full p-0">
						<!--Metric Card-->
						<div class="bg-white border rounded shadow-ss p-4">
							<div class="flex flex-row items-center">
								<div class="flex-shrink pr-4">
									<div class="rounded p-3 bg-yellow-600"><i class="fas fa-user-plus fa-2x fa-fw fa-inverse"></i></div>
								</div>
								<div>
									<h5 class="font-bold uppercase text-gray-500">Количество сделок</h5>	
								</div>
								<div class="flex-1 text-right md:text-center">
									
									<h3 class="font-bold text-xl">{{ this.deals }} из 100</h3>
								</div>
								<div>
									<div class="text-3xl font-bold text-indigo-500">
										{{ parseFloat(this.deals / 100 * 100).toFixed(0) }}%
									</div>
								</div>
							</div>
						</div>
						<!--/Metric Card-->
					</div>
					
					<div class="w-full md:w-1/2 xl:w-full p-0">
						<!--Metric Card-->
						<div class="bg-white border rounded shadow-ss p-4">
							<div class="flex flex-row items-center">
								<div class="flex-shrink pr-4">
									<div class="rounded p-3 bg-indigo-600"><i class="fas fa-tasks fa-2x fa-fw fa-inverse"></i></div>
								</div>
								<div>
									<h5 class="font-bold uppercase text-gray-500">Количество новых клиентов</h5>
								</div>
								<div class="flex-1 text-right md:text-center">
									
									<h3 class="font-bold text-xl">{{ this.organizations }} из 30 </h3>
								</div>
								<div>
									<div class="text-3xl font-bold text-indigo-500">
										{{ parseFloat(this.organizations / 30 * 100).toFixed(0) }}%
									</div>
								</div>
							</div>
						</div>
						<!--/Metric Card-->
					</div>
					</div>
					
					<div class="w-6/12 pl-3 mb-5">
						<!-- <AChart class="w-full" /> -->

					</div>
				</div>
			</div>


			<div class="px-6 flex-auto pb-12 mb-2" v-if="show == 2">
                <template v-if="plans.length > 0">


                    <div class="flex flex-col gap-6 w-full py-4">
                        <div  v-for="plan in plans" :key="plan.id">
                            
                            
                            <div class="flex gap-3 justify-between">
                                <div class="font-medium mb-2">{{ plan.name }}</div>
                                <div class="font-normal">{{ plan.plan }}</div>
                            </div>
                            <div class="shadow w-full bg-grey-light rounded-lg overflow-hidden">
                                <div class="text-xs leading-none py-1 text-center text-white" :class="'bg-' + plantypes[plan.type] + '-500'" :style="'width: ' + plan.fact +'%'"> {{plan.fact}}%</div>
                            </div>


                        </div>
                        
                    </div>


                </template>

                <template v-else>
                    <div class="flex flex-col gap-6 w-full py-4 text-sm">
                        У сотрудника нет установленных планов
                    </div> 
                </template>
            </div>
			
			<div class="border-1 rounded-lg pb-5 flex  flex-auto" v-if="show == 1">	
				
				<!-- <div class="flex justify-between">
					<div>
						Продажи
					</div>
					<div class="flex gap-4">
						<button class="border-1 w-24 border-black rounded-full p-1 ">неделя</button>
						<button class="border-2 w-24 border-black rounded-full p-1">месяц</button>
						<button class="border-2  w-24 border-black rounded-full p-1">квартал</button>
						<button class="border-2  w-24 border-black rounded-full p-1">год</button>
					</div>
					
				</div> -->
			
				<!-- <SalesChart class="flex-auto flex flex-col h-full w-6/12 pr-3"/>
				<ClientChart class="w-6/12 pl-3"/> -->
			</div>




			<div class="border-1 rounded-lg" v-if="show == 1">
				
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
import AChart from '@/Shared/AChart'
import createReport from './Create.vue'
import axios from 'axios'


export default {
	metaInfo: { title: 'Отчеты' },
	layout: Layout,
	components: {
	    Icon,
		PersonCard,
		SalesChart,
		ClientChart,
		AChart,
		createReport
	  },
	 props:{
	 	reports: Array,
	 	deals: Number,
	 	users: Array,
	 	sum: Number,
	 	organizations: Number,
	 },
	 watch: {
        selectedUser: function (user) {
            console.log(user)
			if(user == null) {
				this.show = 1
			} else {
				this.show = 2

				axios.post('/get-plans', {
					id: user.code
				})
				.then(response => {
					this.plans = response.data
				})
			}
			


        }
    },
	data () {
    	return {    
			selectedUser: {},
			show: 1,  	
			plans: [],  	
			color: "#875FDA",
			color1: "#4A32E3",
			angle: '50',
			icon: "download",
			plantypes: {
                1: 'green',
                2: 'skyblue',
                3: 'orange',
                4: 'indigo',
            }
		}
  	},
  	created() {
  		
  	},
	  mounted(){
		
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
