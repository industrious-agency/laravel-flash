@if (count($flash))
    <div class="flash-messages">
        @foreach ($flash as $message)
            <div class="alert alert-{{ $message['class'] }} alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! $message['message'] !!}
            </div>
        @endforeach
    </div>
@endif
