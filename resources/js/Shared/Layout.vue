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
                        <!-- <div class="relative">
                            <input class="bg-indigo-500 w-64 rounded-full pl-3 pr-10 py-1 text-white text-sm leading-5" /> 
                            <div class="absolute inset-y-0 right-2 top-1 text-white">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="-4 -2 24 24" class="w-4 h-4">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div> -->
                    </div>
                    <div class="ml-8 mt-1 flex justify-start">

              
                        <div class="ml-8">
                                <inertia-link class="flex items-center group py-3" :href="route('tasks')">
                                
                                <div :class="isUrl('tasks') ? 'text-white font-bold' : 'text-white group-hover:text-white font-normal'">Задачи</div>
                                </inertia-link>
                            </div>
                            <div class="ml-8">
                                <inertia-link class="flex items-center group py-3" :href="route('groups')">
                                
                                <div :class="isUrl('groups') ? 'text-white font-bold' : 'text-white group-hover:text-white font-normal'">Моя команда</div>
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
                        <div class="block px-6 py-2 hover:bg-indigo-500 hover:text-white" @click="showProfile">Профиль</div>
                        <inertia-link v-if="$page.props.auth.user.owner" class="block px-6 py-2 hover:bg-indigo-500 hover:text-white" :href="route('users')">Сообщения</inertia-link>
                        <inertia-link class="block px-6 py-2 hover:bg-indigo-500 hover:text-white w-full text-left" :href="route('logout')" method="post" as="button">Выйти</inertia-link>
                    </div>
                </dropdown>
            </div>
            <div class="md:flex md:flex-grow md:overflow-hidden " >

                <div class="md:flex-1 px-4 pt-6 pb-4 md:px-10 md:overflow-y-auto bg-cover bg-gray-100" scroll-region>
                    <!-- style="background: #f9fafb" -->
                    <slot />
                </div> 

            </div>

            <notifications group="foo" position="bottom right" />

            <div class="sidebar fixed  w-screen h-screen overflow-hidden flex  bg-black bg-opacity-50"
                :class="[$page.props.auth.sidebar ? 'left-0' : 'left-full']"
                v-if="$page.props.auth.sidebar" >
                <div class="w-1/5 cursor-pointer" @click="$page.props.auth.sidebar = false"></div>
                <o-chat class="w-4/5 bg-white duration-300  relative" :class="[$page.props.auth.sidebar ? 'left-0' : 'left-full']"/>
            </div>

            <div class="sidebar fixed  w-screen h-screen overflow-hidden flex  bg-black bg-opacity-50"
                :class="[$page.props.auth.sidebar_profile ? 'left-0' : 'left-full']"
                v-if="$page.props.auth.sidebar_profile" >
                <div class="w-3/5 cursor-pointer" @click="$page.props.auth.sidebar_profile = false"></div>
                
                <profile-page class="w-2/5 bg-white  relative" :class="[$page.props.auth.sidebar_profile ? 'left-0' : 'left-full']"></profile-page>    
 
            </div>
        </div>
    </div>
</div>

    
</div>
</template>

<script>
import Icon from '@/Shared/Icon'
import Dropdown from '@/Shared/Dropdown'
import OChat from '@/Shared/Chat'
import ProfilePage from '../Pages/Users/Edit'

export default {
    components: {
        Dropdown,
        Icon,
        OChat,
        ProfilePage
    },
    created() {

    },
    watch: {
        '$page.props.flash': {
            handler() {
                if(this.$page.props.flash.success !== null) {
                    this.$notify({
                        group: 'foo',
                        title: 'Успешно',
                        type: 'success',
                        duration: 5000,
                        text: this.$page.props.flash.success
                    });
                }

                if(this.$page.props.flash.error != null) {
                    this.$notify({
                        group: 'foo',
                        title: 'Ошибка',
                        type: 'error',
                        duration: 5000,
                        text: this.$page.props.flash.error
                    });
                }
                
            },
            deep: true,
        },
    },
    methods: {
        showProfile() {
            this.$page.props.auth.sidebar_profile = true
            this.$page.props.actions.selected_user = this.$page.props.auth.user.id
        },
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
