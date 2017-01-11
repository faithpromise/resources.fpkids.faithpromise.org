<template>
  <transition>
    <div class="LogoutWarning" v-show="countdown">
      <p class="LogoutWarning-text">Logging out in... {{ countdown }}</p>
      <span class="LogoutWarning-button" v-on:click="stay_logged_in">Stay Logged-In</span>
    </div>
  </transition>
</template>
<script>

    import auth from '../auth';

    let countdown_timer;
    let show_warning_at = 60;

    export default {

        data: function () {
            return {
                countdown: null
            }
        },

        watch: {
            '$route': function (to, from) {
                if (from.name === 'login') {
                    this.restart_countdown();
                }
            }
        },

        created() {
            this.restart_countdown();

            // Restart countdown after window / tab regaining focus
            document.addEventListener('visibilitychange', this.restart_countdown);

        },

        methods: {

            stay_logged_in() {
                auth.refresh().then(() => {
                    console.log('refreshed');
                    this.restart_countdown();
                });
            },

            restart_countdown() {

                if (countdown_timer) clearInterval(countdown_timer);

                // No need for logout warning if not logged in
                if (!auth.is_authenticated()) {
                    return;
                }

                let seconds_until_logout = auth.get_seconds_until_logout();
                this.countdown           = seconds_until_logout <= show_warning_at ? seconds_until_logout : null;

                countdown_timer = setInterval(() => {

                    seconds_until_logout--;

                    if (seconds_until_logout <= show_warning_at) {
                        this.countdown = Math.max(0, seconds_until_logout);
                    }

                    if (seconds_until_logout <= 0) {
                        clearInterval(countdown_timer);
                        return auth.logout();
                    }

                    // Restart countdown every 10 seconds to keep better sync
                    if (seconds_until_logout % 10 === 0) {
                        this.restart_countdown();
                    }

                }, 1000);

            }

        }

    }

</script>