<template>
  <div class="flex flex-col h-full">
    <div class="flex justify-between gap-3 flex-wrap items-start">
        <h1 class="mb-8 font- text-2xl text-black font-medium ">
          Карточка клиента
        </h1>

        <div class="flex gap-3 items-center">
          <p class="font-medium">Статус</p>
          <p class="font-normal text rounded-full px-3 text-white py-1" :class="'bg-' + statuses[form.status].color + '-500'">{{ statuses[form.status].name }}</p>
        </div>
      <div>
        
        <button class="text-white hover:bg-indigo-400 mr-2 bg-indigo-500 rounded-lg p-2" @click="update">
          <svg class="fill-current w-4 h-4" viewBox="0 0 512.007 512.007"><g><path d="m511.927 126.537c-.279-2.828-1.38-5.666-3.315-8.027-.747-.913 6.893 6.786-114.006-114.113-2.882-2.882-6.794-4.395-10.612-4.394-9.096 0-329.933 0-338.995 0-24.813 0-45 20.187-45 45v422c0 24.813 20.187 45 45 45h422c24.813 0 45-20.187 45-45 .001-364.186.041-339.316-.072-340.466zm-166.927-96.534v98c0 8.271-6.729 15-15 15h-19v-113zm-64 0v113h-139c-8.271 0-15-6.729-15-15v-98zm64 291h-218v-19c0-8.271 6.729-15 15-15h188c8.271 0 15 6.729 15 15zm-218 161v-131h218v131zm355-15c0 8.271-6.729 15-15 15h-92c0-19.555 0-157.708 0-180 0-24.813-20.187-45-45-45h-188c-24.813 0-45 20.187-45 45v180h-52c-8.271 0-15-6.729-15-15v-422c0-8.271 6.729-15 15-15h52v98c0 24.813 20.187 45 45 45h188c24.813 0 45-20.187 45-45v-98h2.787l104.213 104.214z"/></g></svg>
        </button>

        <button class="text-white hover:bg-red-400  bg-red-500 rounded-lg p-2" @click="destroy">
          <svg class="fill-current w-4 h-4" viewBox="0 0 512 512"><g><path d="m424 64h-88v-16c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16h-88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283c1.221 25.636 22.281 45.717 47.945 45.717h242.976c25.665 0 46.725-20.081 47.945-45.717l13.823-290.283h8.744c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zm-216-16c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zm-128 56c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40c-4.931 0-331.567 0-352 0zm313.469 360.761c-.407 8.545-7.427 15.239-15.981 15.239h-242.976c-8.555 0-15.575-6.694-15.981-15.239l-13.751-288.761h302.44z"/><path d="m256 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/><path d="m336 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/><path d="m176 448c8.836 0 16-7.164 16-16v-208c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"/></g></svg>
        </button>
        
      </div>
    </div>
    <div class="flex flex-auto overflow-hidden gap-4">
      <div class="w-4/12  bg-white overflow-y-auto rounded-2xl">
        <div class="bg-white rounded-2xl overflow-hidden p-4">
          <h2 class=" font-medium text mb-8">Основная информация</h2>
        
          <form @submit.prevent="update">
            <div class="flex flex-wrap  text-sm">

              <text-input v-model="form.name" :error="form.errors.name" :col="false" class="pr-6 pb-8 w-full " label="Директор" />
              <text-input v-model="form.region" :error="form.errors.region" :col="false" class="pr-6 pb-8 w-full " label="Компания" />
              <text-input v-model="form.city" :error="form.errors.city" :col="false" class="pr-6  w-full " label="Город" />

              <div class="mt-3 flex flex-col gap-3" v-if="responsible">
                <p class="text-black font-medium">Ответственный:</p>
                <person-card  :src="'/storage/' + responsible.photo_path" :fullname="responsible.last_name + ' ' + responsible.first_name" :job="responsible.position.name"></person-card>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="w-8/12 overflow-y-auto flex flex-col gap-4">

        <div class="flex flex-2 gap-4 flex-auto">

          <div class="w-6/12 bg-white overflow-y-auto rounded-2xl p-4">
            <div class="flex justify-between items-center mb-8">
              <h2 class=" font-medium text ">Контакты</h2>
              <button class="text-sm text-skyblue-400 hover: text-skyblue-500">+ Новый контакт</button>
              
            </div>

            <div class="flex flex-col gap-4">
              <div v-for="cont in organization.contacts" class="border border-gray-200 rounded-xl p-4 flex flex-col gap-3">

                <div class="flex flex-col gap-0 mb-2">
                  <div class="text-xs font-medium text-indigo-500">ID Контакта #{{ cont.id }}</div>
                </div>

                <div class="flex flex-row gap-3 justify-between" v-if="cont.first_name != undefined || cont.last_name != undefined">
                  <div class="text-xs font-medium text-gray-500">Контактное лицо</div>
                  <div class="text-xs font-normal text-black text-right">{{ cont.last_name + ' ' + cont.first_name }}</div>
                </div>

                <div class="flex flex-row gap-3 justify-between" v-if="cont.phone != undefined">
                  <div class="text-xs font-medium text-gray-500">Телефон</div>
                  <div class="text-xs font-normal text-black text-right">{{ cont.phone }}</div>
                </div>

                <div class="flex flex-row gap-3 justify-between" v-if="cont.address != undefined">
                  <div class="text-xs font-medium text-gray-500">Адрес</div>
                  <div class="text-xs font-normal text-black text-right">{{ cont.address }}</div>
                </div>

                <div class="flex flex-row gap-3 justify-between" v-if="cont.email != undefined">
                  <div class="text-xs font-medium text-gray-500">Email</div>
                  <div class="text-xs font-normal text-black text-right">{{ cont.email }}</div>
                </div>
                
              </div>

            </div>
          </div>

          <div class="w-6/12 bg-white overflow-y-auto rounded-2xl p-4">
            <div class="flex justify-between items-center mb-8">
              <h2 class=" font-medium text ">Сделки</h2>
              <button class="text-sm text-skyblue-400 hover: text-skyblue-500" @click="showCreateDealModal">+ Новая сделка</button>
            </div>

            <div class="flex flex-col gap-4">
              <div v-for="deal in organization.deals" class="border border-gray-200 rounded-xl p-4 flex flex-col gap-3">

                <div class="flex flex-row justify-between gap-0 mb-2">
                  <div class="text-xs font-medium text-indigo-500">ID Сделки # {{ deal.id }}</div>
                  <p class="text-sm rounded-full py-1  px-3 text-white text-center" :class="'bg-' + dealStatuses[deal.status].color + '-500'">  
                    {{ dealStatuses[deal.status].name }}
                  </p>
                </div>

                <div class="flex flex-row gap-3 justify-between" v-if="deal.name != undefined">
                  <div class="text-xs font-medium text-gray-500">Название</div>
                  <div class="text-xs font-normal text-black text-right">{{ deal.name }}</div>
                </div>

                <div class="flex flex-row gap-3 justify-between" v-if="deal.sum != undefined">
                  <div class="text-xs font-medium text-gray-500">Сумма</div>
                  <div class="text-xs font-normal text-black text-right">{{ deal.sum }}</div>
                </div>

                <div class="flex flex-row gap-3 justify-between" v-if="deal.sum != undefined">
                  <div class="text-xs font-medium text-gray-500">Тип</div>
                  <div class="text-xs font-normal text-black text-right">{{ deal.type }}</div>
                </div>

                <div class="flex flex-row gap-3 justify-between" v-if="deal.sum != undefined">
                  <div class="text-xs font-medium text-gray-500">Примечания</div>
                  <div class="text-xs font-normal text-black text-right">{{ deal.comment }}</div>
                </div>


              </div>

            </div>
          </div>

        </div>


        <div class="flex flex-1">
          <div class="w-full bg-white overflow-y-auto rounded-2xl p-4">
            <div class="flex justify-between items-center mb-8">
              <h2 class=" font-medium text ">История</h2>
            </div>
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
        


      </div>
    </div>
    
   
    <modal name="create-deal">
      <create-deal :client="organization.id" to="client"></create-deal>
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
        email: this.organization.email,
        phone: this.organization.phone,
        address: this.organization.address,
        city: this.organization.city,
        region: this.organization.region,
        country: this.organization.country,
        status: this.organization.status,
        postal_code: this.organization.postal_code,
        responsible: this.organization.responsible,
      }),
      contact: {
        'first_name': '',
        'last_name': '',
        'organization_id': '',
        'account_id': '',
        'email': '',
        'phone': '',
        'address': '',
        'city': '',
        'region' : '',
        'country' : '',
        'postal_code': '',
      },
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
    comment(){
      this.form.post(this.route('organizations.comment',{
        message: message.value.toString(),
        id:this.organization.id
      }))
    },
    update() {
      this.form.put(this.route('organizations.update', this.organization.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this organization?')) {
        this.$inertia.delete(this.route('organizations.destroy', this.organization.id))
      }
    },
    showCreateDealModal() {
      this.$modal.show('create-deal');
    },
    restore() {
      if (confirm('Are you sure you want to restore this organization?')) {
        this.$inertia.put(this.route('organizations.restore', this.organization.id))
      }
    },
    addContact() {
      axios.post('/add-contact', {
        id: this.organization.id,
        contact: this.contact
      })
      .then(response => {
         
      })
    }
  },
}
</script>
