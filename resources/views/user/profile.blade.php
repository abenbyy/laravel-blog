NIM: {{ $user->nim }}
<br>
Role: {{ $user->role }}
<br>
Name: {{ $user->name }}
<br>
Email: {{ $user->email }}
<br>
Profile: <br>
<img src="{{ asset("storage/".$user->profile) }}" alt="">
<br>
<br>
<br>
{{-- @can('update-profile', $user) --}}
    @if (auth()->user()->can('view', $user))
        <form action="{{ url("profile/{$user->id}") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="profile" id="">
            <button>Upload</button>
        </form> 
    @endif   
{{-- @endcan --}}

{{-- @if (auth()->user()->id == $user->id)
    
@endif --}}
