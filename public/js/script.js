/*$(document).ready(function(){

            console.log('Scroll');


})
*/
document.addEventListener('DOMContentLoaded', () => {

$('.navbar').on('scroll', function() {
    $('.navbar').css('padding', '50px');
    console.log('Scroll');
});
});