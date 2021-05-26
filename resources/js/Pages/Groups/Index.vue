<template>
<div >
	<div class="flex justify-between">
	<div class="flex flex-row gap-10">
		<h1 class="mb-8 font-bold text-2xl">Группы</h1>
	      <button @click="open" class="text-sm leading-8 px-20 login_button rounded-full text-white h-8 w-auto flex justify-center items-center font-light">
	        <span>Новая &nbsp;группа</span>
	      </button>

	      <div v-if="modal" class="bg-black bg-opacity-25 absolute pin-t pin-l h-screen w-11/12 flex items-center justify-center">
	      	<form @submit.prevent="create" class="bg-white p-4 rounded w-2/3">
	      		<div>
	      			<p class="text-sm leading-8 px-8">Новая группа</p>
	      		</div> 
	      		<br>
	      		<div >
	      			<div class="flex justify-between">
	      			<p>Название &nbsp;&nbsp;</p> <text-input v-model="form.name" name="name" class="pr-6 pb-8 w-full lg:w-2/2"   />
	      				</div>
	      			<div class="flex justify-between">
	      				<p>Описание&nbsp;&nbsp;</p> <text-input v-model="form.description" class="pr-6 pb-8 w-full lg:w-2/2"    />
	      			</div>
	      			
	      		</div>
	      		<div class="flex justify-end gap-10">
	      			<p>Заполните поле</p><button @click="close" v-model="modal" class="bg-indigo-500 rounded p-2 text-white"> отмена </button><button class="bg-indigo-500 rounded p-2 text-white" type="submit"> создать </button>
	      		</div>
	      	</form>
	      </div>

     </div>

	      <img class="h-10" src="img/message.png">
	 </div>
     <div class="rounded-2xl bg-white w-full flex flex-row flex-wrap py-4">
     	<div class="w-1/3 pl-4 pr-4 last:pr-0" v-for="chunk in chunked">
		  <div class="mb-4" v-for="article in chunk">
		  <div class="border rounded-2xl p-5">
		    <div class="flex justify-between">
				<div class="flex justify-start  gap-3">
					<img src="img/default-user.png" class="w-12 h-12">
					<div class="flex flex-col text-sm font-medium text-black">{{ article.group_name }}
						<p class="text-sm text-black text-2xs font-normal" v-if="article.access==1">закрытая группа</p>
						<p class="text-sm text-black text-2xs font-normal" v-if="article.access==2">открытая группа</p>
		    		</div>
				</div>
		    	<p v-if="article.id==1" class="text-sm text-gray-300 text-2xs">admin</p>
		    </div>
		    <div class="mt-5 flex justify-between">
		    	<button class="task-button text-white items-center rounded-full h-6 px-7 text-2xs leading-6">добавить участника</button>
		    	<button class="bg-gray-200 text-gray-700 items-center rounded-full h-6 px-7 text-2xs leading-6">выйти из группы</button>
		    </div>
		    </div>
		  </div>
		</div>
     </div>
</div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'

function chunk (arr, len) {
  const chunks = [];
  var i = 0;
  const n = arr.length;

  while (i < n) {
    chunks.push(arr.slice(i, i += len));
  }

  return chunks;
}

export default {
	components:{
		 TextInput,
	},
  metaInfo: { title: 'Groups' },
  layout: Layout,
  props: {
  	groups: Array,
  },
  data () {
    return {
    	modal:false,
    	form: this.$inertia.form({
	        name: null,
	        description: null,
      }),
    }
  },
  computed: {
	  chunked () {
	    return chunk(this.groups, 3)
	  },
	},
	methods:{
		create(){
			this.modal = false;
			this.form.post(this.route('groups.store'));
		},

		close(){
			this.modal = false;
		},
		open(){
			this.modal = true;
		}
	}
}
</script>
