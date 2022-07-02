@extends('layouts.master')
@section('css')
    @if($user->background !== null)
        <style>
            .avatar-img-overlay::before{
                background: url('{{ Storage::url($user->background) }}') no-repeat center;
            }
        </style>
    @endif
@endsection
@section('title', 'Notifications - ' . $user->name)

@section('body-background', 'bg-brand-black')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12" style="height: 100vh;">
                {{ Breadcrumbs::render('user', $user) }}
                <div class="card bg-brand-darker-grey">
                    <div class="card-header bg-transparent">
                        <h6 class="text-light">
                            Notifications
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($notifications as $notification)
                                <a class="text-light list-group-item bg-transparent border-0" style="text-decoration: none;" href="{{ route('users.notif.view',[$user, $notification]) }}">
                                    <div>@if($notification->read_at === null) <span class="badge badge-success">UNREAD</span> @endif {{ $notification->data['action'] }}</div>
                                    <div class="text-muted">about {{ $notification->created_at->diffForHumans()  }}</div>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="m-4 d-flex justify-content-end align-items-end">
                    {{  $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

