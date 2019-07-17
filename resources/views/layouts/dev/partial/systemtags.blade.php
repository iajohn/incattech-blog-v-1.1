@foreach($systemTags as $systemTag)
    <a href="{{ url('/tv/tag/' . $systemTag) }}">{{ $systemTag }}</a>
@endforeach