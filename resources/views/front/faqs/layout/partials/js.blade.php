@if($agent->isDesktop())
    <script src="{{mix('js/front/desktop/faqs/app.js')}}"></script>
@endif

@if($agent->isMobile())
    <script src="{{mix('js/front/mobile/faqs/app.js')}}"></script>
@endif