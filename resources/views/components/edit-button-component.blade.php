<div class="{{ isset($mclass) ? $mclass : '' }}" data-href="{{ isset($mhref) ? $mhref : '' }}" data-title="{{ isset($mtitle) ? $mtitle : '' }}">
    <a href="{{ isset($url) ? $url : 'javascript:void(0);' }}" class="btn tbl-action-btn" style="font-size: 18px">
        {!! isset($title) ? $title : '' !!}
    </a>
</div>
