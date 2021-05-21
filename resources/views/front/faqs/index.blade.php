@extends('front.layout.header-section')

@section("section")
    
    <div class="faqs">
        @foreach ($faqs as $faq_element)
            <div class="individual-faq" id="{{$faq_element->id}}" >
                <div class="faq-title">                            
                    <div class="faq-title-content">{{isset($faq_element->locale['title']) ? $faq_element->locale['title'] : ""}}</div>
                    <a class="buttons">
                        <svg class="plus-button" style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" />
                        </svg>
                    </a>
                </div>

                <div class="faq-description" id="{{$faq_element->id}}">
                    <div class="description" id="description">{!!isset($faq_element->locale['description']) ? $faq_element->locale['description'] : "" !!} </div>
                    
                    <div class = faq-description-images>
                        <div class = "main-image">
                            @isset($faq_element->image_featured_desktop->path)
                                <img src="{{Storage::url($faq_element->image_featured_desktop->path)}}" alt="{{$faq_element->image_featured_desktop->alt}}" title="{{$faq_element->image_featured_desktop->title}}" />
                            @endif
                        </div>

                        @isset($faq_element->image_grid_desktop)
                            <div class = "grid-images">
                                @foreach($faq_element->image_grid_desktop as $grid_element)
                                    <img src="{{Storage::url($grid_element->path)}}">
                                @endforeach
                            
                            </div>
                            
                        @endif
                    </div>

                </div>
            </div>
        @endforeach 
    </div>
           


@endsection