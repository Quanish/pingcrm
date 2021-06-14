<template>
  <div class="flex flex-col h-full">
    <div class="flex justify-between gap-3 flex-wrap items-start">
        <h1 class="mb-8 font- text-2xl text-black font-medium w-3/12">
          Карточка клиента
        </h1>

      
        <div class="flex-auto justify-between flex gap-4 items-start">
            
          <div class="flex gap-4 items-center">
            <div class="font-medium text-black">Добавить</div>
            <button @click="showCreateActionModal(1)" class="text-white hover:text-black rounded-full px-4 p-1 text-sm flex justify-center items-center font-medium duration-300 bg-skyblue-600 hover:bg-skyblue-500">
              <span>+ звонок</span>
            </button>

            <button @click="showCreateActionModal(2)" class="text-white hover:text-black rounded-full px-4 p-1 text-sm flex justify-center items-center font-medium duration-300 bg-skyblue-600 hover:bg-skyblue-500">
              <span>+ встреча</span>
            </button>
          </div>
          

          <img class="h-10" src="/img/message.png" @click="$page.props.auth.sidebar = true"/>
        </div>

    </div>
    <div class="flex flex-auto overflow-hidden gap-4">
      <div class="w-3/12  bg-white overflow-y-auto rounded-2xl">
        <div class="bg-white rounded-2xl overflow-hidden p-4">
          <h2 class=" font-medium text mb-8 pb-4 border-b border-gray-300" >Основная информация</h2>
   
            <div class="flex flex-wrap  text-sm">

              <text-input v-model="form.name" :col="false" class="w-full mb-5" label="Компания" />
              <text-input v-model="form.ceo"  :col="false" class="w-full " label="Директор" />
              
              <div class="my-2 w-full">
                <p class="font-medium mb-2">Статус</p>
                <select class="font-medium text-sm rounded-full px-3  py-1.5 " :class="'bg-' + statuses[form.status].color + '-500 text-' + statuses[form.status].color +'-700'" @change="changeStatus" v-model="form.status">
                  <option value="0">Без статуса</option>
                  <option value="3">Отменена</option>
                  <option value="2">Закрыта</option>
                  <option value="1">Новые</option>
                </select>
              </div>
               

              <div class="mt-3 flex flex-col gap-3" v-if="responsible">
                <p class="text-black font-medium">Создал карточку:</p>
                <person-card  :id="responsible.id" :src="'/storage/' + responsible.photo_path" :fullname="responsible.last_name + ' ' + responsible.first_name" :job="responsible.position.name"></person-card>
              </div>

              <div class="w-full mt-4 flex justify-start" v-if="$page.props.auth.user.id == responsible.id">
                <button class="text-white login_button mr-2  rounded-full px-4 p-1 flex gap-3 duration-300 hover:h-2 " @click="update">
                <span class="text-sm">Сохранить</span>
                <svg class="fill-current w-4 h-4" viewBox="0 0 512.007 512.007"><g><path d="m511.927 126.537c-.279-2.828-1.38-5.666-3.315-8.027-.747-.913 6.893 6.786-114.006-114.113-2.882-2.882-6.794-4.395-10.612-4.394-9.096 0-329.933 0-338.995 0-24.813 0-45 20.187-45 45v422c0 24.813 20.187 45 45 45h422c24.813 0 45-20.187 45-45 .001-364.186.041-339.316-.072-340.466zm-166.927-96.534v98c0 8.271-6.729 15-15 15h-19v-113zm-64 0v113h-139c-8.271 0-15-6.729-15-15v-98zm64 291h-218v-19c0-8.271 6.729-15 15-15h188c8.271 0 15 6.729 15 15zm-218 161v-131h218v131zm355-15c0 8.271-6.729 15-15 15h-92c0-19.555 0-157.708 0-180 0-24.813-20.187-45-45-45h-188c-24.813 0-45 20.187-45 45v180h-52c-8.271 0-15-6.729-15-15v-422c0-8.271 6.729-15 15-15h52v98c0 24.813 20.187 45 45 45h188c24.813 0 45-20.187 45-45v-98h2.787l104.213 104.214z"/></g></svg>
              </button>
              </div>
               
            </div>
          
        </div>
      </div>
      <div class="w-9/12 overflow-y-hidden flex flex-col gap-4">

        <div class="flex flex-col gap-4 h-full bg-white  rounded-2xl p-4">
          <div class="flex gap-5 flex-wrap pb-4 border-b border-gray-300 justify-between">
            <div class="flex gap-5 flex-wrap">
              <div class=" font-medium text text-black hover:text-indigo-500 cursor-pointer" :class="{'text-indigo-400' : tab == 1}" @click="showTab(1)">Контакты ({{ organization.contacts.length }})</div>
              <div class=" font-medium text text-black hover:text-indigo-500 cursor-pointer" :class="{'text-indigo-400' : tab == 2}"  @click="showTab(2)" >Сделки ({{ organization.deals.length }})</div>
              <div class=" font-medium text text-black hover:text-indigo-500 cursor-pointer" :class="{'text-indigo-400' : tab == 3}" @click="showTab(3)">История</div>  
            </div>
            <div>
              <div class="text-sm text-skyblue-500 cursor-pointer hover:text-skyblue-400" v-show="tab == 1" @click="showCreateContactModal">+ Новый контакт</div>
              <div class="text-sm text-skyblue-500 cursor-pointer hover:text-skyblue-400" v-show="tab == 2" @click="showCreateDealModal">+ Новая сделка</div>
              <!-- <div class="text-sm text-skyblue-500 cursor-pointer hover:text-skyblue-400" v-show="tab == 3" @click="null">+ Новое действие</div> -->
            </div>
          </div>
          <div class="overflow-y-auto">  
            <div v-show="tab == 1">
              <!--  -->

                <div class="xxxxxx1">
                  <div class="flex flex-col gap-4">
                    <div v-for="cont in organization.contacts" class="border border-skyblue-100 rounded-xl p-4 flex flex-col gap-3 bg-skyblue-100" :key="cont.id">

                      <div class="flex flex-col gap-0 mb-2">
                        <div class="text-sm font-medium text-indigo-500">ID Контакта #{{ cont.id }}</div>
                      </div>

                      <div class="flex flex-row gap-3 justify-between" v-if="cont.first_name !== undefined || cont.last_name !== undefined">
                        <div class="text-sm font-medium text-gray-500">Контактное лицо</div>
                        <div class="text-sm font-normal text-black text-right">{{ cont.last_name + ' ' + cont.first_name }}</div>
                      </div>

                      <div class="flex flex-row gap-3 justify-between" v-if="cont.phone != undefined">
                        <div class="text-sm font-medium text-gray-500">Телефон</div>
                        <div class="text-sm font-normal text-black text-right">{{ cont.phone }}</div>
                      </div>

                      <div class="flex flex-row gap-3 justify-between" v-if="cont.email != undefined">
                        <div class="text-sm font-medium text-gray-500">Email</div>
                        <div class="text-sm font-normal text-black text-right">{{ cont.email }}</div>
                      </div>

                      <div class="flex flex-row gap-3 justify-between" v-if="cont.address != undefined">
                        <div class="text-sm font-medium text-gray-500">Адрес</div>
                        <div class="text-sm font-normal text-black text-right">{{ cont.address }}</div>
                      </div>

                      <div class="flex flex-row gap-3 justify-between" v-if="cont.city != undefined">
                        <div class="text-sm font-medium text-gray-500">Город</div>
                        <div class="text-sm font-normal text-black text-right">{{ cont.city }}</div>
                      </div>

                      <div class="flex flex-row gap-3 justify-between" v-if="cont.region != undefined">
                        <div class="text-sm font-medium text-gray-500">Регион</div>
                        <div class="text-sm font-normal text-black text-right">{{ cont.region }}</div>
                      </div>

                      <div class="flex flex-row gap-3 justify-between" v-if="cont.country != undefined">
                        <div class="text-sm font-medium text-gray-500">Страна</div>
                        <div class="text-sm font-normal text-black text-right">{{ cont.country }}</div>
                      </div>

                      <div class="flex flex-row gap-3 justify-between" v-if="cont.postal_code != undefined">
                        <div class="text-sm font-medium text-gray-500">Почтовый индекс</div>
                        <div class="text-sm font-normal text-black text-right">{{ cont.postal_code }}</div>
                      </div>
                      
                    </div>

                  </div>
                </div>



              <!--  -->
            </div>
            <div  v-show="tab == 2">
            <!--  -->

              <div class="xxxxx2">

                <div class="flex flex-col gap-4">
                  <div v-for="deal in organization.deals" class="border border-skyblue-100 rounded-xl p-4 flex flex-col gap-3 bg-skyblue-100" :key="deal.id">

                    <div class="flex flex-row justify-between gap-0 mb-2">
                      <div class="text-sm font-medium text-indigo-500">ID Сделки # {{ deal.id }}</div>
                       <div @click="showEditDealModal(deal)" class="text-sm rounded-full py-1  px-3 text-white text-center bg-green-500 cursor-pointer hover:bg-green-400 duration-300">  
                          редактировать
                        </div>
                      <div v-if="$page.props.auth.user.id == deal.user.id">
                          <select v-model="deal.status" @change="changeDealStatus(deal)" class="text-sm rounded-full py-1  px-3 text-white text-center" :class="'bg-' + dealStatuses[deal.status].color + '-500'">
                            <option value="0">Отменена</option>
                            <option value="1">Закрыта</option>
                            <option value="2">Открыта</option>
                            <option value="3">Договор</option>
                            <option value="4">Оплата</option>
                            <option value="5">Доставка</option>
                            <option value="6">Обслуживание</option>
                          </select>

                      </div>

                      <div v-else>
                        
                        <p class="text-sm rounded-full py-1  px-3 text-white text-center" :class="'bg-' + dealStatuses[deal.status].color + '-500'" >  
                          {{ dealStatuses[deal.status].name }}
                        </p>
                      </div>
                      
                    </div>
                    
                    <person-card  :id="deal.user.id" :src="'/storage/' + deal.user.photo_path" :fullname="deal.user.last_name + ' ' + deal.user.first_name" :job="deal.user.position.name"></person-card>

                    <div class="flex flex-row gap-3 justify-between" v-if="deal.name != undefined">
                      <div class="text-sm font-medium text-gray-500">Название</div>
                      <div class="text-sm font-normal text-black text-right">{{ deal.name }}</div>
                    </div>

                    <div class="flex flex-row gap-3 justify-between" v-if="deal.sum != undefined">
                      <div class="text-sm font-medium text-gray-500">Сумма</div>
                      <div class="text-sm font-normal text-black text-right">{{ deal.sum }}</div>
                    </div>

                    <div class="flex flex-row gap-3 justify-between" v-if="deal.sum != undefined">
                      <div class="text-sm font-medium text-gray-500">Тип</div>
                      <div class="text-sm font-normal text-black text-right">{{ deal.type }}</div>
                    </div>

                    <div class="flex flex-row gap-3 justify-between" v-if="deal.sum != undefined">
                      <div class="text-sm font-medium text-gray-500">Примечания</div>
                      <div class="text-sm font-normal text-black text-right">{{ deal.comment }}</div>
                    </div>

                    <div class="flex flex-row gap-3 justify-between" v-if="deal.file != undefined">
                      <div class="text-sm font-medium text-gray-500">Документ</div>
                      <a class="text-sm font-normal text-black text-right hover:text-skyblue-500" :href="'/storage/' + deal.file.path" download="">{{ deal.file.name }}</a>
                    </div>


                  </div>

                </div>
              </div>


              
              <!--  -->
            </div>
            <div  v-show="tab == 3">
             <!--  -->

              <div class="flex flex-1">
                <div class="w-full bg-white overflow-y-auto rounded-2xl">
                  
                  <div class="flex gap-5 items-center py-1 justify-between" v-for="action in actions" :key="action.id">

                    <div>
                        <person-card  :id="action.user.id" :src="'/storage/' + action.user.photo_path" :fullname="action.user.last_name + ' ' + action.user.first_name" :job="action.user.position.name"></person-card>
                      </div>

                    <div>
                      <div v-if="action.type == 1" class="text-black font-medium flex items-center gap-3">

                        
