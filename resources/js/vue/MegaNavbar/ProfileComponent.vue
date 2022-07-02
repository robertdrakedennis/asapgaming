<template>
    <div class="navbar-mega-menu">
        <a :href="this.show" class="navbar-mega-menu-item">
            <div class="navbar-mega-menu-item-icon" style="background: rgba(23,162,184,0.3); color: #17A2B8;">
                <i class="fas fa-fw fa-1x fa-user-check"></i>
            </div>
            <div class="navbar-mega-menu-text">
                <div class="navbar-mega-menu-item-text-header">
                    Profile
                </div>
                <div class="navbar-mega-menu-item-text-caption">
                    You can view your profile by clicking here.
                </div>
            </div>
        </a>
        <form method="POST" :action="this.logout" class="navbar-mega-menu-item">
            <input type="hidden" name="_token" :value="csrf">
            <button type="submit" class="navbar-mega-menu-item" style="box-shadow: none !important; background: 0 0 !important; border: 0 !important; padding: 0; text-align: left !important;">
                <div class="navbar-mega-menu-item-icon" style="background: rgba(252,52,37,0.3); color: #FC3425;">
                    <i class="fas fa-fw fa-1x fa-door-open"></i>
                </div>

                <div class="navbar-mega-menu-text" id="logout">
                    <div class="navbar-mega-menu-item-text-header">
                        Logout
                    </div>
                    <div class="navbar-mega-menu-item-text-caption">
                        By clicking this link you'll be logged out. Come back soon!
                    </div>
                </div>
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ProfileComponent",
        props: [
            'show',
            'edit',
            'logout'
        ],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    }
</script>

<style scoped>

    .navbar-mega-menu-theme{
        background: white;
    }


    .tippy-tooltip.navbar-mega-menu-theme a{
        text-decoration: none !important;
        color: rgba(52, 58, 64, 0.5);
        -webkit-transition: all 0.25s;
        transition: all 0.25s;
    }

    .tippy-tooltip.navbar-mega-menu-theme a:hover{
        text-decoration: none !important;
        color: #343a40;
        -webkit-transition: all 0.25s;
        transition: all 0.25s;
    }
    .tippy-tooltip.navbar-mega-menu-theme {
        padding: 0;
        min-width: 340px;
        text-align: left;
        -webkit-box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
        box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
        background: #fff;
        color: #212529;
        border-radius: 3px;
    }
    .tippy-tooltip.navbar-mega-menu-theme .tippy-backdrop {
        background: 0 0;
    }
    .tippy-tooltip.navbar-mega-menu-theme .tippy-arrow {
        border-bottom-color: #fff;
    }
    .tippy-tooltip.navbar-mega-menu-theme .tippy-arrow:after {
        content: "";
        -webkit-border-radius: 4px 0 0 0;
        -moz-border-radius: 4px 0 0 0;
        border-radius: 4px 0 0 0;
        border-bottom: 7px solid #fff;
        border-right: 7px solid transparent;
        border-left: 7px solid transparent;
        margin: 1px 0 0 -7px;
        position: absolute;
    }
    .tippy-tooltip.navbar-mega-menu-theme .tippy-roundarrow {
        fill: #fff;
    }
    .navbar-mega-menu {
        padding: 15px;
    }
    .navbar-mega-menu a {
        color: rgba(52, 58, 64, 0.5);
        -webkit-transition: all 0.25s;
        transition: all 0.25s;
    }
    .navbar-mega-menu a:focus, .navbar-mega-menu a:hover {
        text-decoration: none;
        color: #343a40;
        -webkit-transition: all 0.25s;
        transition: all 0.25s;
    }
    .navbar-mega-menu-item {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin: 0 0 10px;
        padding: 10px;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .navbar-mega-menu-item:last-child {
        margin: 0 !important;
    }
    .navbar-mega-menu-item-icon {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-negative: 0;
        flex-shrink: 0;
        padding: 5px;
        border-radius: 50%;
        font-size: 20px;
        margin-right: 15px;
        width: 37px;
        height: 37px;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .navbar-mega-menu-item-text-header {
        font-size: 16px;
        font-weight: 500;
    }
    .navbar-mega-menu-item-text-caption {
        color: #6c757d;
        margin-top: 9px;
    }


     #logout{
         color: rgba(52,58,64,.5) !important;
         -webkit-transition: all 0.5s !important;
         -moz-transition: all 0.5s !important;
         -ms-transition: all 0.5s !important;
         -o-transition: all 0.5s !important;
         transition: all 0.5s !important;
     }
    #logout:hover{
        color: rgba(52,58,64,1) !important;
        -webkit-transition: all 0.5s !important;
        -moz-transition: all 0.5s !important;
        -ms-transition: all 0.5s !important;
        -o-transition: all 0.5s !important;
        transition: all 0.5s !important;
    }
</style>
