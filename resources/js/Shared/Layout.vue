<template>
<div>
    <portal-target name="dropdown" slim />
    <div class="md:flex md:flex-col">
        <div class="md:h-screen md:flex md:flex-col">
            <div class="menu_bar md:flex  px-3 md:px-10">
                <div class=" md:flex-shrink-0 pr-6 py-2 flex items-center justify-between md:justify-center">
                    <inertia-link class="mt-1" href="/">
                        <img class="w-32" src="/img/menu_logo.png">
                    </inertia-link>
                </div>

                <div class="w-full  md:py-0 md:px-0 text-sm md:text-md flex justify-start items-center">
                    <div class="mt-1">
                        <div class="relative">
                            <input class="bg-indigo-500 w-64 rounded-full pl-3 pr-10 py-1 text-white text-sm leading-5" /> 
                            <div class="absolute inset-y-0 right-2 top-1 text-white">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="-4 -2 24 24" class="w-4 h-4">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="ml-8 mt-1 flex justify-start">

              
                        <div class="ml-8">
                                <inertia-link class="flex items-center group py-3" :href="route('tasks')">
                                
                                <div :class="isUrl('tasks') ? 'text-white font-bold' : 'text-white group-hover:text-white font-normal'">Задачи</div>
                                </inertia-link>
                            </div>
                            <div class="ml-8">
                                <inertia-link class="flex items-center group py-3" :href="route('groups')">
                                
                                <div :class="isUrl('groups') ? 'text-white font-bold' : 'text-white group-hover:text-white font-normal'">Группы</div>
                                </inertia-link>
                            </div>
                            <div class="ml-8">
                                <inertia-link class="flex items-center group py-3" :href="route('organizations')">
                                
                                <div :class="isUrl('organizations') ? 'text-white font-bold' : 'text-white group-hover:text-white font-normal'">Клиенты</div>
                                </inertia-link>
                            </div>
                            
                            <div class="ml-8">
                                <inertia-link class="flex items-center group py-3" :href="route('deals')">
                                
                                <div :class="isUrl('deals') ? 'text-white font-bold' : 'text-white group-hover:text-white font-normal'">Сделки</div>
                                </inertia-link>
                            </div>
                            <div class="ml-8">
                                <inertia-link class="flex items-center group py-3" :href="route('documents')">
                                
                                <div :class="isUrl('documents') ? 'text-white font-bold ' : 'text-white group-hover:text-white font-normal'">Документы</div>
                                </inertia-link>
                            </div>
                            <div class="ml-8">
                                <inertia-link class="flex items-center group py-3" :href="route('reports')">
                                
                                <div :class="isUrl('reports') ? 'text-white font-bold' : 'text-white group-hover:text-white font-normal'">Отчеты</div>
                                </inertia-link>
                            </div>
                            <div class="ml-8">
                                <inertia-link class="flex items-center group py-3" :href="route('calendar')">
                                
                                <div :class="isUrl('calendar') ? 'text-white font-bold' : 'text-white group-hover:text-white font-normal'">Календарь</div>
                                </inertia-link>
                            </div>
                    </div>


                </div>
                <dropdown class="mt-1 w-48" placement="bottom-end">
                    <div class="text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600  whitespace-nowrap">
                        <img :src="'/' + $page.props.auth.user.photo_path" class="h-10 w-10 rounded-full" />
                    </div>
                    <div slot="dropdown" class="mt-2 py-2 shadow-xl bg-white rounded text-sm">
                        <inertia-link class="block px-6 py-2 hover:bg-indigo-500 hover:text-white" :href="route('users.edit', $page.props.auth.user.id)">Профиль</inertia-link>
                        <inertia-link v-if="$page.props.auth.user.owner" class="block px-6 py-2 hover:bg-indigo-500 hover:text-white" :href="route('users')">Сообщения</inertia-link>
                        <inertia-link class="block px-6 py-2 hover:bg-indigo-500 hover:text-white w-full text-left" :href="route('logout')" method="post" as="button">Выйти</inertia-link>
                    </div>
                </dropdown>
            </div>
            <div class="md:flex md:flex-grow md:overflow-hidden">

                <div class="md:flex-1 px-4 py-8 md:px-10 md:overflow-y-auto bg-cover auth" scroll-region>
                    <flash-messages />
                    <slot />
                </div> 

            </div>

        </div>
    </div>
</div>

</div>
</template>

<script>
import Icon from '@/Shared/Icon'
import Logo from '@/Shared/Logo'
import Dropdown from '@/Shared/Dropdown'
import MainMenu from '@/Shared/MainMenu'
import FlashMessages from '@/Shared/FlashMessages'

export default {
    components: {
        Dropdown,
        FlashMessages,
        Icon,
        //Logo,
        //MainMenu,
    },
    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1)
            if (urls[0] === '') {
                return currentUrl === ''
            }
            return urls.filter(url => currentUrl.startsWith(url)).length
        },
    },
} 
</script>