<svg viewBox="0 0 473.806 473.806" class="fill-current w-6 h-6">
<g>
	<g>
		<path d="M374.456,293.506c-9.7-10.1-21.4-15.5-33.8-15.5c-12.3,0-24.1,5.3-34.2,15.4l-31.6,31.5c-2.6-1.4-5.2-2.7-7.7-4
			c-3.6-1.8-7-3.5-9.9-5.3c-29.6-18.8-56.5-43.3-82.3-75c-12.5-15.8-20.9-29.1-27-42.6c8.2-7.5,15.8-15.3,23.2-22.8
			c2.8-2.8,5.6-5.7,8.4-8.5c21-21,21-48.2,0-69.2l-27.3-27.3c-3.1-3.1-6.3-6.3-9.3-9.5c-6-6.2-12.3-12.6-18.8-18.6
			c-9.7-9.6-21.3-14.7-33.5-14.7s-24,5.1-34,14.7c-0.1,0.1-0.1,0.1-0.2,0.2l-34,34.3c-12.8,12.8-20.1,28.4-21.7,46.5
			c-2.4,29.2,6.2,56.4,12.8,74.2c16.2,43.7,40.4,84.2,76.5,127.6c43.8,52.3,96.5,93.6,156.7,122.7c23,10.9,53.7,23.8,88,26
			c2.1,0.1,4.3,0.2,6.3,0.2c23.1,0,42.5-8.3,57.7-24.8c0.1-0.2,0.3-0.3,0.4-0.5c5.2-6.3,11.2-12,17.5-18.1c4.3-4.1,8.7-8.4,13-12.9
			c9.9-10.3,15.1-22.3,15.1-34.6c0-12.4-5.3-24.3-15.4-34.3L374.456,293.506z M410.256,398.806
			C410.156,398.806,410.156,398.906,410.256,398.806c-3.9,4.2-7.9,8-12.2,12.2c-6.5,6.2-13.1,12.7-19.3,20
			c-10.1,10.8-22,15.9-37.6,15.9c-1.5,0-3.1,0-4.6-0.1c-29.7-1.9-57.3-13.5-78-23.4c-56.6-27.4-106.3-66.3-147.6-115.6
			c-34.1-41.1-56.9-79.1-72-119.9c-9.3-24.9-12.7-44.3-11.2-62.6c1-11.7,5.5-21.4,13.8-29.7l34.1-34.1c4.9-4.6,10.1-7.1,15.2-7.1
			c6.3,0,11.4,3.8,14.6,7c0.1,0.1,0.2,0.2,0.3,0.3c6.1,5.7,11.9,11.6,18,17.9c3.1,3.2,6.3,6.4,9.5,9.7l27.3,27.3
			c10.6,10.6,10.6,20.4,0,31c-2.9,2.9-5.7,5.8-8.6,8.6c-8.4,8.6-16.4,16.6-25.1,24.4c-0.2,0.2-0.4,0.3-0.5,0.5
			c-8.6,8.6-7,17-5.2,22.7c0.1,0.3,0.2,0.6,0.3,0.9c7.1,17.2,17.1,33.4,32.3,52.7l0.1,0.1c27.6,34,56.7,60.5,88.8,80.8
			c4.1,2.6,8.3,4.7,12.3,6.7c3.6,1.8,7,3.5,9.9,5.3c0.4,0.2,0.8,0.5,1.2,0.7c3.4,1.7,6.6,2.5,9.9,2.5c8.3,0,13.5-5.2,15.2-6.9
			l34.2-34.2c3.4-3.4,8.8-7.5,15.1-7.5c6.2,0,11.3,3.9,14.4,7.3c0.1,0.1,0.1,0.1,0.2,0.2l55.1,55.1
			C420.456,377.706,420.456,388.206,410.256,398.806z"/>
		<path d="M256.056,112.706c26.2,4.4,50,16.8,69,35.8s31.3,42.8,35.8,69c1.1,6.6,6.8,11.2,13.3,11.2c0.8,0,1.5-0.1,2.3-0.2
			c7.4-1.2,12.3-8.2,11.1-15.6c-5.4-31.7-20.4-60.6-43.3-83.5s-51.8-37.9-83.5-43.3c-7.4-1.2-14.3,3.7-15.6,11
			S248.656,111.506,256.056,112.706z"/>
		<path d="M473.256,209.006c-8.9-52.2-33.5-99.7-71.3-137.5s-85.3-62.4-137.5-71.3c-7.3-1.3-14.2,3.7-15.5,11
			c-1.2,7.4,3.7,14.3,11.1,15.6c46.6,7.9,89.1,30,122.9,63.7c33.8,33.8,55.8,76.3,63.7,122.9c1.1,6.6,6.8,11.2,13.3,11.2
			c0.8,0,1.5-0.1,2.3-0.2C469.556,223.306,474.556,216.306,473.256,209.006z"/>
	</g>
