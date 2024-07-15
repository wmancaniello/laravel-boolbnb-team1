@session('success')
<div class="ms_toast ms_hidden bg-success rounded-2 shadow">
    {{ session('success') }} <i class="fa-regular fa-circle-check"></i>
    <div class="ms_line ms_hidden"> </div>
</div>
@endsession