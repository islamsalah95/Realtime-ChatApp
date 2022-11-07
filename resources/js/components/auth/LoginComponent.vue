<template>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div id="theform" class="col-8">
                <form @submit.prevent="login">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Email address</label>
                        <input type="email" id="form2Example1" class="form-control" v-model.trim="email" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">Password</label>
                        <input type="password" id="form2Example2" class="form-control" v-model.trim="password"/>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col">
                            <!-- Simple link -->
                            <a href="#!">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button @click="login" type="button" class="btn btn-primary btn-block mb-4">
                        Sign in
                    </button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>
                            Not a member?
                            <router-link to="/register">Register</router-link>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
data() {
    return {
  email:'',
  password:'',
    }
},mounted() {},
methods:{
       async login(){
           const data={
  email:this.email,
  password:this.password,

           }          
await this.$store.dispatch('login',data)
await setTimeout(()=> console.log(window.location.reload()),1000)
this.$router.replace('/friends')

        }
    }
};
</script>

<style scoped>
#theform {
    padding-top: 30px;
}
</style>