</g>
</svg>

                        Звонок
                      </div>
                      <div v-if="action.type == 2" class="text-black font-medium flex items-center gap-3">



<svg viewBox="0 0 512 512" class="fill-current w-6 h-6">
<g>
	<g>
		<path d="M404.267,315.41c-10.048-20.949-45.995-50.027-80.725-78.123c-19.371-15.659-37.675-30.464-49.344-42.133
			c-2.923-2.944-7.296-3.883-11.157-2.496c-7.189,2.603-11.627,4.608-15.125,6.165c-5.333,2.389-7.125,3.2-14.315,3.925
			c-3.179,0.32-6.037,2.027-7.808,4.672c-15.083,22.549-30.699,20.629-41.131,17.131c-3.328-1.109-3.925-2.539-4.245-3.904
			c-2.24-9.365,9.003-31.168,23.573-45.739c34.667-34.688,52.544-43.371,90.304-26.496c42.837,19.157,85.76,34.155,86.187,34.304
			c5.611,1.941,11.648-1.003,13.589-6.571c1.92-5.568-1.003-11.648-6.571-13.589c-0.427-0.149-42.496-14.848-84.48-33.643
			c-48.917-21.867-75.755-7.467-114.091,30.891c-14.592,14.592-34.411,44.117-29.291,65.771c2.197,9.216,8.683,16.043,18.325,19.221
			c24.171,7.979,46.229,0.341,62.656-21.461c6.784-1.045,10.475-2.581,16.021-5.077c2.005-0.896,4.352-1.941,7.467-3.2
			c12.203,11.456,28.672,24.789,46.016,38.805c31.36,25.365,66.923,54.123,74.923,70.763c3.947,8.213-0.299,13.568-3.179,16.021
			c-4.224,3.627-10.005,4.779-13.141,2.581c-3.456-2.368-7.957-2.517-11.52-0.384c-3.584,2.133-5.589,6.165-5.141,10.304
			c0.725,6.784-5.483,10.667-8.171,12.011c-6.827,3.456-13.952,2.859-16.619,0.384c-2.987-2.773-7.275-3.584-11.072-2.176
			c-3.797,1.429-6.443,4.928-6.827,8.981c-0.64,6.997-5.824,13.717-12.587,16.341c-3.264,1.237-8,1.984-12.245-1.899
			c-2.645-2.389-6.315-3.307-9.749-2.475c-3.477,0.853-6.272,3.371-7.488,6.72c-0.405,1.067-1.323,3.627-11.307,3.627
			c-7.104,0-19.883-4.8-26.133-8.939c-7.488-4.928-54.443-39.957-94.997-73.92c-5.696-4.8-15.552-15.083-24.256-24.171
			c-7.723-8.064-14.784-15.381-18.411-18.453c-4.544-3.84-11.264-3.264-15.04,1.259c-3.797,4.501-3.243,11.243,1.259,15.04
			c3.307,2.795,9.707,9.557,16.768,16.917c9.515,9.941,19.349,20.224,25.963,25.771c39.723,33.259,87.467,69.163,96.981,75.413
			c7.851,5.163,24.768,12.416,37.867,12.416c10.517,0,18.603-2.411,24.213-7.125c7.509,2.923,16.043,2.944,24.256-0.256
			c9.707-3.755,17.685-11.328,22.208-20.501c8.405,1.792,18.027,0.533,26.773-3.861c8.555-4.309,14.741-10.901,17.813-18.603
			c8.491,0.448,17.237-2.56,24.469-8.768C407.979,346.407,411.349,330.109,404.267,315.41z"/>
	</g>
