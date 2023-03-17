@if (isset($entry->image))
   <img src="{{ url('storage/' . $entry->image) }}" height="120" />
@else
   нет
@endif