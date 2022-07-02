<template>
    <div class="navbar-mega-menu">
        <a :href="this.users" class="navbar-mega-menu-item">
            <div class="navbar-mega-menu-item-icon" style="background: rgba(50,149,255,0.3); color: #3295ff;">
                <i class="fas fa-fw fa-1x fa-users"></i>
            </div>
            <div class="navbar-mega-menu-text">
                <div class="navbar-mega-menu-item-text-header">
                    Users
                </div>
                <div class="navbar-mega-menu-item-text-caption">
                    Our ever-growing list of lovely community members <3
                </div>
            </div>
        </a>
        <a :href="this.leaderboards" class="navbar-mega-menu-item dont-fade">
            <div class="navbar-mega-menu-item-icon" style="background: rgba(76,211,171,0.3); color: #4CD3AB;">
                <i class="fas fa-fw fa-1x fa-clipboard-list"></i>
            </div>
            <div class="navbar-mega-menu-text">
                <div class="navbar-mega-menu-item-text-header">
                    Leaderboards
                </div>
                <div class="navbar-mega-menu-item-text-caption">
                    View where you stand on the leaderboard and who's on the top.
                </div>
            </div>
        </a>

        <a :href="this.timeboards" class="navbar-mega-menu-item dont-fade">
            <div class="navbar-mega-menu-item-icon" style="background: rgba(76,211,171,0.3); color: #4CD3AB;">
                <i class="fas fa-fw fa-1x fa-stopwatch"></i>
            </div>
            <div class="navbar-mega-menu-text">
                <div class="navbar-mega-menu-item-text-header">
                    Time - Leaderboards
                </div>
                <div class="navbar-mega-menu-item-text-caption">
                    View the top players in hours played here!
                </div>
            </div>
        </a>

        <a :href="this.staff" class="navbar-mega-menu-item dont-fade">
            <div class="navbar-mega-menu-item-icon" style="background: rgba(139,103,205,0.3); color: #8B67CD;">
                <i class="fas fa-fw fa-1x fa-shield-alt"></i>
            </div>
            <div class="navbar-mega-menu-text">
                <div class="navbar-mega-menu-item-text-header">
                    Staff
                </div>
                <div class="navbar-mega-menu-item-text-caption">
                    Our verified staff members awaiting your call for assistance.
                </div>
            </div>
        </a>

        <a :href="this.bans" class="navbar-mega-menu-item dont-fade">
            <div class="navbar-mega-menu-item-icon" style="background: rgba(243,107,107,0.3); color: #F36B6B;">
                <i class="fas fa-fw fa-1x fa-flag"></i>
            </div>
            <div class="navbar-mega-menu-text">
                <div class="navbar-mega-menu-item-text-header">
                    Bans
                </div>
                <div class="navbar-mega-menu-item-text-caption">
                    A list of all banned users to protect regular users.
                </div>
            </div>
        </a>
    </div>
</template>

<script>
    export default {
        name: "CommunityComponent",
        props: [
            'leaderboards',
            'timeboards',
            'staff',
            'bans',
            'users'
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
