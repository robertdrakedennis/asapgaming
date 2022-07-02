<template>
    <div class="navbar-mega-menu">
        <a :href="this.discord" class="navbar-mega-menu-item">
            <div class="navbar-mega-menu-item-icon" style="background: rgba(142,160,225,0.3); color: #7289DA;">
                <i class="fab fa-fw fa-1x fa-discord"></i>
            </div>
            <div class="navbar-mega-menu-text">
                <div class="navbar-mega-menu-item-text-header">
                    Discord
                </div>
                <div class="navbar-mega-menu-item-text-caption">
                    Join our Discord to get the latest news and connect with people that are typically in-game.
                </div>
            </div>
        </a>
        <a :href="this.steam" class="navbar-mega-menu-item">
            <div class="navbar-mega-menu-item-icon" style="background: rgba(82,82,82,0.3); color: #393939;">
                <i class="fab fa-fw fa-1x fa-steam"></i>
            </div>
            <div class="navbar-mega-menu-text">
                <div class="navbar-mega-menu-item-text-header">
                    Steam
                </div>
                <div class="navbar-mega-menu-item-text-caption">
                    Join our group to get live news updates, critical info, and more.
                </div>
            </div>
        </a>
    </div>
</template>

<script>
    export default {
        name: "SocialComponent",
        props: [
            'discord',
            'steam'
        ]
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

</style>
