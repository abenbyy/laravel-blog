NIM: {{ auth()->user()->nim }}
<br>
Role: {{ auth()->user()->role }}
<br>
Name: {{ auth()->user()->name }}
<br>
Email: {{ auth()->user()->email }}
<br>
Profile: <br>
<img src="{{ asset("storage/".auth()->user()->profile) }}" alt="">
<br>
<br>
<br>
<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="profile" id="">
    <button>Upload</button>
</form>