</g>
<g>
	<g>
		<path d="M213.333,138.663h-96c-5.888,0-10.667,4.779-10.667,10.667s4.779,10.667,10.667,10.667h96
			c5.888,0,10.667-4.779,10.667-10.667S219.221,138.663,213.333,138.663z"/>
	</g>
</g>
<g>
	<g>
		<path d="M435.52,292.711c-3.307-4.885-9.92-6.229-14.805-2.901l-31.189,20.949c-4.885,3.285-6.187,9.92-2.901,14.805
			c2.069,3.051,5.44,4.715,8.875,4.715c2.027,0,4.096-0.576,5.931-1.813l31.189-20.949
			C437.504,304.231,438.805,297.597,435.52,292.711z"/>
	</g>
</g>
<g>
	<g>
		<path d="M369.301,343.613c-7.637-6.016-41.792-40.981-62.912-62.997c-4.075-4.267-10.837-4.416-15.083-0.32
			c-4.267,4.075-4.395,10.837-0.32,15.083c5.483,5.717,53.845,56.128,65.088,65.003c1.941,1.536,4.288,2.283,6.592,2.283
			c3.136,0,6.272-1.408,8.405-4.075C374.72,353.981,373.931,347.261,369.301,343.613z"/>
	</g>
</g>
<g>
	<g>
		<path d="M326.677,365.01c-12.779-10.219-44.885-44.331-52.139-52.224c-4.011-4.352-10.731-4.608-15.083-0.64
			c-4.331,3.989-4.629,10.752-0.64,15.083c0.384,0.405,38.699,41.771,54.528,54.443c1.963,1.557,4.331,2.325,6.656,2.325
			c3.115,0,6.229-1.387,8.341-3.989C332.011,375.399,331.264,368.679,326.677,365.01z"/>
	</g>
