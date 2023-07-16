window.addEventListener('scroll', function() {
    var footer = document.getElementById('footer');
    var footerHeight = footer.offsetHeight;
    var windowHeight = window.innerHeight;
    var scrollPosition = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;

    if (scrollPosition + windowHeight >= document.body.offsetHeight - footerHeight) {
        footer.style.opacity = '1';
    } else {
        footer.style.opacity = '0';
    }
});
