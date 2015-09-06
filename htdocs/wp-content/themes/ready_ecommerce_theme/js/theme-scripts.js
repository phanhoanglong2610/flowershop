function borderOver(element){
    var from = 0; // Начальная координата X
    var to = 1; // Конечная координата X
    var duration = 300; // Длительность 
    var start = new Date().getTime(); // Время старта
        
    setTimeout(function() {
    var now = (new Date().getTime()) - start; // Текущее время
    var progress = now / duration; // Прогресс анимации
    
    var result = (to - from) * progress + from;
     
    //document.write(result+";");
     
    element.style.borderColor = "rgba(40,40,40," + result + ")";
    
    if (progress < 1) // Если анимация не закончилась, продолжаем
        setTimeout(arguments.callee, 10);
    }, 1);
}

function borderOut(element){
    var from = 1; // Начальная координата X
    var to = 0; // Конечная координата X
    var duration = 300; // Длительность 
    var start = new Date().getTime(); // Время старта
        
    setTimeout(function() {
    var now = (new Date().getTime()) - start; // Текущее время
    var progress = now / duration; // Прогресс анимации
    
    var result = (to - from) * progress + from;
     
    //document.write(result+";");
     
    element.style.borderColor = "rgba(40,40,40," + result + ")";
    
    if (progress < 1) // Если анимация не закончилась, продолжаем
        setTimeout(arguments.callee, 10);
    }, 1);
}

jQuery(document).ready(function() {
    jQuery('#startslider').hover(
        function(){
           borderOver(this) ;
        },
        function(){
           borderOut(this) ;
        }
    );
});