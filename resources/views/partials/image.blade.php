@if (isset($entry->image))
   <img src="/{{ storage_path($entry->image->path) }}" height="120" alt="{{ $entry->image->name }}" />
@else
   нет
@endif