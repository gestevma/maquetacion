@if($agent->isDesktop())
    <link href="{{mix('css/admin/desktop/faqs/app.css')}}" rel="stylesheet">
@endif

@if($agent->isMobile())
    <link href="{{mix('css/admin/mobile/faqs/app.css')}}" rel="stylesheet">
@endif