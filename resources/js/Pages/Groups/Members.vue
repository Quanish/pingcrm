<template>
	<div class="flex flex-col p-6">

      <div>
          <h1 class="mb-8 font-medium text-xl">
            Участники группы ({{ members.length}})
          </h1>
        </div>

      <div class="flex justify-between w-full">

        
        <div class="w-1/2">
          <p>Выберите пользователя</p>
          <v-select class="border-b-2 w-full pb-1" label="name" :options="users" v-model="selectedUser" @option:selected="selected">

            <template v-slot:option="option">
              <person-card :id="option.id" :src="'/storage/' + option.photo_path" :fullname="option.name" :job="option.position.name"></person-card>
            </template>

          </v-select>
        </div>

        
        <div class="w-1/2 p-4 h-60 overflow-y-auto">
            <div v-for="(member, index) in members" :key="member.id" class="relative">
                <person-card :id="member.id" :src="'/storage/' + member.photo_path" :fullname="member.name" :job="member.position.name"></person-card>
                <button class="absolute right-0 top-0 rounded-full bg-gray-100 hover:bg-gray-200 flex justify-center items-center w-5 h-5" @click="removeUser(index)">
                    <svg class="h-2 w-2 fill-current text-black-600" viewBox="0 0 311 311.07733"><path d="m16.035156 311.078125c-4.097656 0-8.195312-1.558594-11.308594-4.695313-6.25-6.25-6.25-16.382812 0-22.632812l279.0625-279.0625c6.25-6.25 16.382813-6.25 22.632813 0s6.25 16.382812 0 22.636719l-279.058594 279.058593c-3.136719 3.117188-7.234375 4.695313-11.328125 4.695313zm0 0"/><path d="m295.117188 311.078125c-4.097657 0-8.191407-1.558594-11.308594-4.695313l-279.082032-279.058593c-6.25-6.253907-6.25-16.386719 0-22.636719s16.382813-6.25 22.636719 0l279.058594 279.0625c6.25 6.25 6.25 16.382812 0 22.632812-3.136719 3.117188-7.230469 4.695313-11.304687 4.695313zm0 0"/></svg>
                </button>
            </div>
        </div>


         
      </div>

      <div class="flex gap-4">
          <button @click="saveMembers" class="py-2 px-4 bg-indigo-500 hover:bg-indigo-600 mt-10 block text-white items-center rounded-full  text font-normal">Сохранить</button>
        </div>


  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import PersonCard from '@/Shared/PersonCard.vue'
import Icon from '@/Shared/Icon'
import axios from "axios";

export default {
  metaInfo() {
    return {
      title: `Добавление участников`,
    }
  },
  components: {
    Icon,
    PersonCard
  },
  layout: Layout,
  props: {
    members: Array,
    group_id: Number,
  },
  data() {
    return {
      selectedUser: "",
      users: [],
    }
  },
  created() {
    axios.get('/get-users')
      .then(response => {
        this.normalize(response.data)
    })
  },
  methods: {
    normalize(data){
      this.users = data

      this.users.forEach(el => {
        el.name = el.last_name + ' ' + el.first_name
      });

    },
    saveMembers(){
      axios.post('/save-users-to-group', {
        users: this.members,
        group_id: this.group_id,
      }).then(response => {
          this.$modal.hide("addUser");
      })
    },
    selected() {
      if(this.members.map(function(e) { return e.id; }).indexOf(this.selectedUser.id) === -1)  {
        this.members.push(this.selectedUser)
      } 
      this.selectedUser = {}
      
    },
    removeUser(index) {
      this.members.splice(index, 1);
    }
  },
}
</script>
