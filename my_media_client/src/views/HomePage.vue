<template>
  <div class="d-flex justify-content-center py-3">
    <p class="btn btn-danger btn-sm text-white me-3" @click="home()" v-if="!tokenStatus">Home</p>
    <p class="btn bg-dark btn-sm text-white" @click="login()" v-if="!tokenStatus">Login</p>
    <p class="btn bg-dark btn-sm text-white" @click="logout()" v-if="tokenStatus">Logout</p>
  </div>
    <div>
    
        <!-- Whats New Start -->
        <section class="whats-news-area pt-50 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-3 col-md-3">
                                <div class="section-tittle mb-30">
                                    <h3>Whats New </h3>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="properties__button">
                                    <!--Nav Button  -->
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"  role="tab" aria-controls="nav-home" aria-selected="true" @click="categorySearch('')">All</a
                        >
                        <a
                          class="nav-item nav-link"
                          id="nav-profile-tab"
                          data-toggle="tab"
                         
                          role="tab"
                          aria-controls="nav-profile"
                          aria-selected="false"
                          @click="categorySearch(category.category_id)"
                          v-for="(category,index) in categoryList" :key="index">{{category.title}}</a
                        >
                        
                      </div>
                    </nav>
                    <!--End Nav Button  -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="d-flex justify-content-end offset-9 mb-4">
                    <input type="text" class="form-control col-3 " v-model="searchKey" v-on:keyup.enter="search()">
                    <i class="fa-solid fa-magnifying-glass mt-2 ms-3" @click="search()" ></i>
                  </div>
                  <!-- Nav Card -->
                  <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div
                      class="tab-pane fade show active"
                      id="nav-home"
                      role="tabpanel"
                      aria-labelledby="nav-home-tab"
                    >
                      <div class="whats-news-caption">
                       <div >
                         <div v-if="!tokenStatus">
                          <div class="mt-5 d-flex align-items-center p-5 bg-danger rounded" style="height:30vh;margin-left:100px;">
                            <h1 class="text-white">You don't have permission for this data.</h1>
                          </div>
                         </div>
                         <div v-if="tokenStatus" class="row">
                          <div class="mt-5 d-flex align-items-center" style="height:50vh;margin-left:400px;" v-if="postLists.length == 0">
                            <h1 class=" text-danger">There is no data!</h1>
                          </div>
                          <div class="col-lg-6 col-md-6" v-for="(post,index) in postLists" :key="index" v-else-if="postLists.lengtn != 0">
                              <div class="single-what-news mb-100" @click="newDetails(post.post_id)">
                                <div class="what-img">
                                  <img
                                    v-bind:src="post.image"
                                    alt=""
                                  />
                                </div>
                                <div class="what-cap">
                                  <span class="color1">My AZ News</span>
                                  <h4>
                                    <a href="details.html"
                                      >{{post.title}}</a
                                    >
                                  </h4>
                                </div>
                              </div>
                            </div>
                         </div>
                       </div>
                      </div>
                    </div>
                  
                  </div>
                  <!-- End Nav Card -->
                </div>
              </div>
            </div>
           </div>
           </div>
        </section>
        <!-- Whats New End -->

        <!--Start pagination -->
        <div class="pagination-area pb-45 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item">
                                        <a class="page-link" href="details.html"><span class="flaticon-arrow roted"></span
                      ></a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="details.html">01</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="details.html">02</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="details.html">03</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="details.html"><span class="flaticon-arrow right-arrow"></span
                      ></a>
                                            </li>
                                            </ul>
                                    </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End pagination  -->
    </div>
</template>
<script src="../js/homePage.js"></script>
