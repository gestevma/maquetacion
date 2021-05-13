@extends('front.layout.header-section')

@section("section")
    
    <div class="faqs">
        @foreach ($faqs as $faq_element)
            <div class="individual-faq" id="{{$faq_element->id}}" >
                <div class="faq-title">                            
                    <p class="faq-title-content">{{isset($faq_element->locale['title']) ? $faq_element->locale['title'] : ""}}</p>
                    <a class="buttons">
                        <svg class="plus-button" style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" />
                        </svg>
                    </a>
                </div>
                <div class="faq-description" id="{{$faq_element->id}}">
                    <p class="description" id="description">{!!isset($faq_element->locale['description']) ? $faq_element->locale['description'] : "" !!}</p>
                </div>
            </div>
        @endforeach 
    </div>
           


@endsection