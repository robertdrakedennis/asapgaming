<style>
    .author-img-overlay::before{
        content: '';
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        @if($thread->user->post_background != null)
        background: url('{{ Storage::url($thread->user->post_background) }}') no-repeat center;
        @endif
        -webkit-background-size: cover !important;
        background-size: cover !important;
        -webkit-mask-image:-webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0, .5)), to(rgba(0,0,0,0)));
        mask-image: linear-gradient(to bottom, rgba(0,0,0, .55), rgba(0,0,0,0) 75%);
    }

    .reply-img-overlay::before{
        content: '';
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        @auth
        @if(Auth::user()->post_background != null)
        background: url('{{ Storage::url(Auth::user()->post_background) }}') no-repeat center;
        @endif
        @endauth
        -webkit-background-size: cover !important;
        background-size: cover !important;
        -webkit-mask-image:-webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0, .5)), to(rgba(0,0,0,0)));
        mask-image: linear-gradient(to bottom, rgba(0,0,0, .55), rgba(0,0,0,0) 75%);
    }

    @foreach($replies as $reply)
        .avatar-img-overlay-{{$reply->id}}::before{
        content: '';
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        @if($reply->user->post_background != null)
        background: url('{{ Storage::url($reply->user->post_background) }}') no-repeat center;
        @endif
        -webkit-background-size: cover !important;
        background-size: cover !important;
        -webkit-mask-image:-webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0, .5)), to(rgba(0,0,0,0)));
        mask-image: linear-gradient(to bottom, rgba(0,0,0, .55), rgba(0,0,0,0) 75%);
    }
    @endforeach
</style>