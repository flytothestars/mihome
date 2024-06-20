@if (isset($options->model) && isset($options->type))

    @if (class_exists($options->model))

        @php
            $relationshipField = $row->field;
        @endphp

        @if ($options->type == 'morphMany')
            @if (isset($view) && ($view == 'browse' || $view == 'read'))
                @php
                    $relationshipData = isset($data) ? $data : $dataTypeContent;
                    $selected_values = isset($relationshipData)
                        ? $relationshipData
                            ->morphMany($options->model, 'entity')
                            ->get()
                            ->map(function ($item, $key) use ($options) {
                                $filename = Storage::disk(config('voyager.storage.disk'))->path(
                                    $item->{$options->label},
                                );
                                $url = Storage::disk(config('voyager.storage.disk'))->url($item->{$options->label});
                                if (is_file($filename)) {
                                    $allowedMimeTypes = [
                                        'image/jpeg',
                                        'image/gif',
                                        'image/png',
                                        'image/bmp',
                                        'image/svg+xml',
                                    ];
                                    $contentType = mime_content_type($filename);
                                    if (in_array($contentType, $allowedMimeTypes)) {
                                        $acontent = '<img src="' . $url . '" width="80" alt=""/>';
                                    } else {
                                        $acontent = $url;
                                    }
                                    return '<a href="' . $url . '" target="_blank">' . $acontent . '</a>';
                                }
                                return $item->{$options->label};
                            })
                            ->all()
                        : [];
                @endphp

                @if ($view == 'browse')
                    @php
                        $string_values = implode('<br/>', $selected_values);
                    @endphp
                    @if (empty($selected_values))
                        <p>{{ __('voyager::generic.no_results') }}</p>
                    @else
                        <p>{!! $string_values !!}</p>
                    @endif
                @else
                    @if (empty($selected_values))
                        <p>{{ __('voyager::generic.no_results') }}</p>
                    @else
                        {!! implode('<br/>', $selected_values) !!}
                    @endif
                @endif
            @else
                @php
                    $items = $dataTypeContent
                        ->morphMany($options->model, 'entity')
                        ->orderBy('sort', 'asc')
                        ->get();
                    $unqid = 's' . uniqid();
                @endphp
                @if ($items != null)
                    <div class="panel-body no-padding-left-right">
                        <div style="display:flex;flex-wrap:wrap;gap:1rem" id={{ $unqid }}>
                            @foreach ($items as $item)
                                @php
                                    $filename = Storage::disk(config('voyager.storage.disk'))->path(
                                        $item->{$options->label},
                                    );
                                    $url = Storage::disk(config('voyager.storage.disk'))->url($item->{$options->label});
                                @endphp
                                <div class="img_settings_container" data-field-name="{{ $row->field }}"
                                    style="position:relative;">
                                    <input type="hidden" name="oldimages[]" value="{{ $item->id }}" />
                                    <a href="javascript:;" class="voyager-x"
                                        onclick="$(this).closest('.img_settings_container').remove()"
                                        style="position: absolute;"></a>
                                    <div style="width:160px;height:160px;background:url('{{ $url }}') no-repeat center/cover;"
                                        data-file-name="{{ $url }}" data-id="{{ $dataTypeContent->getKey() }}"
                                        data-morph-id="{{ $item->id }}"></div>
                                </div>
                            @endforeach
                        </div>
                        <script>
                            window.addEventListener("load", (event) => {
                                new Sortable(document.getElementById('{{ $unqid }}'), {
                                    swapThreshold: 1,
                                    animation: 150
                                });
                            });
                        </script>
                    </div>
                @endif
                <div class="clearfix"></div>
                <input @if ($row->required == 1 && !isset($dataTypeContent->{$row->field})) required @endif type="file" name="images[]"
                    multiple="multiple" accept="image/*">
            @endif
        @elseif($options->type == 'belongsTo')
            @if (isset($view) && ($view == 'browse' || $view == 'read'))
                @php
                    $relationshipData = isset($data) ? $data : $dataTypeContent;
                    $model = app($options->model);
                    $query = $model::where($options->key, $relationshipData->{$options->column})->first();
                @endphp

                @if (isset($query))
                    <p>{{ $query->{$options->label} }}</p>
                @else
                    <p>{{ __('voyager::generic.no_results') }}</p>
                @endif
            @else
                <select class="form-control select2-ajax" name="{{ $options->column }}"
                    data-get-items-route="{{ route('voyager.' . $dataType->slug . '.relation') }}"
                    data-get-items-field="{{ $row->field }}"
                    @if (!is_null($dataTypeContent->getKey())) data-id="{{ $dataTypeContent->getKey() }}" @endif
                    data-method="{{ !is_null($dataTypeContent->getKey()) ? 'edit' : 'add' }}"
                    @if ($row->required == 1) required @endif>
                    @php
                        $model = app($options->model);
                        $query = $model
                            ::where($options->key, old($options->column, $dataTypeContent->{$options->column}))
                            ->get();
                    @endphp

                    @if (!$row->required)
                        <option value="">{{ __('voyager::generic.none') }}</option>
                    @endif

                    @foreach ($query as $relationshipData)
                        <option value="{{ $relationshipData->{$options->key} }}"
                            @if (old($options->column, $dataTypeContent->{$options->column}) == $relationshipData->{$options->key}) selected="selected" @endif>
                            {{ $relationshipData->{$options->label} }}</option>
                    @endforeach
                </select>

            @endif
        @elseif($options->type == 'hasOne')
            @php
                $relationshipData = isset($data) ? $data : $dataTypeContent;

                $model = app($options->model);
                $query = $model::where($options->column, '=', $relationshipData->{$options->key})->first();

            @endphp

            @if (isset($query))
                <p>{{ $query->{$options->label} }}</p>
            @else
                <p>{{ __('voyager::generic.no_results') }}</p>
            @endif
        @elseif($options->type == 'hasMany')
            @if (isset($view) && ($view == 'browse' || $view == 'read'))

                @php
                    $relationshipData = isset($data) ? $data : $dataTypeContent;
                    $model = app($options->model);

                    $selected_values = $model
                        ::where($options->column, '=', $relationshipData->{$options->key})
                        ->get()
                        ->map(function ($item, $key) use ($options) {
                            return $item->{$options->label};
                        })
                        ->all();
                @endphp

                @if ($view == 'browse')
                    @php
                        $string_values = implode(', ', $selected_values);
                        if (mb_strlen($string_values) > 25) {
                            $string_values = mb_substr($string_values, 0, 25) . '...';
                        }
                    @endphp
                    @if (empty($selected_values))
                        <p>{{ __('voyager::generic.no_results') }}</p>
                    @else
                        <p>{{ $string_values }}</p>
                    @endif
                @else
                    @if (empty($selected_values))
                        <p>{{ __('voyager::generic.no_results') }}</p>
                    @else
                        <ul>
                            @foreach ($selected_values as $selected_value)
                                <li>{{ $selected_value }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endif
            @else
                @php
                    $model = app($options->model);
                    $query = $model::where($options->column, '=', $dataTypeContent->{$options->key})->get();
                @endphp

                @if (isset($query))
                    <ul>
                        @foreach ($query as $query_res)
                            <li>{{ $query_res->{$options->label} }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ __('voyager::generic.no_results') }}</p>
                @endif

            @endif
        @elseif($options->type == 'belongsToMany')
            @if (isset($view) && ($view == 'browse' || $view == 'read'))

                @php
                    $relationshipData = isset($data) ? $data : $dataTypeContent;

                    $selected_values = isset($relationshipData)
                        ? $relationshipData
                            ->belongsToMany(
                                $options->model,
                                $options->pivot_table,
                                $options->foreign_pivot_key ?? null,
                                $options->related_pivot_key ?? null,
                                $options->parent_key ?? null,
                                $options->key,
                            )
                            ->get()
                            ->map(function ($item, $key) use ($options) {
                                return $item->{$options->label};
                            })
                            ->all()
                        : [];
                @endphp

                @if ($view == 'browse')
                    @php
                        $string_values = implode(', ', $selected_values);
                        // if (mb_strlen($string_values) > 25) {
                        //    $string_values = mb_substr($string_values, 0, 25) . '...';
                        // }
                    @endphp
                    @if ($options->model === 'App\Models\Offer')
                        <ul>
                            @foreach ($selected_values as $val)
                                <li>{{ $val }}</li>
                            @endforeach
                        </ul>
                    @elseif (empty($selected_values))
                        <p>{{ __('voyager::generic.no_results') }}</p>
                    @else
                        <p>{{ $string_values }}</p>
                    @endif
                @else
                    @if (empty($selected_values))
                        <p>{{ __('voyager::generic.no_results') }}</p>
                    @else
                        <ul>
                            @foreach ($selected_values as $selected_value)
                                <li>{{ $selected_value }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endif
            @else
                @if (isset($row->details->template))
                    @include('vendor.voyager.formfields.' . $row->details->template)
                @else
                    <select class="form-control select2-ajax @if (isset($options->taggable) && $options->taggable === 'on') taggable @endif"
                        name="{{ $relationshipField }}[]" multiple
                        data-get-items-route="{{ route('voyager.' . $dataType->slug . '.relation') }}"
                        data-get-items-field="{{ $row->field }}"
                        @if (!is_null($dataTypeContent->getKey())) data-id="{{ $dataTypeContent->getKey() }}" @endif
                        data-method="{{ !is_null($dataTypeContent->getKey()) ? 'edit' : 'add' }}"
                        @if (isset($options->taggable) && $options->taggable === 'on') data-route="{{ route('voyager.' . \Illuminate\Support\Str::slug($options->table) . '.store') }}"
                            data-label="{{ $options->label }}"
                            data-error-message="{{ __('voyager::bread.error_tagging') }}" @endif
                        @if ($row->required == 1) required @endif>

                        @php
                            $selected_keys = [];

                            if (!is_null($dataTypeContent->getKey())) {
                                $selected_keys = $dataTypeContent
                                    ->belongsToMany(
                                        $options->model,
                                        $options->pivot_table,
                                        $options->foreign_pivot_key ?? null,
                                        $options->related_pivot_key ?? null,
                                        $options->parent_key ?? null,
                                        $options->key,
                                    )
                                    ->pluck($options->table . '.' . $options->key);
                            }
                            $selected_keys = old($relationshipField, $selected_keys);
                            $selected_values = app($options->model)
                                ->whereIn($options->key, $selected_keys)
                                ->pluck($options->label, $options->key);
                        @endphp

                        @if (!$row->required)
                            <option value="">{{ __('voyager::generic.none') }}</option>
                        @endif

                        @foreach ($selected_values as $key => $value)
                            <option value="{{ $key }}" selected="selected">{{ $value }}</option>
                        @endforeach

                    </select>
                @endif

            @endif

        @endif
    @else
        cannot make relationship because {{ $options->model }} does not exist.

    @endif

@endif
