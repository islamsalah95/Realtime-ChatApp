<template>
 <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      
        <li v-if="islogin" class="nav-item active">
          <a class="nav-link" href="#">
            <router-link to='/home'>Home</router-link>
            <span class="sr-only">(current)</span>
            </a>
        </li>
      
      
        <li v-if="!islogin" class="nav-item active">
          <a class="nav-link" href="#">
            <router-link to='/login'>Login</router-link>
            <span class="sr-only">(current)</span>
            </a>
        </li>

      



        <li v-if="!islogin" class="nav-item active">
          <a class="nav-link" href="#">
            <router-link to='/register'>Register</router-link>
            <span class="sr-only">(current)</span>
            </a>
        </li>


        <li v-if="islogin" class="nav-item active">
          <a class="nav-link" href="#">
            <router-link to='/friends'>Friends</router-link>
            <span class="sr-only">(current)</span>
            </a>
        </li>


        <li v-if="islogin" class="nav-item active">
          <a class="nav-link" href="#">
            <router-link to='/friendsRequests'>Requests</router-link>
            <span class="sr-only">(current)</span>
            </a>
        </li>


        <li v-if="islogin" class="nav-item active">
          <a class="nav-link" href="#">
            <router-link to='/users'>Users</router-link>
            <span class="sr-only">(current)</span>
            </a>
        </li>

        <li  v-if="islogin" class="nav-item active">
          <a class="nav-link" href="#">
            <a>{{username}}</a>
            <span class="sr-only">(current)</span>
            </a>
        </li>


        <li v-if="islogin" class="nav-item active">
          <a  @click="logout()" class="nav-link" href="#">
            Logout
            <span class="sr-only">(current)</span>
            </a>
        </li>
  
<!-- //////////////////////// -->
      </ul>

    </div>
  </nav>  
</template>
<script>
export default {
data() {
    return {
  username:localStorage.getItem('name'),
  islogin:localStorage.getItem('token'),
  userId: parseInt(localStorage.getItem("userId")),


    }
},
methods:{
        logout(){        
this.$store.dispatch('logout')
setTimeout(()=> console.log(window.location.reload()),1000)
this.$router.replace('/login')

        }
    },
    computed:{
      isLoggedIn(){
        
        return this.$store.getters.isAuthenticated ;

      },
      myname(){
        
        return this.$store.state.name
      }
    
    }
};
</script>
<style>
@import url("//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");

.navbar-icon-top .navbar-nav .nav-link > .fa {
  position: relative;
  width: 36px;
  font-size: 24px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
  font-size: 0.75rem;
  position: absolute;
  right: 0;
  font-family: sans-serif;
}

.navbar-icon-top .navbar-nav .nav-link > .fa {
  top: 3px;
  line-height: 12px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
  top: -10px;
}

@media (min-width: 576px) {
  .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
}

@media (min-width: 768px) {
  .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
}

@media (min-width: 992px) {
  .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
}

@media (min-width: 1200px) {
  .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
}
</style>

