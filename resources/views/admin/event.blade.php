

@if(!empty($eventone['events_id']))
  {{ $eventone['events_title'] }}
  {{ $eventcategoryone['eventcategories_name'] }}
@endif

<br><br>
@foreach($events as $event)
  {{ $event->events_title }} | {{ $event->eventcategories_name }}<br>
@endforeach
