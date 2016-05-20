@extends('layout')

@section('content')
  <h3>イベント一覧</h3>

  <hr/>
    
  @foreach($events as $event)
    <article>
        {{ $event->name }}
      <div class="body">
        {{ $event->host }}
      </div>
    </article>
    @endforeach
@endsection