<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script>

function scrollToDiv(obj) {
    event.preventDefault();
    var target = "#" + obj.getAttribute('data-target');
    $('html, body').animate({
        scrollTop: $(target).offset().top
    }, 2000);	
}
</script>