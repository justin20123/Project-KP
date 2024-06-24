<form id="form-buka-absensi" method="POST" action="{{route('absensi.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        @foreach($absensi as $data => $value)
        <input type="text" name="{{ $data }}" value="{{ $value }} ">
        @endforeach
        <select name="jenis_pertemuan">
            <option value="reguler">Reguler</option>
            <option value="pengganti">Pengganti</option>
        </select>


    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
</form>