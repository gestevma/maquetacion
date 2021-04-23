import { pagination } from './crud'

export function scrollWindowElement (element){

    'use strict';

    let scrollWindowElement = element;

    let STATE_DEFAULT = 1;
    let STATE_TOP_SIDE = 2;
    let STATE_BOTTOM_SIDE = 3;

    let rafPending = false;
    let initialTouchPos = null;
    let lastTouchPos = null;
    let currentYPosition = 0;
    let currentState = STATE_DEFAULT;
    let handleSize = 10;

    this.handleGestureStart = function(evt) {

        if(evt.touches && evt.touches.length > 1) {
            return;
        }

        if (scrollWindowElement.PointerEvent) {
            evt.target.setPointerCapture(evt.pointerId);
        } else {
            document.addEventListener('mousemove', this.handleGestureMove, true);
            document.addEventListener('mouseup', this.handleGestureEnd, true);
        }

        initialTouchPos = getGesturePointFromEvent(evt);

    }.bind(this);

    this.handleGestureMove = function (evt) {

        if(!initialTouchPos) {
            return;
        }

        lastTouchPos = getGesturePointFromEvent(evt);

        if(rafPending) {
            return;
        }

        rafPending = true;

        window.requestAnimationFrame(onAnimFrame);

    }.bind(this);

    this.handleGestureEnd = function(evt) {

        evt.preventDefault();

        if(evt.touches && evt.touches.length > 0) {
            return;
        }

        rafPending = false;

        if (scrollWindowElement.PointerEvent) {
            evt.target.releasePointerCapture(evt.pointerId);
        } else {
            document.removeEventListener('mousemove', this.handleGestureMove, true);
            document.removeEventListener('mouseup', this.handleGestureEnd, true);
        }

        updateScrollRestPosition();

        initialTouchPos = null;

    }.bind(this);


    function updateScrollRestPosition() {
        let transformStyle;
        let differenceInY = initialTouchPos.y - lastTouchPos.y;
        currentYPosition = currentYPosition - differenceInY;


        transformStyle = currentYPosition+'px';
        scrollWindowElement.style.top = transformStyle;
        scrollWindowElement.style.transition = 'all 300ms ease-out';

        //console.log(scrollWindowElement.offsetTop);
        //console.log(scrollWindowElement.getBoundingClientRect());

        changeState();
    }

    function getGesturePointFromEvent(evt) {

        let point = {};

        if(evt.targetTouches) {
            point.y = evt.targetTouches[0].clientY;
        } else {
            point.y = evt.clientY;
        }

        return point; 

    }

    function onAnimFrame() {

        if(!rafPending) {
            return;
        }

        let differenceInY = initialTouchPos.y - lastTouchPos.y;
        let transformStyle  = (currentYPosition - differenceInY)+'px';

        //console.log(scrollWindowElement.offsetTop);

        scrollWindowElement.style.top = transformStyle;
        

        
        rafPending = false;
    }

    function changeState() {
        let transformStyle
        let menu = document.getElementById('bottombar-item').getBoundingClientRect(),
        elemRect = document.querySelector('.table').getBoundingClientRect(),
        offset = elemRect.bottom - menu.top;
        console.log(offset)

        if(currentYPosition > 1){
            if(scrollWindowElement.style.top>=0+'px')

            currentYPosition = 0;
            transformStyle  = currentYPosition+'px';
            scrollWindowElement.style.top = transformStyle;
                      

        }else if(currentYPosition < -1){
           
            if(offset<-100){

                (pagination(element.querySelector('.table-container').dataset.page));
               
                /*currentYPosition = (menu.top)*(-1);
                transformStyle  = currentYPosition+'px';
                scrollWindowElement.style.top = transformStyle;*/
            }
            //editElement(element.querySelector('.right-swipe').dataset.url);
        };
    
    };
    
    scrollWindowElement.addEventListener('touchstart', this.handleGestureStart, {passive: true} );
    scrollWindowElement.addEventListener('touchmove', this.handleGestureMove, {passive: true} );
    scrollWindowElement.addEventListener('touchend', this.handleGestureEnd, true);
    scrollWindowElement.addEventListener('touchcancel', this.handleGestureEnd, true);
};   