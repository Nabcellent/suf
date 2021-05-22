@if (session('alert'))
    <div id="global_alert" class="alert alert-{{session('alert')['type']}} alert-dismissible fade show shadow-lg @if(!session('alert')) d-none @endif"
         role="alert" data-duration="{{session('alert')['duration']}}">
        <strong>{{session('alert')['intro']}}</strong> {{session('alert')['message']}}
        @isset(session('alert')['link'])
            <a href="{{ session('alert')['link']['url'] }}">{{ session('alert')['link']['title'] }}</a>
        @endisset
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!--<div id="global_alert" class="alert alert-success alert-dismissible fade show shadow-lg" role="alert" data-duration="100">
    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    @isset(session('alert')['link'])
        <a href="{{ session('alert')['link']['url'] }}">{{ session('alert')['link']['title'] }}</a>
    @endisset
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>-->
