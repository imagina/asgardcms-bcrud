<!-- select multiple -->
<div @include('bcrud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('bcrud::inc.field_translatable_icon')
    <select
    	class="form-control"
        name="{{ $field['name'] }}[]"
        @include('bcrud::inc.field_attributes')
    	multiple>

		@if (!isset($field['allows_null']) || $field['allows_null'])
			<option value="">-</option>
		@endif

    	@if (isset($field['model']))
    		@foreach ($field['model']::all() as $connected_entity_entry)
    			<option value="{{ $connected_entity_entry->getKey() }}"
					@if ( (isset($field['value']) && in_array($connected_entity_entry->getKey(), $field['value']->pluck($connected_entity_entry->getKeyName(), $connected_entity_entry->getKeyName())->toArray())) || ( old( $field["name"] ) && in_array($connected_entity_entry->getKey(), old( $field["name"])) ) )
                         selected
					@endif
    			>{{ $connected_entity_entry->{$field['attribute']} }}</option>
    		@endforeach
    	@endif

	</select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>