
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
//^ CK Editor - WYSIWYG Editor



$(document).ready(function() {
$('#selectAllBoxes').click(function(event){

if(this.checked) {
	$('.checkboxes').each(function(){
		this.checked = true;
	});
}else{
	$('.checkboxes').each(function(){
		this.checked = false;
	});
}
});
});