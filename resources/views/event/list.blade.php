@extends('layout')

@section('content')
  <h1>イベント一覧</h1>

  <hr/>
    
  @foreach($events as $event)
    <article>
      <h2>
        <a href="{{ url('event', $event->id) }}">
          {{ $event->name }}
        </a>
      </h2>
      <div class="body">
        {{ $event->host }}
      </div>
    </article>
    @endforeach
@endsection