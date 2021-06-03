<div class="product">


    <div class="individual-product-information">

        <div class="extra-images">
            @isset($book->image_grid_desktop)
                @foreach($book->image_grid_desktop as $grid_element)
                    <img src="{{Storage::url($grid_element->path)}}"/>
                @endforeach     
            @endif
        </div>

        <div class = main-product-content>
            
            <div class="individual-product-box">
                <div class="individual-product-image">  
                    @isset($book->image_featured_desktop->path)
                        <img src="{{Storage::url($book->image_featured_desktop->path)}}" alt="{{$book->image_featured_desktop->alt}}" title="{{$book->image_featured_desktop->title}}" />
                    @endif
                </div> 
                <div class="individual-product-characteristics">
                    <div class="individual-product-title">
                        <h3>{{isset($book->seo['title']) ? $book->seo['title'] : ""}}</h3>
                    </div>
                    <div class="individual-product-autor">{{isset($book['autor']) ? $book['autor'] : ""}}</div>
                    <div class="individual-product-genre">{!!isset($book->locale['genre']) ? $book->locale['genre'] : "" !!} </div>
                    <div class="individual-product-price">{{isset($book->products['final_price']) ? $book->products['final_price']." €" : ""}}</div> 
                    <div class="individual-product-description">
                        <p class="description-title">@lang('front/books.description')</p>
                        {!!isset($book->locale['description']) ? $book->locale['description'] : "" !!}
                    </div>
                    <p class="more">@lang('front/books.more')</p>
                    
                </div>
            </div>
            
            {{-- @foreach($books as $book_element)
            @endforeach --}}
            
        </div>  
    </div>

    <div class="shop">

        <div class = "discount-price">
            @if($book->products['discount'] > 0)
                <p class = "original-price">{{isset($book->products['original_price']) ? sprintf('%.2f', $book->products['original_price']*((1+($book->products['taxes'])/100)))."€" : ""}}</p>
                <p class = "discount">{{isset($book->products['discount']) ? "(".floatval($book->products['discount'])."% " : ""}}@lang('front/books.discount')</p>
            @endif
        </div>
        <div class = "shop-information @if($book->products['discount']==0) none @endif">
            <div class="second-line">
                <div class="final-price">{{isset($book->products['final_price']) ? $book->products['final_price']."€" : ""}}</div>
                <div class = "delivery">
                    <svg  style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M18 18.5C18.83 18.5 19.5 17.83 19.5 17C19.5 16.17 18.83 15.5 18 15.5C17.17 15.5 16.5 16.17 16.5 17C16.5 17.83 17.17 18.5 18 18.5M19.5 9.5H17V12H21.46L19.5 9.5M6 18.5C6.83 18.5 7.5 17.83 7.5 17C7.5 16.17 6.83 15.5 6 15.5C5.17 15.5 4.5 16.17 4.5 17C4.5 17.83 5.17 18.5 6 18.5M20 8L23 12V17H21C21 18.66 19.66 20 18 20C16.34 20 15 18.66 15 17H9C9 18.66 7.66 20 6 20C4.34 20 3 18.66 3 17H1V6C1 4.89 1.89 4 3 4H17V8H20M3 6V15H3.76C4.31 14.39 5.11 14 6 14C6.89 14 7.69 14.39 8.24 15H15V6H3Z" />
                    </svg>
                    <p>@lang('front/books.deliver')</p>
                </div>
            </div>

            <div class="shop-bottons">    
                <div class="shop-cart shop-button">
                    <div class="cart-image shop-image">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M10,0V4H8L12,8L16,4H14V0M1,2V4H3L6.6,11.59L5.25,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42C7.29,15 7.17,14.89 7.17,14.75L7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.59 17.3,11.97L21.16,4.96L19.42,4H19.41L18.31,6L15.55,11H8.53L8.4,10.73L6.16,6L5.21,4L4.27,2M7,18A2,2 0 0,0 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20A2,2 0 0,0 7,18M17,18A2,2 0 0,0 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20A2,2 0 0,0 17,18Z" />
                        </svg>
                    </div>
                    <p class="add-to-cart shop-text">@lang('front/books.add-to-cart')<p>
                </div>

                <div class="shop-buy shop-button">
                    <div class="buy-image shop-image">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M22 9H17.21L12.83 2.44C12.64 2.16 12.32 2 12 2S11.36 2.16 11.17 2.45L6.79 9H2C1.45 9 1 9.45 1 10C1 10.09 1 10.18 1.04 10.27L3.58 19.54C3.81 20.38 4.58 21 5.5 21H18.5C19.42 21 20.19 20.38 20.43 19.54L22.97 10.27L23 10C23 9.45 22.55 9 22 9M12 4.8L14.8 9H9.2L12 4.8M18.5 19L5.5 19L3.31 11H20.7L18.5 19M12 13C10.9 13 10 13.9 10 15S10.9 17 12 17 14 16.1 14 15 13.1 13 12 13Z" />
                        </svg>
                    </div>
                    <p class="buy-it shop-text">@lang('front/books.buy-it')<p>
                </div>
                

                <div class="wishes">
                    <svg class="heart" style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
                    </svg>

                    <svg class="heart wish inactive" style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
                    </svg>
                    <p>@lang('front/books.wishes')</p>
                </div>
            </div>
        </div>
    </div>
</div>