<template>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div id="theform" class="col-8">
                <form @submit.prevent="register">
                    <!-- name input -->
                    <label class="form-label" for="form2Example1">name</label>
                    <div class="form-outline mb-4">
                        <input type="text" id="form2Example1" class="form-control" v-model.trim="name" />
                    </div>

                    <!-- Email input -->
                    <label class="form-label" for="form2Example1">Email address</label>
                    <div class="form-outline mb-4">
                        <input type="email" id="form2Example1"  class="form-control" v-model.trim="email" />
                    </div>

                    <!-- Password input -->
                    <label class="form-label" for="form2Example2">Password</label>
                    <div class="form-outline mb-4">
                        <input type="password" id="form2Example2" class="form-control"  v-model.trim="password" />
                    </div>

                    <!-- confirm_passowrd input -->
                    <label class="form-label" for="form2Example2">confirm password</label>
                    <div class="form-outline mb-4">
                        <input type="confirm_passowrd" id="form2Example2" class="form-control"  v-model.trim="password_confirmation" />
                    </div>

                    <!-- <label class="form-label" for="customFile">file input</label>
                     <input
                     ref="file"
                     v-on:change="uploadFile()"
                      type="file" class="form-control" id="customFile" /> -->
                      <div style="text-align: center" class="mb-3">
                        <label for="myfile" class="form-label">myfile:</label>
                        <input
                          type="file"
                          id="myfile"
                          ref="myfile"
                          @change="handleFileUpload($event)"
                          class="form-control"
                          name="myfile"
                        />
                      </div>
                    <!-- Submit button -->
                    <button type="button" @click="register()" class="btn btn-primary btn-block mb-4">
                        Register in
                    </button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>
                            do you a member?
                            <router-link to="/login">login</router-link>
                        </p>
                    </div>
                </form>

                <button @click="test">vccv</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
data() {
    return {
  name:'name',
  email:'islaxxzxzxmzcm1995@gmail.com',
  password:'@Islam1995',
  password_confirmation:'@Islam1995',
  file:'' 
    }
},mounted() {

      
    console.log(this.$refs)
    console.log(this.$refs.myfile)
    console.log(file)

},
methods:{
//         register(){
//            const data={
//   name:this.name,
//   email:this.email,
//   password:this.password,
//   password_confirmation:this.password_confirmation,
//   image:this.file,
//            } 
           
//     // let form = new FormData();
//     //   form.set("name", this.name);
//     //   form.set("email", this.email);
//     //   form.set("password", this.password);
//     //   form.set("password_confirmation", this.password_confirmation);
//     //   form.set("image", this.file);



// this.$store.dispatch('register',data)
// // setTimeout(()=> console.log(this.$store.state.name),3000)
// this.$router.replace('/home')
// console.log(file)
//         },
register(){
      
    const formData = new FormData();
        formData.append('name', this.name);
        formData.append('email', this.email);
        formData.append('password', this.password);
        formData.append('password_confirmation', this.password_confirmation);
        formData.append('image', this.file);
       
    axios.post("http://127.0.0.1:8000/api/register",formData)
                .then((response) => {
                    console.log(response);
                    localStorage.setItem(
                        "token",
                        response.data.data.user.token
                    );
                    localStorage.setItem("name", response.data.data.user.name);
                    context.commit[
                        ("setuser",
                        {
                            token: response.data.data.user.token,
                            name: response.data.data.user.name,
                        })
                    ];
                })
                .catch((error) => console.log(error));

        // this.$store.dispatch('register',formData)
        this.$router.replace('/home')
        },

        uploadFile(){
            this.file = this.$refs.file.files[0]; 
                  
         },
         test(){
    // console.log(this.$refs)
    // console.log(this.$refs.file.files[0])
    console.log(this.file)         
},handleFileUpload(event){
  this.file = event.target.files[0];
},
    }
};
</script>

<style scoped>
#theform {
    padding-top: 30px;
}
</style>