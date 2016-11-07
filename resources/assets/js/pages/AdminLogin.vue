<template>
  <div>

    <div v-if="error">{{ error }}</div>

    <form v-on:submit.prevent="login">
      <input type="email" v-model="credentials.email">
      <input type="password" v-model="credentials.password">
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
  import auth from '../auth';

  export default {

    data() {
      return {
        credentials: {
          email:    '',
          password: ''
        },
        error:       ''
      }
    },

    methods: {

      login() {
        console.log(this);
        auth.login(this, { email: this.credentials.email, password: this.credentials.password }, '/admin');
      }

    }

  }
</script>