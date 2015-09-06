function borderOver(element){
    var from = 0; // ��������� ���������� X
    var to = 1; // �������� ���������� X
    var duration = 300; // ������������ 
    var start = new Date().getTime(); // ����� ������
        
    setTimeout(function() {
    var now = (new Date().getTime()) - start; // ������� �����
    var progress = now / duration; // �������� ��������
    
    var result = (to - from) * progress + from;
     
    //document.write(result+";");
     
    element.style.borderColor = "rgba(40,40,40," + result + ")";
    
    if (progress < 1) // ���� �������� �� �����������, ����������
        setTimeout(arguments.callee, 10);
    }, 1);
}

function borderOut(element){
    var from = 1; // ��������� ���������� X
    var to = 0; // �������� ���������� X
    var duration = 300; // ������������ 
    var start = new Date().getTime(); // ����� ������
        
    setTimeout(function() {
    var now = (new Date().getTime()) - start; // ������� �����
    var progress = now / duration; // �������� ��������
    
    var result = (to - from) * progress + from;
     
    //document.write(result+";");
     
    element.style.borderColor = "rgba(40,40,40," + result + ")";
    
    if (progress < 1) // ���� �������� �� �����������, ����������
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