<form method="post" action="{{ route('admin.settings.store') }}" class="form-horizontal" role="form">
    {!! csrf_field() !!}

    @if(count(config('setting_fields', [])) )

        @foreach(config('setting_fields') as $section => $fields)
            <div class="card panel panel-info">
                <div class="panel-heading">
                    <i class="{{ array_get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i>
                    {{ $fields['title'] }}
                </div>

                <div class="body">
                    <p class="text-muted">{{ $fields['desc'] }}</p>
                </div>

                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            @foreach($fields['elements'] as $field)
                                @includeIf('setting.fields.' . $field['type'] )
                                
                                @include('layouts.backend.partial.settings._text')
                            @endforeach                                                 
                            
                        </div>
                    </div>
                </div>

            </div>
            <!-- end panel for {{ $fields['title'] }} -->
        @endforeach

    @endif

    <div class="row m-b-md">
        <div class="col-md-12">
            <button class="btn-primary btn">
                Save Settings
            </button>
        </div>
    </div>
</form>