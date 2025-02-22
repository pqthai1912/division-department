<div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
            {{-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button> --}}
        </div>
    @endif


    @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            <pre>{{ $message }}</pre>
            {{-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button> --}}
        </div>
    @endif


    @if ($message = Session::get('warning'))
        <div class="alert alert-warning" role="alert">
            <pre>{{ $message }}</pre>
            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
        </div>
    @endif


    @if ($message = Session::get('info'))
        <div class="alert alert-info" role="alert">
            <pre>{{ $message }}</pre>
            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
        </div>
    @endif


    {{-- @if ($errors->any())
        <div class="alert alert-danger bg-danger text-light border-0" role="alert">
            Please check the form below for errors
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif --}}
    @if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <div class="row form-group" style="margin-left:20px;">
            {{-- <ul> --}}
                @foreach ($errors->all() as $error)
                    {{-- <li>{{ $error }}</li> --}}{{ $error }}
                    @if(!$loop->last)
                        <br>
                    @endif
                @endforeach
            {{-- </ul> --}}
        </div>
    </div>
    @endif
</div>
