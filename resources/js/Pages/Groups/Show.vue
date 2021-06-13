<template>
<div class="flex flex-col h-full">
    <div class="flex flex-row justify-between">
        <div v-on:mouseover="showPencil" v-on:mouseleave="hidePencil" v-on:click="edit" class="relative w-5/12 mb-5">
            <input @change="block" id="group_name" type="text" disabled class="border-b-2 border-gray-200 w-11/12 text-black font-medium bg-transparent text-lg" value="Название группы">
            <svg v-if="pencil" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" class="absolute top-0 right-10 w-8 h-8" ><path d="M9.6 40.4l2.5-9.9L27 15.6l7.4 7.4-14.9 14.9-9.9 2.5zm4.3-8.9l-1.5 6.1 6.1-1.5L31.6 23 27 18.4 13.9 31.5z"/><path d="M17.8 37.3c-.6-2.5-2.6-4.5-5.1-5.1l.5-1.9c3.2.8 5.7 3.3 6.5 6.5l-1.9.5z"/><path d="M29.298 19.287l1.414 1.414-13.01 13.02-1.414-1.412z"/><path d="M11 39l2.9-.7c-.3-1.1-1.1-1.9-2.2-2.2L11 39z"/><path d="M35 22.4L27.6 15l3-3 .5.1c3.6.5 6.4 3.3 6.9 6.9l.1.5-3.1 2.9zM30.4 15l4.6 4.6.9-.9c-.5-2.3-2.3-4.1-4.6-4.6l-.9.9z"/></svg>
        </div>
        <div class="flex flex-row gap-8 w-2/12 justify-end">
            <button @click="showAddUserDialog" class="text-sm leading-8 px-2 login_button rounded-full text-white h-8 w-full text-xs justify-center items-center font-light">
                <span>Добавить участника</span>
            </button>
        </div>
        <div class="flex flex-row gap-8 w-7/12 justify-end">

            <div>
                <img class="h-10" src="/img/message.png" @click="$page.props.auth.sidebar = true" />
            </div>

        </div>

    </div>
    <div class="flex flex-row gap-5 flex-auto">



        <form v-on:submit.prevent="addMessage" class="w-4/12 bg-white rounded-2xl p-5 mt-5 mh-calc">
            <div class="relative h-full flex flex-col justify-between">
                <div class="flex flex-row justify-between border-b border-gray-200 pb-4">
                    <p class="font-medium">Информация для группы</p>
                </div>
                <div class="flex-auto py-4">
                    <label  class="bg-transparent text-blue rounded-lg tracking-wide uppercase">
                    <div class="relative w-6/12 h-32 bg-gray-100 rounded-lg" v-on:mouseover="showLogoDialog" v-on:mouseleave="hideLogoDialog">
                        <img v-if="group.logo_path" :src="logo_path" class="h-full">

                        
                            <svg v-if="upload" class="absolute bottom-0 right-0 w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                           
                           
                        
                    </div>
                     <input id="#file" type='file' class="hidden" @change="handleFileUpload"/>
                        </label>
                    <div class="mt-10">
                        Описание группы
                        <div class="mt-3" @click="description">
                            <textarea class="w-full" v-on:keyup.13="block_des" rows="4" disabled placeholder="Описание..." id="des" name="description">{{group.description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>

                <div class="w-8/12 bg-white rounded-2xl p-5 mt-5 ">
            <div>
                <div class="flex gap-4 justify-start">
                    <div class="">
                        <p class="font-medium text-base">Участники группы ({{ members.length }})</p>
                    </div>
                </div>

                <hr class="mt-3 h-2 border-gray-200">

                <div class="flex gap-4 mt-4 ">
                    <div class="w-12/12">
                        <!--<div class="bg-gray-100 rounded-2xl relative w-full h-40"></div>
                        <div class="p-4 rounded-2xl border border-gray-200 my-3 h-28">
                            <p class="text-gray-200 text-xs">Описание группы</p>
                        </div> -->
                       
                        <!--<button @click="tech" class="mt-3 text-sm leading-8 px-2 login_button rounded-full text-white h-8 w-full  text-xs flex justify-center items-center font-light">
                            <span>Администраторы</span>
                        </button>-->
                        <div class="w-12/12 overflow-auto ">

                        <div class="my-2" v-for="member in members">
                            <person-card :id="member.id" :src="'/storage/' + member.photo_path" :fullname="member.name" :job="member.position.name"></person-card>
                        </div>

                    </div>
                    </div>
                    
                </div>

            </div>
        </div>

        <!--<div class="w-3/12 bg-white rounded-2xl p-5 mt-5 mh-calc">
            <div class="flex flex-row justify-between mb-1">
                <p class="font-medium">Файлы</p>
                 <div class="flex flex-row gap-2">
            <div class="relative inline-flex">
                <svg class="w-2 h-2 absolute  right-0 m-2  pointer-events-none fill-current text-white fill-current text-white"  viewBox="0 0 412 232">
                    <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" />
                </svg>
                <select v-on:change="changeItem($event)" class="text-white text-xs bg-blue-500 border border-gray-300 rounded-full text-gray-100 h-6 pl-5 pr-7 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                    <option>сегодня</option> 
                    <option>месяц</option>
                    <option>год</option>
                    <option>все время</option>
                </select>
            </div>
            <p class="task-button rounded-full text-white w-6 h-6 flex pl-2 items-center text-xs">2</p>
          </div> 
            </div>
            <hr class="mt-3">
            <div class="mt-3">
                <div class="flex h-6 justify-start gap-4 mb-3">
                    <img class="y-3" src="/img/icons/Word.png" />
                    <div class="flex flex-col align-start">
                        <p class="pt-1 text-sm">Отчет по сотрудникам.docx</p>
                        <p class="pt-1 text-2xs text-gray-200">Имя Фамилия</p>
                    </div>
                    <button class="rounded-full text-white h-6 pl-3 pr-3 flex">
                        <icon name="download" class="w-4 pt-1" />
                    </button>
                </div>
                <div class="flex h-6 justify-start gap-4 mb-3">
                    <img class="y-3" src="/img/icons/PPT.png" />
                    <div class="flex flex-col align-start">
                        <p class="pt-1 text-sm">Презентация продукта.pptx</p>
                        <p class="pt-1 text-2xs text-gray-200">Имя Фамилия</p>
                    </div>
                </div>
            </div>

        </div>-->
    </div>

    <!--Модалки групп-->
    <modal name="addUser">
        <members :members="members" :group_id="group.id"></members>
    </modal>
   
</div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'
import PersonCard from '@/Shared/PersonCard.vue'
import Members from './Members.vue'
import Icon from '@/Shared/Icon'
import axios from "axios";

export default {
    metaInfo() {
        return {
            title: `Группа`,
        }
    },
    components: {
        LoadingButton,
        SelectInput,
        TextInput,
        TrashedMessage,
        Icon,
        PersonCard,
        Members
    },
    layout: Layout,
    props: {
        group: Object,
        members: Array, 
    },
    remember: 'form',
    data() {
        return {
            logo_path: '/storage/'+this.group.logo_path,
            logo: null,
            upload: false,
            pencil: false,
            message: "",
            form: this.$inertia.form({
                status: 1,
            }),
            users: [],
            members: []
        }
    },
    methods: {
        showAddUserDialog() {
            this.$modal.show("addUser");
        },
        addMessage() {
            this.message = "";
            // this.form.post(this.route('tasks.message',{
            //   message:this.message,
            //   id: this.task.id,
            // }));
        },
        changeItem: function changeItem(event) {
            switch (String(event.target.value)) {
                case "месяц":
                    this.taskCounter = 0;
                    this.mytasks.splice(0);
                    var date = new Date();
                    date.setDate(date.getDate() + 30);
                    //this.mytasks.pop(0);
                    //console.log(this.mytasks.filter(x => new Date(x.deadline) < Date.now()))
                    var month = this.tasks.filter(x => new Date(x.deadline) < date);

                    for (var i = month.length - 1; i >= 0; i--) {
                        this.mytasks.push(month[i]);

                        this.taskCounter++;
                    }
                    console.log(this.mytasks);

                    break;
                case "год":
                    this.taskCounter = 0;
                    this.mytasks.splice(0);
                    var date = new Date();
                    date.setDate(date.getDate() + 300);
                    //this.mytasks.pop(0);
                    //console.log(this.mytasks.filter(x => new Date(x.deadline) < Date.now()))
                    var month = this.tasks;

                    for (var i = month.length - 1; i >= 0; i--) {
                        this.mytasks.push(month[i]);
                        this.taskCounter++;
                    }
                    console.log(this.mytasks);

                    break;
                case "сегодня":
                    this.taskCounter = 0;
                    this.mytasks.splice(0);
                    var date = Date.now();
                    //this.mytasks.pop(0);
                    //console.log(this.mytasks.filter(x => new Date(x.deadline) < Date.now()))
                    var month = this.tasks.filter(x => new Date(x.deadline) > date);

                    for (var i = month.length - 1; i >= 0; i--) {
                        this.mytasks.push(month[i]);
                        this.taskCounter++;
                    }
                    console.log(this.mytasks);

                    break;
                default:
                    this.taskCounter = 0;
                    this.mytasks.splice(0);

                    var month = this.tasks;

                    for (var i = month.length - 1; i >= 0; i--) {
                        this.mytasks.push(month[i]);
                        this.taskCounter++;
                    }
                    console.log(this.mytasks);
            }
        },
        download() {
            alert("В работе");
        },
        tech() {
            alert("Технические работы");
        },
        decline() {
            alert("отклонить");
        },
        accept() {
            this.form.status = 'в работе';
            this.form.put(this.route('tasks.accept', this.task.id))
        },
        showLogoDialog(){
            this.upload = true;
        },
        hideLogoDialog(){
            this.upload = false;
        },
        handleFileUpload(event){
            
            
            
            this.logo = event.target.files[0];  
            
            const fd = new FormData();
            fd.append('image', this.logo);
            fd.append('group_id', this.group.id);
            axios.post('upload',fd)
            .then(res => {
                console.log(res.data);
                this.logo_path = '/storage/'+res.data;
            });
        },
        showPencil(){
            this.pencil = true;
        },
        hidePencil(){
            this.pencil = false;
        },
        edit(){
            document.getElementById("group_name").disabled = false;
        },
        block(){

            var input = document.getElementById("group_name");
            input.disabled = true;
            const fd = new FormData();
            fd.append('group_name', input.value);
            fd.append('group_id', this.group.id);
            axios.post('rename',fd)
            .then(res => {
                console.log(res.data);
            });
        },
        description(){
            document.getElementById("des").disabled = false;
        },
        block_des(){
            var des = document.getElementById("des");

            const fd = new FormData();
            fd.append('description', des.value);
            fd.append('group_id', this.group.id);
             axios.post('description',fd)
            .then(res => {
                console.log(res.data);
            });
            des.disabled = true;
        }
    },
}
</script>
