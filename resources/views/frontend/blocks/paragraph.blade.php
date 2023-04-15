@php
$data=json_decode($data);
@endphp
<section class="c-one-col--text content container revealable revealed">
             @if(isset($data->paragraph)) {!!$data->paragraph!!} @endif
</section>