<div class="products">

    <div class="products-title">
        <h2>@lang('front/books.title')</h2>
    </div>


    <div class="products-grid">
        @foreach ($books as $book_element)
            <div class = "product-box" data-url="{{route('front_book', ['slug'=>$book_element->seo['slug']])}}">
                <div class="product-image-box">
                    @isset($book_element->image_featured_desktop->path)  
                        <img class="product-image" src="{{Storage::url($book_element->image_featured_desktop->path)}}" alt="{{$book_element->image_featured_desktop->alt}}" title="{{$book_element->image_featured_desktop->title}}" />
                    @endif
                </div>
                <div class="product-information-box">
                    <div class="product-references">
                        
                        <p class="product-title">{{isset($book_element->seo['title']) ? $book_element->seo['title'] : ""}}</p>

                        @if($book_element->products['discount']>0)
                            <div class="product-discount">
                                <svg  viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M9,4H15V12H19.84L12,19.84L4.16,12H9V4Z" />
                                </svg>
                                <p>{{isset($book_element->products['discount']) ? floatval($book_element->products['discount'])."%" : ""}}</p>
                            </div>
                        @endif

                        <div class="product-second-line">
                            <p class="product-autor">{{isset($book_element['autor']) ? $book_element['autor'] : ""}}</p>
                            <p class=product-price>{{isset($book_element->products['final_price']) ? str_replace('.',',',$book_element->products['final_price'])."€" : ""}}</p>
                        </div>
       
                    </div>
                    <div class="product-more">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17,13H13V17H11V13H7V11H11V7H13V11H17M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3Z" />
                        </svg>
                    </div>
                </div>
            </div>
       
        @endforeach 
    </div>
</div>