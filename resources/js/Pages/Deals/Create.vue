<template>
	<div>
		<div class="bg-white p-5 w-full">
			<div >
				<div class="flex justify-between"><p>Новая сделка</p>
					<div class="flex justify-end gap-3 rounded-full p-3 bg-gray-200"><p>№</p><p >MT-01234568</p></div>
				</div> 
				<div class="flex mt-8 justify-start">
					<div class="w-34 space-y-6 mt-3">
						<p>Клиент</p>
						<p>Реквизиты</p>
						<p>Заказ</p>
						<p>Форма оплаты</p>
					</div>
					<div class="w-2/3 space-y-4 ml-5">
						<div class="flex">
							<input type="text" class="border-b-2 w-full pb-1">
							<p>Контакты</p>
							<input type="text" class="border-b-2 w-full pb-1">
						</div>
						<input type="text" class="border-b-2 w-full pb-1">
						<input type="text" class="border-b-2 w-full pb-1">
						<div  class="border-b-2 w-full pb-1">
							<select class="rounded-full bg-gray-200 p-1">
								<option>безналичный расчет</option>
								<option>наличный расчет</option>
								<option>онлайн</option>
							</select>
						</div>
					</div>
					
				</div>
				<div class="rounded-lg bg-gray-200 p-5">
						<table class="w-full">
							<tr >
								<th class="border-2 border-black p-2 border-t-0">№</th>
								<th class="border-2 border-black p-2 border-t-0">Товар и услуга</th>
								<th class="border-2 border-black p-2 border-t-0">Ед. мер.</th>
								<th class="border-2 border-black p-2 border-t-0">Кол-во</th>
								<th class="border-2 border-black p-2 border-t-0">Скидка</th>
								<th class="border-2 border-black p-2 border-t-0">Стоимость</th>
								
							</tr>
							<tr>
								
							</tr>
						</table>
					</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Layout from '@/Shared/Layout'

export default {
	metaInfo: { title: 'Договоры' },
	layout: Layout,
}

</script>