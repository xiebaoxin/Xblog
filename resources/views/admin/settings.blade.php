@extends('admin.layouts.app')
@section('title','Settings')
@section('content')
    <form id="setting-form" action="{{ route('admin.save-settings') }}" method="post">
        <div class="pl-3 pr-3">
            @foreach($variables as $variable)
                <?php
                $variable_name = $variable['name'];
                $type = isset($variable['type']) ? $variable['type'] : 'text';// default text
                $default = isset($variable['default']) ? $variable['default'] : '';
                $final_value = isset($$variable_name) ? $$variable_name : $default;
                ?>
                @if($type == 'radio')
                    <div class="form-group">
                        @foreach($variable['values'] as $key => $value)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input"
                                           {{ $final_value == $key ? ' checked ':'' }}
                                           name="{{ $variable_name }}"
                                           value="{{ $key }}">{{ $value }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @continue
                @endif

                <div class="form-group row">
                    <label for="{{ $variable['name'] }}"
                           class="col-sm-4 col-form-label">{{ $variable['label'] }}</label>
                    <div class="col-sm-8">
                        @if($type == 'textarea')
                            <textarea id="{{ $variable_name }}" class="form-control autosize-target"
                                      placeholder="{{ $variable['placeholder'] or '' }}"
                                      rows="{{ $variable['rows'] or 3 }}"
                                      name="{{ $variable_name }}">{{ $final_value }}</textarea>
                        @else
                            <input type="{{ $type }}" name="{{ $variable_name }}"
                                   class="form-control" id="{{ $variable_name }}"
                                   placeholder="{{ $variable['placeholder'] or '' }}"
                                   value="{{ $final_value }}">
                        @endif
                    </div>
                </div>
            @endforeach
            {{ csrf_field() }}
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    保存
                </button>
            </div>
        </div>
    </form>
@endsection

