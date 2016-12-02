<!-- CKeditor -->
<div @include('bcrud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    <textarea
    	id="ckeditor-{{ $field['name'] }}"
        name="{{ $field['name'] }}"
        @include('bcrud::inc.field_attributes', ['default_class' => 'form-control ckeditor'])
    	>{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}</textarea>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <script src="{{ asset('modules/bcrud/vendor/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('modules/bcrud/vendor/ckeditor/adapters/jquery.js') }}"></script>
        <script>
            jQuery(document).ready(function($) {
                $('textarea.ckeditor' ).ckeditor({
                    "filebrowserBrowseUrl": "{{ url(config('backpack.base.route_prefix').'/elfinder/ckeditor') }}",
                    "extraPlugins" : 'oembed,widget'
                });
            });
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}