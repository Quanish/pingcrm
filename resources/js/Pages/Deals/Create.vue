<template>
	<div class="py-6 px-6  overflow-y-auto overflow-x-hidden h-full">
		<form @submit.prevent="store">
		<div class="bg-white w-full">
			<div >
				<div class="flex justify-between">
				<h1 class="mb-8 font-medium text-xl">
					<inertia-link class="text-black hover:text-indigo-600 font-medium">Новая сделка</inertia-link>
				</h1>
					<div class="flex justify-end gap-3 rounded-full p-3 bg-gray-200 h-10"><p>№</p><p >MT-01234568</p></div>
				</div> 
				<div class="flex mt-8 mb-3 justify-start">
					<div class="w-3/12 space-y-6 mt-3">
						<p>Клиент</p>
						<p>Реквизиты</p>
						<p>Заказ</p>
						<p>Форма оплаты</p>
					</div>
					<div class="w-9/12 space-y-4 ml-5">
						<div class="flex">
							<input type="text" class="border-b-2 w-full pb-1">
							<p>Контакты</p>
							<input type="text" class="border-b-2 w-full pb-1">
						</div>
						<input type="text" class="border-b-2 w-full pb-1">
						<input type="text" class="border-b-2 w-full pb-1">
					</div>
					
				</div>
			</div>
		</div>
		<div class="w-full flex mt-3 ">
            <div class="lg:w-1/4">
             <!-- <p class="font-medium leading-6">Заполните поле
                <span class="text-red-400">*</span> 
              </p>   -->
            </div>
            <div class="lg:w-3/4 flex justify-end">
            
              <button class="ml-3 text-sm leading-8 px-20 login_button rounded-full text-white h-8 w-auto flex justify-center items-center font-light"><span>Создать</span></button>
            </div>  
          </div> 
		 </form>
	</div>
</template>
<script type="text/javascript">
	import Layout from '@/Shared/Layout'

export default {
	metaInfo: { title: 'Сделки' },
	layout: Layout,
	data() {
    return {
      form: this.$inertia.form({
        user: 1,
      }),
    }
  },
  created() {
    // axios.get('/')
    //   .then(response => {
        
    // })
  },
  methods: {
    store() {
      this.form.post(this.route('deals.store'))
    },
  },
}

</script>