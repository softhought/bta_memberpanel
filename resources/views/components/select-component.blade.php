<div class="{{ $column }}">
    <div class="form-group mb-2">
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
        <select class="form-select {{ isset($multiple) ? 'selectpicker' : 'select2' }} {{ $class }} w-100"
            name="{{ $name }}" id="{{ $id }}" data-allow-clear="true" {{ $multiple ?? '' }}>
            <option value="">Select</option>
            @foreach ($data as $list)
                <option value="{{ is_object($list) ? $list->$arraykey : $list[$arraykey] }}"
                    @if ($value == (is_object($list) ? $list->$arraykey : $list[$arraykey])) {{ 'selected' }} @endif>
                    {{ is_object($list) ? $list->$arrayValue : $list[$arrayValue] }}
                </option>
            @endforeach
        </select>
        <div id="{{ $id }}_error" class="invalid-feedback d-block error-text"></div>
    </div>
</div>
