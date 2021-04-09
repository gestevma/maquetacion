@if($agent->isDesktop())
    <link href="{{mix('css/front/desktop/faqs/app.css')}}" rel="stylesheet">
@endif

@if($agent->isMobile())
    <link href="{{mix('css/front/mobile/faqs/app.css')}}" rel="stylesheet">
@endif
