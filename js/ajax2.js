function ajaxObj2( meth, url ) {
	var x = new XMLHttpRequest();
	x.open( meth, url, true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn2(x){
	if(x.readyState == 4 && x.status == 200){
	    return true;	
	}
}