</g>
<g>
	<g>
		<path d="M284.224,386.493c-15.211-12.821-46.336-45.952-52.416-52.459c-4.032-4.309-10.795-4.544-15.083-0.512
			c-4.309,4.032-4.523,10.773-0.512,15.083c8.747,9.365,38.528,40.939,54.251,54.208c2.005,1.685,4.437,2.517,6.869,2.517
			c3.029,0,6.059-1.301,8.171-3.797C289.301,397.01,288.725,390.29,284.224,386.493z"/>
	</g>
</g>
<g>
	<g>
		<path d="M124.672,120.253C106.389,102.93,33.28,97.319,11.307,96.018c-3.029-0.149-5.824,0.853-7.957,2.88
			C1.216,100.903,0,103.719,0,106.663v192c0,5.888,4.779,10.667,10.667,10.667h64c4.608,0,8.704-2.965,10.133-7.36
			c1.557-4.779,38.315-117.589,43.157-173.056C128.235,125.671,127.04,122.471,124.672,120.253z M66.88,287.997H21.333V118.098
			c34.283,2.709,71.275,8.597,84.715,15.125C100.395,179.943,74.816,262.951,66.88,287.997z"/>
	</g>
</g>
<g>
	<g>
		<path d="M501.333,117.33c-83.755,0-130.219,21.44-132.16,22.336c-2.773,1.301-4.843,3.712-5.696,6.635s-0.427,6.059,1.173,8.661
			c13.184,21.227,54.464,139.115,62.4,167.872c1.28,4.629,5.483,7.829,10.283,7.829h64c5.888,0,10.667-4.779,10.667-10.667v-192
			C512,122.087,507.221,117.33,501.333,117.33z M490.667,309.33h-45.355c-10.112-32.939-39.979-118.827-56.64-154.325
			c16.277-5.525,51.243-15.019,101.995-16.213V309.33z"/>
	</g>
