@if (session('alert'))
    <div id="global_alert" class="alert alert-{{session('alert')['type']}} alert-dismissible fade show" role="alert">
        <strong>{{session('alert')['intro']}}</strong> {{session('alert')['message']}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
