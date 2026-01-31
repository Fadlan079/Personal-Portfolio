@extends('layouts.main')


@section('content')
<p style="
    text-emphasis: circle red;
    -webkit-text-emphasis: circle red; /* untuk Chrome/Safari */
">
  Ini teks penting yang diberi penekanan.
</p>

<p style="-webkit-text-emphasis: sesame green; text-emphasis: sesame green;">
  Jangan lupa baca bagian ini!
</p>

<p style="-webkit-text-emphasis: triangle orange; text-emphasis: triangle orange;">
  Catatan penting!
</p>

@endsection


