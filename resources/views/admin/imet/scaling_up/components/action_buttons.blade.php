@if(!isset($editor))
    <div class="mt-3 text-black-50 font-weight-bold generic-comments">Comments:</div>
    <p>
        <editor></editor>
    </p>
@endif
<container :loaded_at_once="false">
    <html_to_image :element="'{{$id}}'" :exclude_elements="'{{$exclude_elements}}'"></html_to_image>
</container>
