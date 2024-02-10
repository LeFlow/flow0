document.addEventListener('DOMContentLoaded', () => {
console.log('Scroll');
$('.navbar').on('scroll', function() {
    $('.navbar').css('padding', '50px');
    console.log('Scroll');
});
});