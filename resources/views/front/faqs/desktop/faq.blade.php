<div class="faq">

    <div class="faq-title">
        <h3>{{isset($faq->seo->title) ? $faq->seo->title : ""}}</h3>
    </div>
    
    <div class="faq">
        <div class="faq-description">
            <div class="faq-description-text">
                {!!isset($faq->locale['description']) ? $faq->locale['description'] : "" !!}
            </div>

            @isset($faq->image_featured_desktop->path)
                <div class="faq-description-image">
                    <img src="{{Storage::url($faq->image_featured_desktop->path)}}" alt="{{$faq->image_featured_desktop->alt}}" title="{{$faq->image_featured_desktop->title}}" />
                </div>
            @endif

            <div class = "grid-images">
                @isset($faq_element->image_grid_desktop)
                
                    <?php Debugbar::info($faq_element->image_grid_desktop)  ?>

                    @foreach($faq_element->image_grid_desktop as $grid_element)
                        <img src="{{Storage::url($grid_element->path)}}"/>
                    @endforeach
                    
                @endif
            </div>
        </div>
    </div>
    
</div>