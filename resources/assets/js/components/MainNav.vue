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
                        CMS
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setup <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="#/campaings">Campaigns</a></li>
                            <li><a href="#/audiences">Audiences</a></li>
                            <li><a href="#/regions">Regions</a></li>
                            
                           
                          </ul>
                        </li>
                       <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">System <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="#/partners">Partners</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#/users">Users</a></li>
                          </ul>
                        </li>
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                  
                </div>
            </div>
        </nav>
</template>

<script>
    export default {
        mounted() {
           
        }
    }
</script>
