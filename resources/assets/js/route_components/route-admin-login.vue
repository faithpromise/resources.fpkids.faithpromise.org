<template>
  <div class="Login">
    <div class="Login-brand">
      <img class="Login-logo" src="/images/fpkids.svg">
      <h1 class="Login-name">Resources</h1>
    </div>
    <div class="Login-body">

      <div class="Login-header">
        <h2 class="Login-title">Admin Login</h2>
        <p class="Login-error" v-bind:class="{ 'has-error': error }">
          <strong>Unable to login.</strong> Please check your email and password.
        </p>
      </div>

      <form class="LoginForm" v-on:submit.prevent="submit">
        <div class="LoginForm-group">
          <input class="LoginForm-control" type="email" placeholder="Email address" v-model="credentials.email" v-on:focus="reset_error">
          <svg class="LoginForm-icon">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#email"></use>
          </svg>
        </div>
        <div class="LoginForm-group">
          <input class="LoginForm-control" type="password" placeholder="Password" v-model="credentials.password" v-show="!is_password_visible" v-on:focus="reset_error">
          <input class="LoginForm-control" type="text" placeholder="Password" v-model="credentials.password" v-show="is_password_visible" v-on:focus="reset_error">
          <svg class="LoginForm-icon LoginForm-icon--password" v-on:click="toggle_password">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#eye" v-bind:xlink:href="'#' + (is_password_visible ? 'eye' : 'eye-slash')"></use>
          </svg>
        </div>

        <button class="LoginForm-submit">Login</button>

      </form>

    </div>
  </div>
</template>

<script>
    import auth from '../auth';

    export default {

        data: function () {
            return {
                error:               null,
                is_password_visible: false,
                credentials:         {
                    email:    '',
                    password: ''
                }
            }
        },

        computed: {
            password_field_type: function () {
                return is_password_visible ? 'text' : 'password';
            }
        },

        methods: {

            submit: function () {
                this.reset_error();
                auth.login(this.credentials).catch(err => this.error = true);
            },

            toggle_password: function () {
                this.is_password_visible = !this.is_password_visible;
            },

            reset_error: function () {
                this.error = null;
            }

        }

    }
</script>