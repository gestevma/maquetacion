@if($agent->isDesktop())
    <script src="{{mix('js/admin/desktop/app.js')}}"></script>
@endif

@if($agent->isMobile())
    <script src="{{mix('js/admin/mobile/app.js')}}"></script>
@endif

