<template>
    <div class="d-flex justify-content-center py-3">
      <p class="btn btn-danger btn-sm text-white me-3" @click="home()" v-if="!tokenStatus">Home</p>
      <p class="btn bg-dark btn-sm text-white" @click="login()">Login</p>
    </div>
    <div class="container col-5 my-5 shadow-sm p-5">
        <form>
          <div class="alert alert-danger" role="alert" v-if="userStatus">
            The Credential do not match!
          </div>
            <div class="form-group my-3">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" v-model="userData.email">
              
            </div>
            <div class="form-group my-3">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" v-model="userData.password">
            </div>
           
            <button type="button" class="btn btn-sm btn-danger" @click="accountLogin()">Login</button>
            <!-- <button type="button" class="btn btn-sm btn-danger ms-4" @click="checkToken()">Check Token</button> -->
          </form>
    </div>

</template>

  
<script src="../js/loginPage.js"></script>

