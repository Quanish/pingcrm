<template>
  <div class="flex flex-col h-full">
    <div class="flex justify-between gap-3 flex-wrap items-start">
        <h1 class="mb-8 font- text-2xl text-black font-medium ">
          Карточка клиента
        </h1>

        <div class="flex gap-3 items-center">
          <p class="font-medium">Статус</p>
          <select class="font-medium text-sm rounded-full px-3  py-1.5 " :class="'bg-' + statuses[form.status].color + '-500 text-' + statuses[form.status].color +'-700'" @change="changeStatus" v-model="form.status">
            <option value="0">Без статуса</option>
            <option value="3">Вероятные</option>
            <option value="2">Постоянные</option>
            <option value="1">Новые</option>
          </select>
        </div>

          <div>
            <button class="login_button rounded-full text-white px-4 p-1 text-sm flex justify-center items-center" @click="addAction">
              <span>+ Новое действие</span>
            </button>
          </div>


      <div>
        
        <button class="text-white login_button mr-2  rounded-full px-4 p-1 flex gap-3" @click="update">
          <span class="text-sm">Сохранить</span>
          <svg class="fill-current w-4 h-4" viewBox="0 0 512.007 512.007"><g><path d="m511.927 126.537c-.279-2.828-1.38-5.666-3.315-8.027-.747-.913 6.893 6.786-114.006-114.113-2.882-2.882-6.794-4.395-10.612-4.394-9.096 0-329.933 0-338.995 0-24.813 0-45 20.187-45 45v422c0 24.813 20.187 45 45 45h422c24.813 0 45-20.187 45-45 .001-364.186.041-339.316-.072-340.466zm-166.927-96.534v98c0 8.271-6.729 15-15 15h-19v-113zm-64 0v113h-139c-8.271 0-15-6.729-15-15v-98zm64 291h-218v-19c0-8.271 6.729-15 15-15h188c8.271 0 15 6.729 15 15zm-218 161v-131h218v131zm355-15c0 8.271-6.729 15-15 15h-92c0-19.555 0-157.708 0-180 0-24.813-20.187-45-45-45h-188c-24.813 0-45 20.187-45 45v180h-52c-8.271 0-15-6.729-15-15v-422c0-8.271 6.729-15 15-15h52v98c0 24.813 20.187 45 45 45h188c24.813 0 45-20.187 45-45v-98h2.787l104.213 104.214z"/></g></svg>
        </button>

        
      </div>
    </div>
    <div class="flex flex-auto overflow-hidden gap-4">
      <div class="w-3/12  bg-white overflow-y-auto rounded-2xl">
        <div class="bg-white rounded-2xl overflow-hidden p-4">
          <h2 class=" font-medium text mb-8 pb-4 border-b border-gray-300" >Основная информация</h2>
          <form @submit.prevent="update">
            <div class="flex flex-wrap  text-sm">

              <text-input v-model="form.name" :error="form.errors.name" :col="false" class="w-full mb-5" label="Компания" />
              <text-input v-model="form.ceo" :error="form.errors.ceo" :col="false" class="w-full " label="Директор" />

              <div class="mt-3 flex flex-col gap-3" v-if="responsible">
                <p class="text-black font-medium">Создал карточку:</p>
                <person-card  :id="responsible.id" :src="'/storage/' + responsible.photo_path" :fullname="responsible.last_name + ' ' + responsible.first_name" :job="responsible.position.name"></person-card>
              </div>
            </div>
          </form>
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
                    <div v-for="cont in organization.contacts" class="border border-gray-200 rounded-xl p-4 flex flex-col gap-3 bg-gray-100" :key="cont.id">

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
                  <div v-for="deal in organization.deals" class="border border-gray-200 rounded-xl p-4 flex flex-col gap-3 bg-gray-100" :key="deal.id">

                    <div class="flex flex-row justify-between gap-0 mb-2">
                      <div class="text-sm font-medium text-indigo-500">ID Сделки # {{ deal.id }}</div>
                      <p class="text-sm rounded-full py-1  px-3 text-white text-center" :class="'bg-' + dealStatuses[deal.status].color + '-500'">  
                        {{ dealStatuses[deal.status].name }}
                      </p>
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


                  </div>

                </div>
              </div>


              
              <!--  -->
            </div>
            <div  v-show="tab == 3">
             <!--  -->

              <div class="flex flex-1">
                <div class="w-full bg-white overflow-y-auto rounded-2xl">
              
                  <div class="">
                    <div v-if="!comments.length" class="text-xs">Пока ничего нет...</div>
                    <!-- <div v-for="comment in comments" class="mt-3">
                      <div>{{comment.user.first_name}}</div>
                      <div>{{comment.comment}}</div>
                    </div> -->
                    <!-- <div class="">
                      <form @submit.prevent="comment">
                        <text-input id="message" class="pr-6 pb-8 lg:w-9/12" />
                        <loading-button type="submit" class="btn-indigo rounded-full mt-3">Оставить комментарий</loading-button>
                      </form>
                    </div> -->
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
import CreateContact from './CreateContact'
import axios from 'axios'


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
    CreateDeal
  },
  layout: Layout,
  props: {
    organization: Object,
    responsible: Object,
    comments: Array,
    users: Array,
  },
  data:{
    message:"",
  },
  remember: 'form',
  created() {
    console.log(this.organization)
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.organization.name,
        ceo: this.organization.ceo,
        status: this.organization.status,
      }),
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
      }
    }
  },
  methods: {
    showTab(i){
      this.tab = i
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
      this.form.put(this.route('organizations.update', this.organization.id))
    },
    showCreateDealModal() {
      this.$modal.show('create-deal');
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
    restore() {
      if (confirm('Are you sure you want to restore this organization?')) {
        this.$inertia.put(this.route('organizations.restore', this.organization.id))
      }
    },
  },
}

</script>
