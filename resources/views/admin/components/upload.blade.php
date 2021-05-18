@if($type == "image" )
    <div class="upload">      
        @foreach ($files as $image)
            @if($image->language == $alias)
                <div class="upload-thumb"  data-label="{{$image->filename}}" style="background-image: url({{Storage::url($image->path)}})"></div>
            @endif
        @endforeach

        <span class="upload-prompt">@lang('admin/upload.image')</span>
        <input class="upload-input" type="file" name="images[{{$content}}.{{$alias}}]">
    </div>
@endif

@if($type == "images" )
    <div class="upload collection"  data-content="{{$content}}" data-alias="{{$alias}}">
        @foreach ($files as $image)
            @if($image->language == $alias)
                <div class="upload-preview collection {{$image->id}}" data-url="{{route('show_image_seo', ['image' => $image->id])}}">
                    <div class="upload-thumb" data-label="{{$image->filename}}" style="background-image: url({{Storage::url($image->path)}})"></div>
                </div>
            @endif
        @endforeach

        <div class="upload-image-add">      
            <span class="upload-prompt">+</span>
            <input class="upload-input" type="file">
        </div>
    </div>

@endif

