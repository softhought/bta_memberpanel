<div class="{{ isset($column) ? $column : '' }}">
    <div class="form-group mb-2">
        <label for="{{ isset($id) ? $id : '' }}" class="form-label">{{ isset($label) ? $label : '' }}</label>

        <select
            class="form-select {{ isset($multiple) ? 'selectpicker' : 'select2' }} {{ isset($class) ? $class : '' }} w-100"
            name="{{ isset($name) ? $name : '' }}"
            id="{{ isset($id) ? $id : '' }}"
            data-allow-clear="true"
            {{ isset($multiple) ? $multiple : '' }}>

            <option value="">Select</option>

            @if (isset($data) && is_iterable($data))
                @foreach ($data as $list)
                    @php
                        $optionValue = is_object($list) ? $list->{$arraykey} : $list[$arraykey];
                        $optionText = is_object($list) ? $list->{$arrayValue} : $list[$arrayValue];
                    @endphp
                    <option value="{{ $optionValue }}" {{ (isset($value) && $value == $optionValue) ? 'selected' : '' }}>
                        {{ $optionText }}
                    </option>
                @endforeach
            @endif
        </select>

        <div id="{{ isset($id) ? $id : '' }}_error" class="invalid-feedback d-block error-text"></div>
    </div>
</div>
