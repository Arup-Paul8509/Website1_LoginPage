var modal1=document.getElementById('id01');
var modal2=document.getElementById('id02');
window.onclick=function(event){
    if(event.target==modal1){
        modal1.style.display='none';
    }
    if(event.target==modal2){
        modal2.style.display='none';
    }
}
function check_password()
{
    var x=document.getElementById('pwd').value;
    var y=document.getElementById('cpwd').value;
    if(x!=y)
    {
        alert("**Password didn't match !");
        document.getElementById('pwd').value='';
        document.getElementById('cpwd').value='';
        return false;
    }
    else
        return true;
}