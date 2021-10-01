@if(session('alert'))
    <div id="global_alert" class="alert alert-{{session('alert')['type']}} alert-dismissible fade show shadow-lg" role="alert"
         data-duration="{{session('alert')['duration']}}">
        <strong>{{session('alert')['intro']}}</strong> {{session('alert')['message']}}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
