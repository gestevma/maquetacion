//Cualquier evento en JS se campura con evt

import { pagination } from './crudTable'

export function scrollWindowElement (element){

    //'use strict' vuelve el JS más estructo. 
    //Todo lo que usemos hay que definirlo y una variable no puede estar fuera de su entorno
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

    //función que se activa cuando empiezas a tocar
    this.handleGestureStart = function(evt) { //evt son los eventos que hay al final

        if(evt.touches && evt.touches.length > 1) { //hace que solo haya un evento de touch (si quiero hacer más de 1 devolverá return asi que el segundo no hará nada)
            return;
        }

        if (scrollWindowElement.PointerEvent) {
            evt.target.setPointerCapture(evt.pointerId);
        } else {
            document.addEventListener('mousemove', this.handleGestureMove, true);
            document.addEventListener('mouseup', this.handleGestureEnd, true);
        }

        //En el momento de tocar captura la posición de Y de getGesturePointFromEvent(evt) (más abajo). 
        initialTouchPos = getGesturePointFromEvent(evt); //determina la posición inicial

    }.bind(this); //resetea el this para que todos los this que usemos no se pisen entre si


    //Esta función servirá para capturar el movimiento 
    this.handleGestureMove = function (evt) {

        //Si la posición inicial es falsa (no tiene valor) no hará nada. Así aseguramos que solo se inicie cuando toquemos, no antes
        if(!initialTouchPos) {
            return;
        }

        //Captura la posición final cuando he hecho movimiento
        lastTouchPos = getGesturePointFromEvent(evt);

        if(rafPending) {
            return;
        }

        rafPending = true;

        //Activa una animación. 
        //Se activará con el movimiento y la animación será la función 'onAnimFrame'
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

        changeState();
    }

    //Función para capturar la posición
    function getGesturePointFromEvent(evt) {

        //el punto lo capturas con un JSON
        let point = {};

        //estoy cogiendo la posición de Y
        if(evt.targetTouches) {
            point.y = evt.targetTouches[0].clientY;
        } else {
            point.y = evt.clientY;
        }

        return point; 

    }

    //Define la animación
    function onAnimFrame() {
        
        //Si esto es falso es que aún no se ha movido asi que no hará nada
        if(!rafPending) {
            return;
        }

        //Mira la diferencia entre la posicion inicial y la final
        let differenceInY = initialTouchPos.y - lastTouchPos.y;

        //Miramos cuato se ha movido. Es el movimiento que hará en pixeles
        let transformStyle  = (currentYPosition - differenceInY)+'px';

        //console.log(scrollWindowElement.offsetTop);

        //scrollWindowElement.style es la posición a la que estará la tabla
        scrollWindowElement.style.top = transformStyle;
        

        
        rafPending = false;
    }

    function changeState() {
        let transformStyle
        let menu = document.getElementById('bottombar-item').getBoundingClientRect(),
        elemRect = document.querySelector('.table').getBoundingClientRect(),
        offset = elemRect.bottom - menu.top;

        if(currentYPosition > 1){
            console.log(currentYPosition+" arriba")

            if(scrollWindowElement.style.top>=0+'px')
            currentYPosition = 0;
            transformStyle  = currentYPosition+'px';
            scrollWindowElement.style.top = transformStyle;
                      

        }else if(currentYPosition < -1){
           
            if(offset<0){

                (pagination(element.querySelector('.table-container').dataset.page));
               
                currentYPosition = (menu.top)*(-1);
                transformStyle  = currentYPosition+'px';
                scrollWindowElement.style.bottom = transformStyle;
                console.log(scrollWindowElement.style.bottom)
            }
            
        };

        
    
    };
    
    /* A la tabla le estoy pasando 4 eventos (touch, move, end, cancel)
    *
    */
    scrollWindowElement.addEventListener('touchstart', this.handleGestureStart, {passive: true} ); //Si empiezas (tocas la pantalla) irá a la función  this.handleGestureStart
    scrollWindowElement.addEventListener('touchmove', this.handleGestureMove, {passive: true} ); //Si mueves el dedo irá a la función  this.handleGestureMove
    scrollWindowElement.addEventListener('touchend', this.handleGestureEnd, true); //Si acabas (levantas el dedo) irá a la función  this.handleGestureEnd
    scrollWindowElement.addEventListener('touchcancel', this.handleGestureEnd, true); //Si cancelas irá a la función  this.handleGestureEnd

    //passive es para que la animación de touch vaya más fluido
};   