</g>
</svg>

                        Встреча
                      </div>
                    </div>

                    <div>
                      {{ hour(action.date) }}
                    </div>
                    
                    <div>
                      {{ date(action.date) }}
                    </div>
                    
                  </div>
                  
                </div>
              </div>


              
              <!--  -->
            </div>
          </div>
        </div>



        
        


      </div>
    </div>
    
   
    <modal name="create-deal">
      <create-deal :client="organization.id" to="client"></create-deal>
    </modal>

    <modal name="create-contact">
      <create-contact :organization_id="organization.id"></create-contact>
    </modal>

    <modal name="create-action" class="modal-50">
      <create-action :type="actionType" :organization_id="organization.id"></create-action>
    </modal>

     <modal name="edit-deal" class="modal-60">
       <edit-deal :deal="deal"></edit-deal>
    </modal>

  </div>
</template>

<script>
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import PersonCard from '@/Shared/PersonCard'
import TrashedMessage from '@/Shared/TrashedMessage'
import CreateDeal from '../Deals/Create'
import EditDeal from '../Deals/Edit'
import CreateContact from './CreateContact'
import CreateAction from './CreateAction'
import axios from 'axios'
import moment from 'moment'

export default {
  metaInfo() {
    return { title: this.form.name }
  },
  components: {
    Icon,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
    PersonCard,
    CreateContact,
    CreateAction,
    CreateDeal,
    EditDeal
  },
  layout: Layout,
  props: {
    organization: Object,
    responsible: Object,
    comments: Array,
    actions: Array,
    users: Array,
  },
  data:{
    edit_comment: null,
    edit_sum: null,
    edit_type: null,
    edit_name: 'test',
    message:"",
    deal_edit: null,
  },
  remember: 'form',
  created() {
    console.log(this.organization)
  },
  data() {
    return {
      actionType: 1,
      form: {
        name: this.organization.name,
        ceo: this.organization.ceo,
        status: this.organization.status,
        id: this.organization.id,
      },
      tab: 2,
      dealStatuses: {
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

			} ,
      statuses: {
        0: {
              name: 'Без статуса',
              color: 'gray'
          },
          1: {
              name: 'Новый',
              color: 'skyblue'
          },
          2: {
              name: 'Постоянный',
              color: 'green'
          },
          3: {
              name: 'Вероятный',
              color: 'orange'
          },
      },
      deal: {},
    }
  },
  methods: {
    showEditDealModal(deal){
      this.deal = deal;
      this.$modal.show('edit-deal');
    },
    date(date) {
      return moment(date).format('LL')
    },
    hour(date) {
      return moment(date).format('LT')
    },
    showTab(i){
      this.tab = i
    },
    changeDealStatus(deal) {
      axios.post('/deal-status', { 
        status: deal.status,
        id:  deal.id
      }).then(response => {
        this.$notify({
            group: 'foo',
            title: 'Успешно',
            type: 'success',
            duration: 5000,
            text: response.data
        });
      })
    },
    comment(){
      this.form.post(this.route('organizations.comment',{
        message: message.value.toString(),
        id:this.organization.id
      }))
    },
    addAction() {

    },
    update() {
      axios.post('/edit-client', { 
        name: this.form.name,
        ceo: this.form.ceo,
        status: this.form.status,
        id: this.organization.id
      }).then(response => {
        this.$notify({
            group: 'foo',
            title: 'Успешно',
            type: 'success',
            duration: 5000,
            text: response.data
        });
      })
    },
    showCreateDealModal() {
      this.$modal.show('create-deal');
    },
    showCreateActionModal(type) {
      this.actionType = type
      this.$modal.show('create-action');
    },
    showCreateContactModal() {
      this.$modal.show('create-contact'); 
    },
    changeStatus() {
      axios.post('client-status', {
        status: this.form.status,
        id:this.organization.id
      }).then(response => {
        // this.$notify({
        //                 group: 'foo',
        //                 title: 'Успешно',
        //                 type: 'success',
        //                 duration: 5000,
        //                 text: this.$page.props.flash.success
        //             });
      })
    },
  },
}

</script>
