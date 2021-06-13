<template>
  <div class="flex flex-col h-full">
  	<!-- верхняя панель-->
  	<div class="mb-8 flex items-center">
    	<h1 class="font-bold text-2xl w-2/12" @click="$page.props.auth.sidebar = true">Отчеты</h1>
		<div class="w-10/12 flex justify-between">
    	
    	<div class="w-64 flex justify-start">
    </div>
    </div>
    	<div ><img class="h-10" src="img/message.png" @click="$page.props.auth.sidebar = true"></div>
	</div>

	<!--панель офиса-->
	<div class="flex gap-6 flex-auto overflow-y-hidden">
		<div class="w-2/12 bg-white rounded-2xl  h-auto p-6 overflow-y-auto shadow-sm">
		

			<div class="flex flex-col gap-4">

				<div class="flex h-4 justify-start  font-medium text-sm cursor-pointer hover:text-indigo-500" @click="showPage(1)"><p class="-3">Планы</p></div>
				<div class="flex h-4 justify-start  font-medium text-sm cursor-pointer hover:text-indigo-500" @click="showPage(2)"><p class="-3">По сделкам</p></div>
				<div class="flex h-4 justify-start  font-medium  text-sm cursor-pointer hover:text-indigo-500" @click="showPage(3)" ><p class="">По звонкам</p></div>
				<div class="flex h-4 justify-start font-medium text-sm cursor-pointer hover:text-indigo-500" @click="showPage(4)"><p class="">По встречам</p></div>
				
				
			</div>
			
		</div>
		<!-- список документов-->
		<div class="w-10/12 bg-white rounded-2xl  h-full p-6 overflow-y-auto shadow-sm flex flex-col">
			
			<div class="border-1 rounded-lg mb-5 flex flex-col h-full" v-if="show == 1">
					

				<div class="text-black font-medium mb-4">Планы на месяц</div>

				<div class="flex gap-3 flex-wrap flex-col">
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
									
									<h3 class="font-bold text-3xl">{{ this.sum }} из 5 000 000</h3>
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
									
									<h3 class="font-bold text-3xl">{{ this.deals }} из 100</h3>
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
									
									<h3 class="font-bold text-3xl">{{ this.organizations }} из 30 </h3>
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
				<div class="border-2 rounded-lg p-5">Распределение сделок по менеджерам
  			<div class="relative flex justify-end">
  				<canvas class="absolute left-20 top-6" width="300" height="300" id="pie"></canvas>
  				<div class="p-5 grid grid-cols-1 gap-2">
	  				<div v-for="user in users">
	  					<div class="flex">
	  						<div class="rounded-full bg-green-500 h-1 mr-2 p-1"></div><p>{{user.first_name}}</p>
	  					</div>
	  				</div>
  				</div>
  				<div class="p-5 grid grid-cols-1 gap-2">
  					<button class="border-2 w-24 border-black rounded-full p-1">неделя</button><button class="border-2 w-24 border-black rounded-full p-1">месяц</button><button class="border-2  w-24 border-black rounded-full p-1">квартал</button><button class="border-2  w-24 border-black rounded-full p-1">год</button>
  				</div>
  			</div>
  		</div>
  		<div class="flex justify-start gap-2">
  			<div class="border-2 rounded-lg p-5 w-2/3">Рейтинг продаж услуг\товаров
  				<div class="flex justify-end">
  					<div class="p-5">
  						<table>
  							<tr>
  								<td>1&nbsp;&nbsp;</td>
  								<td>Наименование услуги/товара<div class="bg-indigo-500 h-1 w-full"></div></td>
  								
  							</tr>
  							<tr>
  								<td>2&nbsp;&nbsp;</td>
  								<td>Наименование услуги/товара<div class="bg-indigo-500 h-1 w-3/4"></div></td>
  							</tr>
  							<tr>
  								<td>3&nbsp;&nbsp;</td>
  								<td>Наименование услуги/товара<div class="bg-indigo-500 h-1 w-2/4"></div></td>
  							</tr>
  							<tr>
  								<td>4&nbsp;&nbsp;</td>
  								<td>Наименование услуги/товара<div class="bg-indigo-500 h-1 w-1/4"></div></td>
  							</tr>
  						</table>
  					</div>
  					<div class="grid grid-cols-1 gap-2 mt-4">
  						<button class="border-2 w-24 border-black rounded-full p-1">неделя</button>
  						<button class="border-2 w-24 border-black rounded-full p-1">месяц</button>
  						<button class="border-2  w-24 border-black rounded-full p-1">квартал</button>
  						<button class="border-2  w-24 border-black rounded-full p-1">год</button>
  					</div>
  				</div>
  			</div>
  			<div class="border-2 rounded-lg p-5 w-1/3">Выполнение плана ОП
  				<div>
  					<canvas id="myCanvas" width="200" height="200"></canvas>
  				</div>
  			</div>
  		</div>
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
	 	deals: Number,
	 	sum: Number,
	 	organizations: Number,
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
  	created() {
  		
  	},
	  mounted(){
		function degreesToRadians(deg) {
        return (deg/180) * Math.PI;
      }

      function percentToRadians(percentage) {
        // convert the percentage into degrees
        var degrees = percentage * 360 / 100;
        // and so that arc begins at top of circle (not 90 degrees) we add 270 degrees
        return degreesToRadians(degrees + 270);
      }

      function drawPercentageCircle(percentage, radius, canvas) {
      var context = canvas.getContext('2d');

      var x = canvas.width / 2;
      var y = canvas.height / 2;
      var startAngle = percentToRadians(0);
      var endAngle = percentToRadians(percentage);
      // set to true so that we draw the missing percentage
      var counterClockwise = true;

      context.beginPath();
      context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
      context.lineWidth = 15;

      // line color
      context.strokeStyle = 'lightyellow';
      context.stroke();

      // set to false so that we draw the actual percentage
      counterClockwise = false;

      context.beginPath();
      context.arc(x, y, radius, startAngle, endAngle, counterClockwise);
      context.lineWidth = 15;

      // line color
      context.strokeStyle = 'lightblue';
      context.stroke();

      // now draw the inner text
            context.font = radius/2.5 + "px Helvetica";
            context.fillStyle = "lightblue";
            context.textAlign = "center";
            // baseline correction for text
            context.fillText(percentage+"%", x, y*1.05); 
      }
     // implantation happens here 

        var canvas = document.getElementById('myCanvas');
        var percentage = 70;
        var radius;
        if (myCanvas.height < myCanvas.width) {
            radius = myCanvas.height / 3;
        }
        else {
            radius = myCanvas.width / 3;
        }
      drawPercentageCircle(percentage, radius, canvas);


		console.log(document.getElementById("pie"));
		  var canvas = document.getElementById("pie");
		  var ctx = canvas.getContext("2d");

		  
		  var colors = ['#4CAF50', '#00BCD4', '#E91E63', '#FFC107', '#9E9E9E', '#CDDC39', '#18FFFF', '#F44336', '#FFF59D', '#6D4C41'];
		  var angles = [Math.PI * 0.3, Math.PI * 0.7, Math.PI * 0.2, Math.PI * 0.4, Math.PI * 0.4];
		  var offset = 10;
		  var beginAngle = 0;
		  var endAngle = 0;
		  var offsetX, offsetY, medianAngle;
		  
		  for(var i = 0; i < angles.length; i = i + 1) {
		    beginAngle = endAngle;
		    endAngle = endAngle + angles[i];
		    medianAngle = (endAngle + beginAngle) / 2;
		    offsetX = Math.cos(medianAngle) * offset;
		    offsetY = Math.sin(medianAngle) * offset;
		    ctx.beginPath();
		    ctx.fillStyle = colors[i % colors.length];
		    ctx.moveTo(100 + offsetX, 80 + offsetY);
		    ctx.arc(100 + offsetX, 80 + offsetY, 70, beginAngle, endAngle);
		    ctx.lineTo(100 + offsetX, 80 + offsetY);
		    ctx.stroke();
		    ctx.fill();
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
