jQuery(document).ready(function(){
	var j = jQuery;
    j('.slideShow img:gt(0)').hide(); /* All images after the first will be hidden at start */
    setInterval(function(){
      j('.slideShow :first-child').fadeOut() /* First image will fadeOut */
         .next('img').fadeIn() /* Next image fadeIn */
         .end().appendTo('.slideShow');}, /* First image will be sent to the back */
      3000); /* Sets the time between pictures fading in and out */
});