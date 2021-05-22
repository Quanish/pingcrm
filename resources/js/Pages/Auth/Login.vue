<template>
  <div class="auth bg-cover h-screen flex justify-center items-center ">
  
    <div class="w-full grid grid-cols-2 gap-2 place-items-center">
      <img class="px-50 w-32 h-32" src="img/oasis_logo.png">
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="login">
        <div class="px-10 py-12">
          <h3 class="text-center font-bold text-2xl">ВХОД В ЛИЧНЫЙ КАБИНЕТ</h3>
          <div class="mx-auto mt-6 w-24 border-b-2" />
          <text-input v-model="form.email" :error="form.errors.email" class="mt-10" label="Логин" type="email" autofocus autocapitalize="off" />
          <br>
          <div class="passwordField" style="position:relative;">
            <text-input id="show" name="show" v-model="form.password" type="password" :class="mt-6"  :maxlength='maxlength' :placeholder="placeholder" v-bind:value="value"  v-on:input="$emit('input', $event.target.value)" label="Пароль"  />
            <a id="eyeshow" @click="showPassword" style="position: absolute; right: 5px; top: 30px;"><img class="h-8" src="img/eyes/private.png"></a>
            <a id="eyehide" @click="hidePassword" style="position: absolute; right: 5px; top: 30px;visibility:hidden;"><img class="h-8" src="img/eyes/view.png"></a>
          </div>
          


           
            
           
     
          

          <label class="mt-6 select-none flex items-center" for="remember">
            <input id="remember" v-model="form.remember" class="mr-1" type="checkbox" />
            <span class="text-sm">Запомнить</span>
           
          </label>
          <div class="flex flex-col gap-4 mt-4 align-items-center">
            <button :loading="form.processing" class="login_button rounded-full text-white h-10" type="submit">Войти</button>

            <a class="hover:underline bg-gray-200 h-10 rounded-full text-gray-500  flex justify-center inline-block align-middle" tabindex="-1" @click="forget"><p class="mt-3">Забыли пароль?</p></a>

            <center>или</center>
            <a class="hover:underline rounded-full h-10 bg-gray-500 text-white flex justify-center" tabindex="-1" @click="post"><p class="mt-3">Войти через почту</p></a>
          </div>  
        </div>
        <div class="px-10 py-4 bg-gray-100 border-t border-gray-100 flex justify-between items-center">
          
          
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Logo from '@/Shared/Logo'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  metaInfo: { title: 'Login' },
  components: {
    LoadingButton,
    Logo,
    TextInput,
  },
  data() {
    return {
      form: this.$inertia.form({
        email: 'johndoe@example.com',
        password: 'secret',
        remember: false,
      }),
    }
  },
  methods: {
    post(){
      alert("технические работы");
    },
    forget(){
      alert("технические работы");
    },
    show(){
      alert("test");
    },
    showPassword() {
      var pas = document.getElementById("show");
      var eye = document.getElementById("eyeshow");
      var eye1 = document.getElementById("eyehide");
            pas.type = 'text';
            eye.style.visibility = "hidden";
            eye1.style.visibility = "visible";
    },
    hidePassword() {
            var pas = document.getElementById("show");
            var eye = document.getElementById("eyeshow");
            var eye1 = document.getElementById("eyehide");
            pas.type = 'password';
            eye.style.visibility = "visible";
            eye1.style.visibility = "hidden";
    },
    login() {
      this.form
        .transform(data => ({
          ...data,
          remember: data.remember ? 'on' : '',
        }))
        .post(this.route('login.attempt'))
    },
  },
}
</script>
