<div class="row {{ $column }}">
    <div class="col-md-3">
        <div class="form-check {{ $radioColor }} mt-1">
            <input class="form-check-input" type="radio" value="male" name="{{ $name }}" id="gender_male" {{ $isChecked === 'male' ? 'checked' : '' }} />
            <label class="form-check-label" for="gender_male">
              Male
            </label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check {{ $radioColor }} mt-1">
            <input class="form-check-input" type="radio" value="female" name="{{ $name }}" id="gender_female" {{ $isChecked === 'female' ? 'checked' : '' }} />
            <label class="form-check-label" for="gender_female">
              Female
            </label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check {{ $radioColor }} mt-1">
            <input class="form-check-input" type="radio" value="other" name="{{ $name }}" id="gender_other" {{ $isChecked === 'other' ? 'checked' : '' }} />
            <label class="form-check-label" for="gender_other">
              Other
            </label>
        </div>
    </div>
</div>
