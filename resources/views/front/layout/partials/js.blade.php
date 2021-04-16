@if($agent->isDesktop())
    <script src="{{mix('js/front/desktop/app.js')}}"></script>
@endif

@if($agent->isMobile())
    <script src="{{mix('js/front/mobile/app.js')}}"></script>
@endif



