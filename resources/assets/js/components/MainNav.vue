<template>
   <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="#/">
                        <i class="lnr lnr-code"></i> JSON<small>cms</small>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class=""><a href="#/"><span class="lnr lnr-home"></span> Home</a></li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="lnr lnr-layers"></i> Setup <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="#/campaigns"><i class="lnr lnr-pushpin"></i> Campaigns</a></li>
                                <li><a href="#/audiences"><i class="lnr lnr-tag"></i> Audiences</a></li>
                                <li><a href="#/regions"><i class="lnr lnr-earth"></i> Regions</a></li>
                                
                               
                              </ul>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="lnr lnr-cog"></i> System <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="#/partners"><i class="lnr lnr-apartment"></i> Partners</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#/users"><i class="lnr lnr-users"></i> Users</a></li>
                              </ul>
                        </li>
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="lnr lnr-user"></i> {{ user.name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a @click="logout"><i class="lnr lnr-exit"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>

                    </ul>
                </div>
            </div>
        </nav>
</template>

<script>
    export default {
        
        computed: {
           user(){
                return this.$parent.user;
           },

        },
        methods:{
            logout(){
                this.$http.post("/logout").then(response => {
            
                   window.location.href="/"
                    
                 });
            }
        }
    }
</script>
